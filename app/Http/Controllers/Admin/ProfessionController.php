<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProfessionRequest;
use App\Http\Requests\StoreProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use App\Models\Profession;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfessionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('profession_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $professions = Profession::all();

        return view('admin.professions.index', compact('professions'));
    }

    public function create()
    {
        abort_if(Gate::denies('profession_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.professions.create');
    }

    public function store(StoreProfessionRequest $request)
    {
        $profession = Profession::create($request->all());

        return redirect()->route('admin.professions.index');
    }

    public function edit(Profession $profession)
    {
        abort_if(Gate::denies('profession_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.professions.edit', compact('profession'));
    }

    public function update(UpdateProfessionRequest $request, Profession $profession)
    {
        $profession->update($request->all());

        return redirect()->route('admin.professions.index');
    }

    public function show(Profession $profession)
    {
        abort_if(Gate::denies('profession_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.professions.show', compact('profession'));
    }

    public function destroy(Profession $profession)
    {
        abort_if(Gate::denies('profession_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $profession->delete();

        return back();
    }

    public function massDestroy(MassDestroyProfessionRequest $request)
    {
        Profession::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}