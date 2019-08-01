<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryCreateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|min:3|max:200|unique:blog_posts',
            'description'   =>  'min:3|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Введіть ім\'я категорії',
            'name.min' => 'Ім\'я категорії має складатися мінімум з :min символів',
            'name.max' => 'Ім\'я категорії не повинно перевищувати :max символів',
            'description.min'  => 'Опис категорії має складатися мінімум з :min символів',
            'description.max'  => 'Опис категорії не повинний перевищувати :max символів',
        ];
    }
}
