<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNationalPartnerRequest;
use App\Http\Requests\StoreNationalPartnerRequest;
use App\Http\Requests\UpdateNationalPartnerRequest;
use App\Models\NationalPartner;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media; 
use Symfony\Component\HttpFoundation\Response;

class NationalPartnerController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('national_partner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nationalPartners = NationalPartner::with(['media'])->get();

        return view('admin.nationalPartners.index', compact('nationalPartners'));
    }

    public function create()
    {
        abort_if(Gate::denies('national_partner_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nationalPartners.create');
    }

    public function store(StoreNationalPartnerRequest $request)
    {
        $nationalPartner = NationalPartner::create($request->all());

        if ($request->input('image', false)) {
            $nationalPartner->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $nationalPartner->id]);
        }

        return redirect()->route('admin.national-partners.index');
    }

    public function edit(NationalPartner $nationalPartner)
    {
        abort_if(Gate::denies('national_partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nationalPartners.edit', compact('nationalPartner'));
    }

    public function update(UpdateNationalPartnerRequest $request, NationalPartner $nationalPartner)
    {
        $nationalPartner->update($request->all());

        if ($request->input('image', false)) {
            if (!$nationalPartner->image || $request->input('image') !== $nationalPartner->image->file_name) {
                if ($nationalPartner->image) {
                    $nationalPartner->image->delete();
                }

                $nationalPartner->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($nationalPartner->image) {
            $nationalPartner->image->delete();
        }

        return redirect()->route('admin.national-partners.index');
    }

    public function show(NationalPartner $nationalPartner)
    {
        abort_if(Gate::denies('national_partner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.nationalPartners.show', compact('nationalPartner'));
    }

    public function destroy(NationalPartner $nationalPartner)
    {
        abort_if(Gate::denies('national_partner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nationalPartner->delete();

        return back();
    }

    public function massDestroy(MassDestroyNationalPartnerRequest $request)
    {
        NationalPartner::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('national_partner_create') && Gate::denies('national_partner_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new NationalPartner();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
