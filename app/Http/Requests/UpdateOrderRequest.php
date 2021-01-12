<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_edit');
    }

    public function rules()
    {
        return [
            'names.*'   => [
                'integer',
            ],
            'names'     => [
                'required',
                'array',
            ],
            'date'      => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'member_id' => [
                'required',
                'integer',
            ],
        ];
    }
}