<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'name'         => [
                'string',
                'required',
            ],
            'description'  => [
                'required',
            ],
            'price'        => [
                'numeric',
                'required',
            ],
            'quantity'     => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tutorial'     => [
                'required',
            ],
            'category_id'  => [
                'required',
                'integer',
            ],
            'brand_id'     => [
                'required',
                'integer',
            ],
            'adress'       => [
                'required',
            ],
            'address_long' => [
                'string',
                'nullable',
            ],
            'adress_lat'   => [
                'string',
                'nullable',
            ],
        ];
    }
}
