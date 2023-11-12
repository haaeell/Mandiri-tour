<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Wisata;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wisata = Wisata::with('kota')->get();
        $kota = Kota::all();
        return view('admin.wisata.index',compact('wisata','kota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'File :attribute harus berupa gambar.',
            'mimes' => 'File :attribute harus memiliki format PNG, JPG, atau JPEG.',
            'max' => 'File :attribute tidak boleh lebih dari 2MB (2048 KB).',
        ];
        $data = $request->validate([
            'nama' => 'required',
            'kota_id' => 'required',
            'deskripsi' => 'required',
             'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ], $messages);
    
        if ($image = $request->file('gambar')) {
            $path = 'images';
            $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($path, $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        Wisata::create($data);

        return response()->json(['message' => 'Data berhasil disimpan']);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $messages = [
        'required' => 'Kolom :attribute harus diisi.',
        'image' => 'File :attribute harus berupa gambar.',
        'mimes' => 'File :attribute harus memiliki format PNG, JPG, atau JPEG.',
        'max' => 'File :attribute tidak boleh lebih dari 2MB (2048 KB).',
    ];

    $data = $request->validate([
        'nama' => 'required',
        'kota_id' => 'required',
        'deskripsi' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ], $messages);

    $wisata = Wisata::findOrFail($id);

    if ($request->hasFile('gambar')) {
        $image = $request->file('gambar');
        $path = 'images';
        $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($path, $namaGambar);
        $data['gambar'] = $namaGambar;
    }

    $wisata->update($data);
    session()->flash('success', 'Data berhasil diperbarui');
    return redirect()->back();
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Wisata::findorFail($id);
         $data->delete();
         session()->flash('success', 'Data berhasil dihapus');
         return redirect()->back();
    }
}
