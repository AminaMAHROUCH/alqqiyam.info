<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDirectorateRequest;
use App\Http\Requests\StoreDirectorateRequest;
use App\Http\Requests\UpdateDirectorateRequest;
use App\Models\Directorate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DirectorateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('directorate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $directorates = Directorate::all();

        return view('admin.directorates.index', compact('directorates'));
    }

    public function create()
    {
        abort_if(Gate::denies('directorate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.directorates.create');
    }

    public function store(StoreDirectorateRequest $request)
    {
        $directorate = Directorate::create($request->all());

        return redirect()->route('admin.directorates.index');
    }

    public function edit(Directorate $directorate)
    {
        abort_if(Gate::denies('directorate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.directorates.edit', compact('directorate'));
    }

    public function update(UpdateDirectorateRequest $request, Directorate $directorate)
    {
        $directorate->update($request->all());

        return redirect()->route('admin.directorates.index');
    }

    public function show(Directorate $directorate)
    {
        abort_if(Gate::denies('directorate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $directorate->load('directionUnits');

        return view('admin.directorates.show', compact('directorate'));
    }

    public function destroy(Directorate $directorate)
    {
        abort_if(Gate::denies('directorate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $directorate->delete();

        return back();
    }

    public function massDestroy(MassDestroyDirectorateRequest $request)
    {
        Directorate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}