<?php

namespace App\Http\Requests;

use App\Models\PrivateNews;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePrivateNewsRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('private_news_edit');
    }

    public function rules()
    {
        return [
            'title'        => [
                'string',
                'required',
            ],
            'published_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'content'      => [
                'required',
            ],
            'video'        => [
                'string',
                'nullable',
            ],
        ];
    }
}
