<?php

namespace App\Http\Requests;

use App\Models\PublicNews;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePublicNewsRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('public_news_edit');
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
