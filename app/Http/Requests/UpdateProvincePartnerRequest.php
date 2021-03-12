<?php

namespace App\Http\Requests;

use App\Models\ProvincePartner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProvincePartnerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('province_partner_edit');
    }

    public function rules()
    {
        return [
            'nom'         => [
                'string',
                'required',
            ],
            'tel_1'       => [
                'string',
                'nullable',
            ],
            'description' => [
                'required',
            ],
            'responsable' => [
                'string',
                'required',
            ],
            'email'       => [
                'required',
            ],
            'tel_2'       => [
                'string',
                'required',
            ],
            'region_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
