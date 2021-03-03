<?php

namespace App\Http\Requests;

use App\Models\UniteRegional;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUniteRegionalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unite_regional_edit');
    }

    public function rules()
    {
        return [
            'name_complet'      => [
                'string',
                'required',
            ],
            'tel_1'             => [
                'string',
                'required',
            ],
            'tel_2'             => [
                'string',
                'nullable',
            ],
            'email' => [
                'required',
                'unique:unite_regionals,email,' . request()->route('unite_regional')->id,
            ],
            'profession'        => [
                'string',
                'required',
            ],
        ];
    }
}
