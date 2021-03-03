<?php

namespace App\Http\Requests;

use App\Models\UniteRegional;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUniteRegionalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unite_regional_create');
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
                'unique:unite_regionals',
            ],
            'password'          => [
                'required',
            ],
            'image'             => [
                'required',
            ],
            'profession'        => [
                'string',
                'required',
            ],
        ];
    }
}
