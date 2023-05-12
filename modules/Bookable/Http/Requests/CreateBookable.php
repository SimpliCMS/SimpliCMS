<?php

namespace Modules\Bookable\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Bookable\Contracts\Requests\CreateBookable as CreateBookableContract;
use Modules\Bookable\Models\BookableStateProxy;

class CreateBookable extends FormRequest implements CreateBookableContract
{
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'sku' => 'nullable|unique:products',
            'state' => ['required', Rule::in(BookableStateProxy::values())],
            'price' => 'nullable|numeric',
            'original_price' => 'sometimes|nullable|numeric',
            'stock' => 'nullable|numeric',
            'images' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,pjpg,png,gif,webp'
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
    }
}