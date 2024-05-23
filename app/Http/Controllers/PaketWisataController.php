<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Wisata;
use App\Models\Rundown;
use App\Models\Kendaraan;
use App\Models\PaketWisata;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaketWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = PaketWisata::with('wisatas')->orderBy('created_at', 'desc')->get();
        return view('admin.paket_wisata.index', compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wisatas = Wisata::all();
        $kotas = Kota::all();
        $categories = Kategori::all();
        $kendaraans = Kendaraan::all();
        return view('admin.paket_wisata.tambah', compact('kotas', 'wisatas', 'kendaraans', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'kendaraan_id' => 'required',
            'kotas' => 'required|array',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required',
            'durasi' => 'required',
            'wisatas' => 'required|array',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'File :attribute harus berupa gambar.',
            'mimes' => 'File :attribute harus memiliki format PNG, JPG, atau JPEG.',
            'max' => 'File :attribute tidak boleh lebih dari 2MB (2048 KB).',
            'array' => 'Kolom :attribute harus berupa array.',
        ]);

        $namaGambar = null;
        if ($image = $request->file('gambar')) {
            $path = 'images';
            $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($path, $namaGambar);
        }

        $slug = Str::slug($request->nama);
        $harga = str_replace('.', '', $request->harga);
        $harga = str_replace(',', '.', $harga);
        $harga = doubleval($harga);

        $wisata = PaketWisata::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $namaGambar,
            'fasilitas' => $request->fasilitas,
            'harga' => $harga,
            'kategori_id' => $request->kategori_id,
            'durasi' => $request->durasi,
            'kendaraan_id' => $request->kendaraan_id,
            'slug' => $slug,
        ]);

        $wisata->kotas()->attach($request->kotas);
        $wisata->wisatas()->attach($request->wisatas);


        session()->flash('success', 'Data berhasil ditambah');
        return redirect()->route('paket-wisata.index');
    }





    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paketWisata = PaketWisata::findOrFail($id);
        $rundownsGrouped = $paketWisata->rundowns->groupBy('hari_ke')->map(function ($rundowns) {
            return $rundowns->sortBy('mulai');
        });
        return view('admin.paket_wisata.show', compact('paketWisata', 'rundownsGrouped'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paketWisata = PaketWisata::findOrFail($id);

        $kotas = Kota::all();
        $wisatas = Wisata::all();
        $kendaraans = Kendaraan::all();
        $categories = Kategori::all();

        return view('admin.paket_wisata.edit', compact('paketWisata', 'kotas', 'wisatas', 'kendaraans', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kendaraan_id' => 'required',
            'kotas' => 'required|array',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas' => 'required',
            'harga' => 'required',
            'kategori_id' => 'required',
            'durasi' => 'required',
            'wisatas' => 'required|array',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'File :attribute harus berupa gambar.',
            'mimes' => 'File :attribute harus memiliki format PNG, JPG, atau JPEG.',
            'max' => 'File :attribute tidak boleh lebih dari 2MB (2048 KB).',
            'array' => 'Kolom :attribute harus berupa array.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
        ]);

        $paketWisata = PaketWisata::findOrFail($id);
        $harga = str_replace('.', '', $request->harga); 
        $harga = str_replace(',', '.', $harga); 
        $harga = doubleval($harga);


        if ($request->hasFile('gambar')) {
            $path = 'images';
            $namaGambar = date('YmdHis') . "." . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move($path, $namaGambar);
            $paketWisata->gambar = $namaGambar;
        }

        $paketWisata->nama = $request->nama;
        $paketWisata->deskripsi = $request->deskripsi;
        $paketWisata->fasilitas = $request->fasilitas;
        $paketWisata->harga = $harga;

        $paketWisata->kategori_id = $request->kategori_id;
        $paketWisata->durasi = $request->durasi;

        $paketWisata->kendaraan_id = $request->kendaraan_id;

        $paketWisata->kotas()->sync($request->kotas);
        $paketWisata->wisatas()->sync($request->wisatas);

        $paketWisata->save();

        return redirect()->route('paket-wisata.index')->with('success', 'Data berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $data = PaketWisata::findOrFail($id);

    if ($data->pemesanan()->exists()) {
        session()->flash('error', 'Data tidak bisa dihapus karena sudah dipakai di tabel pemesanan.');
        return redirect()->back();
    }

    $data->delete();
    session()->flash('success', 'Data berhasil dihapus');
    return redirect()->back();
}

}
