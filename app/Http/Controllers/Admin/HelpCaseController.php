<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHelpCaseRequest;
use App\Http\Requests\StoreHelpCaseRequest;
use App\Http\Requests\UpdateHelpCaseRequest;
use App\Models\HelpCase;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HelpCaseController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('help_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $helpCases = HelpCase::with(['media'])->get();

        return view('admin.helpCases.index', compact('helpCases'));
    }

    public function create()
    {
        abort_if(Gate::denies('help_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.helpCases.create');
    }

    public function store(StoreHelpCaseRequest $request)
    {
        $helpCase = HelpCase::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $helpCase->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $helpCase->id]);
        }

        return redirect()->route('admin.help-cases.index');
    }

    public function edit(HelpCase $helpCase)
    {
        abort_if(Gate::denies('help_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.helpCases.edit', compact('helpCase'));
    }

    public function update(UpdateHelpCaseRequest $request, HelpCase $helpCase)
    {
        $helpCase->update($request->all());

        if (count($helpCase->image) > 0) {
            foreach ($helpCase->image as $media) {
                if (!in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }

        $media = $helpCase->image->pluck('file_name')->toArray();

        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $helpCase->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.help-cases.index');
    }

    public function show(HelpCase $helpCase)
    {
        abort_if(Gate::denies('help_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.helpCases.show', compact('helpCase'));
    }

    public function destroy(HelpCase $helpCase)
    {
        abort_if(Gate::denies('help_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $helpCase->delete();

        return back();
    }

    public function massDestroy(MassDestroyHelpCaseRequest $request)
    {
        HelpCase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('help_case_create') && Gate::denies('help_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HelpCase();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}