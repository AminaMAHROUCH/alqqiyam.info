<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPublicNewsRequest;
use App\Http\Requests\StorePublicNewsRequest;
use App\Http\Requests\UpdatePublicNewsRequest;
use App\Models\PublicNews;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PublicNewsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('public_news_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicNews = PublicNews::with(['media'])->get();

        return view('admin.publicNews.index', compact('publicNews'));
    }

    public function create()
    {
        abort_if(Gate::denies('public_news_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicNews.create');
    }

    public function store(StorePublicNewsRequest $request)
    {
        $publicNews = PublicNews::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $publicNews->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $publicNews->id]);
        }

        return redirect()->route('admin.public-news.index');
    }

    public function edit(PublicNews $publicNews)
    {
        abort_if(Gate::denies('public_news_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicNews.edit', compact('publicNews'));
    }

    public function update(UpdatePublicNewsRequest $request, PublicNews $publicNews)
    {
        $publicNews->update($request->all());

        if (count($publicNews->image) > 0) {
            foreach ($publicNews->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $publicNews->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $publicNews->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.public-news.index');
    }

    public function show(PublicNews $publicNews)
    {
        abort_if(Gate::denies('public_news_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicNews.show', compact('publicNews'));
    }

    public function destroy(PublicNews $publicNews)
    {
        abort_if(Gate::denies('public_news_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicNews->delete();

        return back();
    }

    public function massDestroy(MassDestroyPublicNewsRequest $request)
    {
        PublicNews::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('public_news_create') && Gate::denies('public_news_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PublicNews();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
