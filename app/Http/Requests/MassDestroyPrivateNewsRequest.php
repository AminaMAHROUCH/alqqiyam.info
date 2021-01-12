<?php

namespace App\Http\Requests;

use App\Models\PrivateNews;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPrivateNewsRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('private_news_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:private_news,id',
        ];
    }
}