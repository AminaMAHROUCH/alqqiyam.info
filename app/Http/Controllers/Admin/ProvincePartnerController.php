<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProvincePartnerRequest;
use App\Http\Requests\StoreProvincePartnerRequest;
use App\Http\Requests\UpdateProvincePartnerRequest;
use App\Models\Province;
use App\Models\ProvincePartner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProvincePartnerController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('province_partner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provincePartners = ProvincePartner::with(['province', 'media'])->get();

        return view('admin.provincePartners.index', compact('provincePartners'));
    }

    public function create()
    {
        abort_if(Gate::denies('province_partner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.provincePartners.create', compact('provinces'));
    }

    public function store(StoreProvincePartnerRequest $request)
    {
        $provincePartner = ProvincePartner::create($request->all());

        if ($request->input('image', false)) {
            $provincePartner->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $provincePartner->id]);
        }

        return redirect()->route('admin.province-partners.index');
    }

    public function edit(ProvincePartner $provincePartner)
    {
        abort_if(Gate::denies('province_partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provinces = Province::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provincePartner->load('province');

        return view('admin.provincePartners.edit', compact('provinces', 'provincePartner'));
    }

    public function update(UpdateProvincePartnerRequest $request, ProvincePartner $provincePartner)
    {
        $provincePartner->update($request->all());

        if ($request->input('image', false)) {
            if (!$provincePartner->image || $request->input('image') !== $provincePartner->image->file_name) {
                if ($provincePartner->image) {
                    $provincePartner->image->delete();
                }

                $provincePartner->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($provincePartner->image) {
            $provincePartner->image->delete();
        }

        return redirect()->route('admin.province-partners.index');
    }

    public function show(ProvincePartner $provincePartner)
    {
        abort_if(Gate::denies('province_partner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provincePartner->load('province');

        return view('admin.provincePartners.show', compact('provincePartner'));
    }

    public function destroy(ProvincePartner $provincePartner)
    {
        abort_if(Gate::denies('province_partner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provincePartner->delete();

        return back();
    }

    public function massDestroy(MassDestroyProvincePartnerRequest $request)
    {
        ProvincePartner::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('province_partner_create') && Gate::denies('province_partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ProvincePartner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}