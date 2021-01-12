<?php

namespace App\Http\Requests;

use App\Models\Member;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_create');
    }

    public function rules()
    {
        return [
            'name'             => [
                'string',
                'required',
            ],
            'siret'            => [
                'string',
                'required',
            ],
            'raison_social'    => [
                'string',
                'required',
            ],
            'email'            => [
                'required',
            ],
            'password'         => [
                'required',
            ],
            'tel'              => [
                'string',
                'required',
            ],
            'presentations'    => [
                'string',
                'required',
            ],
            'specialities'     => [
                'string',
                'required',
            ],
            'social_media'     => [
                'string',
                'required',
            ],
            'salone_name'      => [
                'string',
                'required',
            ],
            'salone_long'      => [
                'string',
                'nullable',
            ],
            'salone_lat'       => [
                'string',
                'nullable',
            ],
            'adress'           => [
                'required',
            ],
            'account_progress' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'type'             => [
                'required',
            ],
        ];
    }
}
