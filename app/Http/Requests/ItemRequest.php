<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,category_id',
            'item_code' => 'required|string|max:10|unique:items,item_code',
            'item_name' => 'required|string|max:100',
            'item_buy_price' => 'required|numeric',
            'item_sell_price' => 'required|numeric',
        ];
    }
}
