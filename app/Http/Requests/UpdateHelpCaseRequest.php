<?php

namespace App\Http\Requests;

use App\Models\HelpCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHelpCaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('help_case_edit');
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
            'video'       => [
                'string',
                'nullable',
            ],
        ];
    }
}