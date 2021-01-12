<?php

namespace App\Http\Requests;

use App\Models\UnitDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUnitDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unit_detail_create');
    }

    public function rules()
    {
        return [
            'title'       => [
                'string',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}