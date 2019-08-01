<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCommentRequest extends FormRequest
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
            'author'         => 'required|min:3|max:200|regex:/^[А-ЯA-ZЄІЇЁ]{1}[a-zа-яєіїё]+\s+[А-ЯA-ZЄІЇЁ]{1}[a-zа-яєіїё]+$/u',
            'content'   =>  'min:3|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'author.required' => 'Введіть своє ім\'я',
            'author.min' => 'Ваше ім\'я має складатися мінімум з :min символів',
            'author.max' => 'Ваше ім\'я не повинно перевищувати :max символів',
            'author.regex' => 'Ваше ім\'я повинно складатися з 2 слів з великої літери,цифри ті інші знаки заборонені',
            'content.min'  => 'Коментар має складатися мінімум з :min символів',
            'content.max'  => 'Коментар не повинний перевищувати :max символів',

        ];
    }
}
