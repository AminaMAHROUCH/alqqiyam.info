<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrivateNewsRequest;
use App\Http\Requests\StorePrivateNewsRequest;
use App\Http\Requests\UpdatePrivateNewsRequest;
use App\Models\PrivateNews;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PrivateNewsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('private_news_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $privateNews = PrivateNews::with(['media'])->get();

        return view('admin.privateNews.index', compact('privateNews'));
    }

    public function create()
    {
        abort_if(Gate::denies('private_news_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.privateNews.create');
    }

    public function store(StorePrivateNewsRequest $request)
    {
        $privateNews = PrivateNews::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $privateNews->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $privateNews->id]);
        }

        return redirect()->route('admin.private-news.index');
    }

    public function edit(PrivateNews $privateNews)
    {
        abort_if(Gate::denies('private_news_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.privateNews.edit', compact('privateNews'));
    }

    public function update(UpdatePrivateNewsRequest $request, PrivateNews $privateNews)
    {
        $privateNews->update($request->all());

        if (count($privateNews->image) > 0) {
            foreach ($privateNews->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $privateNews->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $privateNews->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.private-news.index');
    }

    public function show(PrivateNews $privateNews)
    {
        abort_if(Gate::denies('private_news_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.privateNews.show', compact('privateNews'));
    }

    public function destroy(PrivateNews $privateNews)
    {
        abort_if(Gate::denies('private_news_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $privateNews->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrivateNewsRequest $request)
    {
        PrivateNews::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('private_news_create') && Gate::denies('private_news_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PrivateNews();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}