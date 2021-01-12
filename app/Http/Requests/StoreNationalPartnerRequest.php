<?php

namespace App\Http\Requests;

use App\Models\NationalPartner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNationalPartnerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('national_partner_create');
    }

    public function rules()
    {
        return [
            'nom'         => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'responsable' => [
                'string',
                'required',
            ],
            'tel'         => [
                'string',
                'nullable',
            ],
        ];
    }
}
