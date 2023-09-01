<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductGalleryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->file('photos') as $photo) {
            $data['photos'] = $photo->store('assets/product', 'public');
            $data['products_id'] = $request->idProduk;
            ProductGallery::create($data);
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $dataImage = ProductGallery::findOrFail(Crypt::decrypt($id));
        $gambar = $request->file('photos');
        if ($gambar) {
            $nama_file = time() . '.' . $gambar->getClientOriginalExtension();

            // simpan file pada direktori storage/app/public
            $gambar->storeAs('public/assets/product', $nama_file);
            // Simpan nama file di field photos
            $data['photos'] = 'assets/product/' . $nama_file;

            $dataImage->update($data);

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataImage = ProductGallery::findOrFail(Crypt::decrypt($id));
        $dataImage->delete();

        return redirect()->back();
    }
}
