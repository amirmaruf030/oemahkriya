<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    public function index()
    {
        $kategori = Category::orderBy('created_at', 'desc')->get();

        return view('pages.admin.category.index', [
            'kategori' => $kategori
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $data['photo'] = $request->file('photo')->store('assets/category', 'public');

        Category::create($data);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $cekImage = $request->file('photo');
        $dataKategori = Category::findOrFail(Crypt::decrypt($id));

        if (isset($cekImage)) {
            $data['photo'] = $request->file('photo')->store('assets/category', 'public');
            Storage::delete('public/' . $dataKategori->photo);
        }
        $data['slug'] = Str::slug($request->name);
        $dataKategori->update($data);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $item = Category::findorFail(Crypt::decrypt($id));
        $item->delete();

        return redirect()->route('category.index');
    }
}
