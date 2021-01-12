<?php

namespace App\Http\Requests;

use App\Models\Training;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTrainingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('training_create');
    }

    public function rules()
    {
        return [
            'title'         => [
                'string',
                'nullable',
            ],
            'description'   => [
                'required',
            ],
            'price'         => [
                'numeric',
                'required',
            ],
            'date'          => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'location'      => [
                'required',
            ],
            'location_long' => [
                'string',
                'nullable',
            ],
            'location_lat'  => [
                'string',
                'nullable',
            ],
        ];
    }
}
