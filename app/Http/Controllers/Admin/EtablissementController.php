<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEtablissementRequest;
use App\Http\Requests\StoreEtablissementRequest;
use App\Http\Requests\UpdateEtablissementRequest;
use App\Models\Directorate;
use App\Models\Etablissement;
use App\Models\Profession;
use App\Models\Unit;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EtablissementController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('etablissement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $etablissements = Etablissement::with(['direction', 'unite', 'profession', 'media'])->get();

        return view('admin.etablissements.index', compact('etablissements'));
    }

    public function create()
    {
        abort_if(Gate::denies('etablissement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $directions = Directorate::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unites = Unit::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $professions = Profession::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.etablissements.create', compact('directions', 'unites', 'professions'));
    }

    public function store(StoreEtablissementRequest $request)
    {
        $etablissement = Etablissement::create($request->all());

        if ($request->input('image', false)) {
            $etablissement->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $etablissement->id]);
        }

        return redirect()->route('admin.etablissements.index');
    }

    public function edit(Etablissement $etablissement)
    {
        abort_if(Gate::denies('etablissement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $directions = Directorate::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $unites = Unit::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $professions = Profession::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $etablissement->load('direction', 'unite', 'profession');

        return view('admin.etablissements.edit', compact('directions', 'unites', 'professions', 'etablissement'));
    }

    public function update(UpdateEtablissementRequest $request, Etablissement $etablissement)
    {
        $etablissement->update($request->all());

        if ($request->input('image', false)) {
            if (!$etablissement->image || $request->input('image') !== $etablissement->image->file_name) {
                if ($etablissement->image) {
                    $etablissement->image->delete();
                }

                $etablissement->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($etablissement->image) {
            $etablissement->image->delete();
        }

        return redirect()->route('admin.etablissements.index');
    }

    public function show(Etablissement $etablissement)
    {
        abort_if(Gate::denies('etablissement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $etablissement->load('direction', 'unite', 'profession');

        return view('admin.etablissements.show', compact('etablissement'));
    }

    public function destroy(Etablissement $etablissement)
    {
        abort_if(Gate::denies('etablissement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $etablissement->delete();

        return back();
    }

    public function massDestroy(MassDestroyEtablissementRequest $request)
    {
        Etablissement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('etablissement_create') && Gate::denies('etablissement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Etablissement();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}