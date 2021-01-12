<?php

namespace App\Http\Requests;

use App\Models\Etablissement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEtablissementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('etablissement_create');
    }

    public function rules()
    {
        return [
            'name_complet'       => [
                'string',
                'required',
            ],
            'tel_1'              => [
                'string',
                'required',
            ],
            'tel_2'              => [
                'string',
                'nullable',
            ],
            'email_professionel' => [
                'required',
                'unique:etablissements',
            ],
            'image'              => [
                'required',
            ],
        ];
    }
}