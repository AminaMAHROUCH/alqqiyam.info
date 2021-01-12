<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUniteRegionalRequest;
use App\Http\Requests\StoreUniteRegionalRequest;
use App\Http\Requests\UpdateUniteRegionalRequest;
use App\Models\Province;
use App\Models\Region;
use App\Models\UniteRegional;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UniteRegionalController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('unite_regional_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uniteRegionals = UniteRegional::with(['region', 'province', 'media'])->get();

        return view('admin.uniteRegionals.index', compact('uniteRegionals'));
    }

    public function create()
    {
        abort_if(Gate::denies('unite_regional_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.uniteRegionals.create', compact('regions', 'provinces'));
    }

    public function store(StoreUniteRegionalRequest $request)
    {
        $uniteRegional = UniteRegional::create($request->all());

        if ($request->input('image', false)) {
            $uniteRegional->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $uniteRegional->id]);
        }

        return redirect()->route('admin.unite-regionals.index');
    }

    public function edit(UniteRegional $uniteRegional)
    {
        abort_if(Gate::denies('unite_regional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regions = Region::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinces = Province::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $uniteRegional->load('region', 'province');

        return view('admin.uniteRegionals.edit', compact('regions', 'provinces', 'uniteRegional'));
    }

    public function update(UpdateUniteRegionalRequest $request, UniteRegional $uniteRegional)
    {
        $uniteRegional->update($request->all());

        if ($request->input('image', false)) {
            if (!$uniteRegional->image || $request->input('image') !== $uniteRegional->image->file_name) {
                if ($uniteRegional->image) {
                    $uniteRegional->image->delete();
                }

                $uniteRegional->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($uniteRegional->image) {
            $uniteRegional->image->delete();
        }

        return redirect()->route('admin.unite-regionals.index');
    }

    public function show(UniteRegional $uniteRegional)
    {
        abort_if(Gate::denies('unite_regional_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uniteRegional->load('region', 'province');

        return view('admin.uniteRegionals.show', compact('uniteRegional'));
    }

    public function destroy(UniteRegional $uniteRegional)
    {
        abort_if(Gate::denies('unite_regional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $uniteRegional->delete();

        return back();
    }

    public function massDestroy(MassDestroyUniteRegionalRequest $request)
    {
        UniteRegional::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('unite_regional_create') && Gate::denies('unite_regional_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UniteRegional();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}