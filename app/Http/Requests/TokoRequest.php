<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokoRequest extends FormRequest
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
            'nama_toko' => 'required',
            'alamat' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nama_toko.required' => 'Nama Toko harus diisi.',
            'alamat.required' => 'Alamat Toko harus dipilih.',
            'image.required' => 'Logo Toko harus diunggah.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh melebihi 2048 KB.',
        ];
    }
}
