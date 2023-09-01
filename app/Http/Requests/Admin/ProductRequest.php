<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'categories_id' => 'required|exists:categories,id',
            'harga' => 'required|integer',
            'description' => 'required',
            'berat' => 'required',
            'stok' => 'required',
            'photos' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh melebihi 255 karakter.',
            'categories_id.required' => 'Kategori harus dipilih.',
            'categories_id.exists' => 'Kategori yang dipilih tidak valid.',
            'harga.required' => 'Harga harus diisi.',
            'harga.integer' => 'Harga harus berupa angka.',
            'description.required' => 'Deskripsi harus diisi.',
            'berat.required' => 'Berat harus diisi.',
            'stok.required' => 'Stok harus diisi.',
            'photos.required' => 'Foto harus diunggah.',
        ];
    }
}
