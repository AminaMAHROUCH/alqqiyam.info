<?php

namespace App\Http\Requests;

use App\Models\NationalPartner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNationalPartnerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('national_partner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:national_partners,id',
        ];
    }
}