<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Konekt\AppShell\Http\Requests\HasFor;
use Modules\Admin\Contracts\Requests\CreateMedia as CreateMediaContract;

class CreateMedia extends FormRequest implements CreateMediaContract {

    use HasFor;


    /**
     * @inheritDoc
     */
    public function rules() {
        return [
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,pjpg,png,gif,webp'
        ];
    }

    /**
     * @inheritDoc
     */
    public function authorize() {
        return true;
    }

}
