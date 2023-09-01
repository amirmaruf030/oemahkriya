<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use App\User;
use App\Province;
use App\Models\Alamat;
use App\Subdistrict;
use App\Http\Requests\Admin\AlamatRequest;
use Illuminate\Support\Facades\Auth;

class DashboardAlamatController extends Controller
{
    public function index()
    {
        $alamat = User::with(['alamat', 'shop'])->find(Auth::user()->id);
        $aktif = 'Alamat';

        return view('pages.user.alamat.index', compact('alamat', 'aktif'));
    }

    public function tambahAlamat()
    {
        $provinces = Province::pluck('name', 'province_id');
        $aktif = 'Alamat';

        return view('pages.user.alamat.tambah-alamat', compact('provinces', 'aktif'));
    }

    public function store(AlamatRequest $request)
    {
        $alamat = $request->all();
        $user = User::with(['alamat'])->findOrFail(Auth::user()->id);

        $alamat['users_id'] = Auth::user()->id;
        $alamat['provinsi'] = Province::where('province_id', $request->provinces_id)->first()->name;
        $alamat['kota'] = City::where('city_id', $request->city_id)->first()->city_name;
        $alamat['subdistrict_id'] = $request->kecamatan;
        $alamat['kecamatan'] = Subdistrict::where('subdistrict_id', $request->kecamatan)->first()->subdistrict_name;
        if ($user->alamat->first()) {
            $alamat['utama'] = 0;
        } else {
            $alamat['utama'] = 1;
        }
        $alamat['toko'] = 0;
        Alamat::create($alamat);

        return redirect()->route('dashboard-alamat');
    }

    public function editAlamat($id)
    {
        $alamat = Alamat::findOrFail($id);
        $provinces = Province::pluck('name', 'province_id');
        $aktif = 'Alamat';


        return view('pages.user.alamat.edit-alamat', compact('alamat', 'provinces', 'aktif'));
    }

    public function prosesEditAlamat(AlamatRequest $request)
    {
        $alamat = Alamat::findOrFail($request->idAlamat);

        if (isset($request->provinces_id)) {
            $data['provinces_id'] = $request->provinces_id;
            $data['provinsi'] = Province::where('province_id', $request->provinces_id)->first()->name;
            $data['city_id'] = $request->city_id;
            $data['kota'] = City::where('city_id', $request->city_id)->first()->city_name;
            $data['subdistrict_id'] = $request->kecamatan;
            $data['kecamatan'] = Subdistrict::where('subdistrict_id', $request->kecamatan)->first()->subdistrict_name;
        }
        $data['nama'] = $request->nama;
        $data['no_telp'] = $request->no_telp;
        $data['detail_alamat'] = $request->detail_alamat;
        $data['kode_pos'] = $request->kode_pos;
        $alamat->update($data);

        return redirect()->route('dashboard-alamat');
    }

    public function alamatUtama(Request $request)
    {
        $alamatUser = Alamat::where('users_id', Auth::user()->id)->get();

        foreach ($alamatUser as $items) {
            $alamat = Alamat::findOrFail($items->id);
            $data['utama'] = 0;
            $alamat->update($data);
        }
        $alamat = Alamat::findOrFail($request->utama);
        $data['utama'] = 1;

        $alamat->update($data);

        return redirect()->route('dashboard-alamat');
    }

    public function alamatToko(Request $request)
    {
        $alamatUser = Alamat::where('users_id', Auth::user()->id)->get();

        foreach ($alamatUser as $items) {
            $alamat = Alamat::findOrFail($items->id);
            $data['toko'] = 0;
            $alamat->update($data);
        }

        $alamat = Alamat::findOrFail($request->toko);
        $data['toko'] = 1;

        $alamat->update($data);

        $user = User::with(['shop'])->findOrFail(Auth::user()->id);
        $toko = $user->shop;
        $dataToko['no_telp_toko'] = $alamat->no_telp;
        $dataToko['provinces_id'] = $alamat->provinces_id;
        $dataToko['provinsi'] = $alamat->provinsi;
        $dataToko['city_id'] = $alamat->city_id;
        $dataToko['kota'] = $alamat->kota;
        $dataToko['kecamatan'] = $alamat->kecamatan;
        $dataToko['detail_alamat'] = $alamat->detail_alamat;
        $dataToko['kode_pos'] = $alamat->kode_pos;
        $toko->update($dataToko);

        return redirect()->route('dashboard-alamat');
    }

    public function destroy(Request $request)
    {
        $alamat = Alamat::findorFail($request->id);

        if ($alamat->utama == 1 && $alamat->toko == 1) {
            $alamat->delete();
            $setAlamat = Alamat::where('users_id', Auth::user()->id)->first();
            if (@empty($setAlamat)) {
                return redirect()->route('dashboard-alamat');
            }
            $data['utama'] = 1;
            $data['toko'] = 1;
            $setAlamat->update($data);
        } elseif ($alamat->utama == 1 && $alamat->toko == 0) {
            $alamat->delete();
            $setAlamat = Alamat::where('users_id', Auth::user()->id)->first();
            if (@empty($setAlamat)) {
                return redirect()->route('dashboard-alamat');
            }
            $data['utama'] = 1;
            $setAlamat->update($data);
        } elseif ($alamat->utama == 0 && $alamat->toko == 1) {
            $alamat->delete();
            $setAlamat = Alamat::where('users_id', Auth::user()->id)->first();
            if (@empty($setAlamat)) {
                return redirect()->route('dashboard-alamat');
            }
            $data['toko'] = 1;
            $setAlamat->update($data);
        } else {
            $alamat->delete();
        }

        return redirect()->route('dashboard-alamat');
    }
}
