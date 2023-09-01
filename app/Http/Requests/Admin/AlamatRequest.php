<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AlamatRequest extends FormRequest
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
            'nama' => 'required',
            'no_telp' => 'required',
            'provinces_id' => 'required',
            'city_id' => 'required',
            'kecamatan' => 'required',
            'detail_alamat' => 'required',
            'kode_pos' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'no_telp.required' => 'Nomor telepon harus diisi.',
            'provinces_id.required' => 'Provinsi harus diisi.',
            'city_id.required' => 'Kota harus diisi.',
            'kecamatan.required' => 'Kecamatan harus diisi.',
            'detail_alamat.required' => 'Detail alamat harus diisi.',
            'kode_pos.required' => 'Kode pos harus diisi.',
        ];
    }
}
