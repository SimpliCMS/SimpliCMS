<?php

namespace Modules\Bookable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Bookable\Contracts\Requests\UpdateBookable as UpdateBookableContract;
use Modules\Bookable\Models\BookableStateProxy;

class UpdateBookable extends FormRequest implements UpdateBookableContract {

    public function rules() {
        return [
            'name' => 'required|min:2|max:255',
            'state' => ['required', Rule::in(BookableStateProxy::values())],
            'price' => 'nullable|numeric',
            'original_price' => 'sometimes|nullable|numeric',
            'stock' => 'nullable|numeric',
            'images' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,pjpg,png,gif,webp'
        ];
    }

    public function authorize() {
        return true;
    }

    protected function prepareForValidation() {
        
    }

}
