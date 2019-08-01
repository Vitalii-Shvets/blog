<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostCreateUpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:500',
            'content' => 'min:10|max:1000',
            'uploads-file' => 'max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Введіть ім\'я поста',
            'name.min' => 'Ім\'я поста має складатися мінімум з :min символів',
            'name.max' => 'Ім\'я поста не повинно перевищувати :max символів',
            'content.min' => 'Опис поста має складатися мінімум з :min символів',
            'content.max' => 'Опис поста не повинний перевищувати :max символів',
            'uploads-file.max' => 'Розмір файла не повинен перевищувати :size кілобайт',
        ];
    }
}
