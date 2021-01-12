<?php

namespace App\Http\Requests;

use App\Models\UniteRegional;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUniteRegionalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('unite_regional_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:unite_regionals,id',
        ];
    }
}