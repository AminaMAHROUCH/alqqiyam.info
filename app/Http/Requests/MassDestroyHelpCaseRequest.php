<?php

namespace App\Http\Requests;

use App\Models\HelpCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHelpCaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('help_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:help_cases,id',
        ];
    }
}