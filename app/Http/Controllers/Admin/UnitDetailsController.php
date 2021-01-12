<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUnitDetailRequest;
use App\Http\Requests\StoreUnitDetailRequest;
use App\Http\Requests\UpdateUnitDetailRequest;
use App\Models\UnitDetail;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class UnitDetailsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('unit_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unitDetails = UnitDetail::all();

        return view('admin.unitDetails.index', compact('unitDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('unit_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.unitDetails.create');
    }

    public function store(StoreUnitDetailRequest $request)
    {
        $unitDetail = UnitDetail::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $unitDetail->id]);
        }

        return redirect()->route('admin.unit-details.index');
    }

    public function edit(UnitDetail $unitDetail)
    {
        abort_if(Gate::denies('unit_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.unitDetails.edit', compact('unitDetail'));
    }

    public function update(UpdateUnitDetailRequest $request, UnitDetail $unitDetail)
    {
        $unitDetail->update($request->all());

        return redirect()->route('admin.unit-details.index');
    }

    public function show(UnitDetail $unitDetail)
    {
        abort_if(Gate::denies('unit_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.unitDetails.show', compact('unitDetail'));
    }

    public function destroy(UnitDetail $unitDetail)
    {
        abort_if(Gate::denies('unit_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unitDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyUnitDetailRequest $request)
    {
        UnitDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('unit_detail_create') && Gate::denies('unit_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UnitDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}