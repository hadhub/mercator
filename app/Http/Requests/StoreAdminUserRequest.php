<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreAdminUserRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('admin_user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'user_id' => [
                'min:3',
                'max:32',
                'required',
            ],
        ];
    }
}