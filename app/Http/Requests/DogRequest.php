<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DogRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'dogName'     => 'required|string|max:255',
            'sizeId'      => 'required|integer|exists:sizes,id',
            'originId'    => 'required|integer|exists:origins,id',
            'description' => 'required|string',
        ];

        //登録処理の時だけdogImgをrequired(必須項目)にする
        if ($this->isMethod('post')) {
            $rules['dogImg'] ='required|image|mimes:jpeg,png,jpg|max:2048';
        } else {
            $rules['dogImg'] ='nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'dogName'     => '犬の名前',
            'sizeId'      => 'サイズ',
            'originId'    => '原産国',
            'description' => '説明文',
            'dogImg'      => '画像',
        ];
    }
}
