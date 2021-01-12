<?php

namespace App\Http\Requests;

use App\Models\Directorate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDirectorateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('directorate_edit');
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
