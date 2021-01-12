<?php

namespace App\Http\Requests;

use App\Models\Profession;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProfessionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('profession_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
        ];
    }
}