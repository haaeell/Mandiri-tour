<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Kota;
use App\Models\PaketWisata;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaketWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = PaketWisata::with('wisatas')->get();
        return view('admin.paket_wisata.index',compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wisatas = Wisata::all();
        $kotas = Kota::all();
        $kendaraans = Kendaraan::all();
        return view('admin.paket_wisata.tambah', compact('kotas','wisatas','kendaraans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    
    $request->validate([
        'nama' => 'required',
        'kendaraan_id' => 'required', // Menambahkan validasi untuk kendaraan_id
        'kotas' => 'required|array',
        'deskripsi' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'fasilitas' => 'required',
        'harga' => 'required',
        'kategori' => 'required',
        'durasi' => 'required',
        'wisatas' => 'required|array',
    ], [
        'required' => 'Kolom :attribute harus diisi.',
        'image' => 'File :attribute harus berupa gambar.',
        'mimes' => 'File :attribute harus memiliki format PNG, JPG, atau JPEG.',
        'max' => 'File :attribute tidak boleh lebih dari 2MB (2048 KB).',
        'array' => 'Kolom :attribute harus berupa array.',
    ]);

    // Simpan gambar
    $namaGambar = null;
    if ($image = $request->file('gambar')) {
        $path = 'images';
        $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($path, $namaGambar);
    }

    $slug = Str::slug($request->nama);
    $harga = str_replace('.', '', $request->harga); // Menghapus titik sebagai pemisah ribuan
$harga = str_replace(',', '.', $harga); // Mengganti koma dengan titik sebagai tanda desimal
$harga = doubleval($harga);

    // Simpan data ke dalam tabel wisata
    $wisata = PaketWisata::create([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'gambar' => $namaGambar,
        'fasilitas' => $request->fasilitas,
        'harga' => $harga,
        'kategori' => $request->kategori,
        'durasi' => $request->durasi,
        'kendaraan_id' => $request->kendaraan_id, // Menambahkan kendaraan_id
        'slug' => $slug,
    ]);

    // Attach relasi kotas dan wisatas
    $wisata->kotas()->attach($request->kotas);
    $wisata->wisatas()->attach($request->wisatas);

    session()->flash('success', 'Data berhasil ditambah');
    return redirect()->route('paket-wisata.index');
}




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    // Mendapatkan data paket wisata berdasarkan ID
    $paketWisata = PaketWisata::findOrFail($id);

    // Mendapatkan data kota dan wisata untuk dipilih pada form
    $kotas = Kota::all();
    $wisatas = Wisata::all();
    $kendaraans = Kendaraan::all();

    // Menampilkan halaman edit dengan membawa data yang diperlukan
    return view('admin.paket_wisata.edit', compact('paketWisata', 'kotas', 'wisatas','kendaraans'));
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
            'kategori' => 'required',
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
        $harga = str_replace('.', '', $request->harga); // Menghapus titik sebagai pemisah ribuan
$harga = str_replace(',', '.', $harga); // Mengganti koma dengan titik sebagai tanda desimal
$harga = doubleval($harga); // Konversi ke angka


    
        // Simpan gambar jika ada perubahan
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

        $paketWisata->kategori = $request->kategori;
        $paketWisata->durasi = $request->durasi;
    
        // Tambahkan relasi kendaraan
        $paketWisata->kendaraan_id = $request->kendaraan_id;
    
        // Sync relasi kotas dan wisatas
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
        $data = PaketWisata::findorFail($id);
         $data->delete();
         session()->flash('success', 'Data berhasil dihapus');
         return redirect()->back();
    }

    
}
