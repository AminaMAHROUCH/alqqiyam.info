<?php

namespace App\Http\Requests;

use App\Models\ProvincePartner;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProvincePartnerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('province_partner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:province_partners,id',
        ];
    }
}
