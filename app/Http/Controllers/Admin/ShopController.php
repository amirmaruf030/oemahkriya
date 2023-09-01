<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TokoRequest;
use Illuminate\Http\Request;
use App\User;
use App\Models\Alamat;
use App\Shop;
use App\Models\SaldoShop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ShopController extends Controller
{
    public function index()
    {
        $dataUser = User::with(['alamat', 'shop'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } else {
            if (isset($dataUser->shop)) {
                return redirect()->route('admin-dashboard');
            } else {
                return view('pages.admin.toko', ([
                    'alamat' => $dataUser->alamat
                ]));
            }
        }
    }

    public function store(TokoRequest $request)
    {
        $alamat = Alamat::find($request->alamat);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nama_file = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/assets/toko', $nama_file);

            $dataToko = Shop::create([
                'users_id' => Auth::user()->id,
                'nama_toko' => $request->nama_toko,
                'stts_toko' => 1,
                'no_telp_toko' => $alamat->no_telp,
                'image' => 'assets/toko/' . $nama_file,
                'provinces_id' => $alamat->provinces_id,
                'provinsi' => $alamat->provinsi,
                'city_id' => $alamat->city_id,
                'kota' => $alamat->kota,
                'kecamatan' => $alamat->kecamatan,
                'detail_alamat' => $alamat->detail_alamat,
                'kode_pos' => $alamat->kode_pos

            ]);
        }

        // Ubah Tanda Toko Pada Alamat
        $setAlamat['toko'] = 1;
        $alamat->update($setAlamat);

        // Buat saldo toko
        $dataSaldo['shops_id'] = $dataToko->id;
        $dataSaldo['saldo'] = 0;
        SaldoShop::create($dataSaldo);

        return redirect()->route('admin-dashboard');
    }

    public function update(Request $request, $id)
    {
        $dataToko = Shop::findOrFail(Crypt::decrypt($id));
        $gambar = $request->file('image');
        if (isset($gambar)) {
            $nama_file = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/assets/toko', $nama_file);
            $data['image'] = 'assets/toko/' . $nama_file;
        }
        $data['nama_toko'] = $request->nama_toko;
        $data['stts_toko'] = $request->stts_toko;

        $dataToko->update($data);

        return redirect()->route('pengaturan-toko');
    }

    public function pengaturanToko()
    {
        // Pengecekan
        $dataUser = User::with(['alamat', 'shop'])->findOrFail(Auth::user()->id);
        if (@empty($dataUser->alamat)) {
            return redirect()->route('dashboard-alamat');
        } elseif (@empty($dataUser->shop)) {
            return redirect()->route('toko.index');
        }

        return view('pages.admin.pengaturan-toko', [
            'dataToko' => $dataUser->shop
        ]);
    }
}
