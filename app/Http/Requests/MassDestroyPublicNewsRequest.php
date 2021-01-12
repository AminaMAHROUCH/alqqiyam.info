<?php

namespace App\Http\Requests;

use App\Models\PublicNews;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPublicNewsRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('public_news_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:public_news,id',
        ];
    }
}
