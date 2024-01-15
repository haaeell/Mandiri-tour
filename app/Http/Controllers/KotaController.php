<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kota = Kota::all();
    return view('admin.kota.index',compact('kota'));
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
        ];
    
        $data = $request->validate([
            'nama' => 'required',
        ], $messages);
        Kota::create($data);

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
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
        ];
    
        $data = $request->validate([
            'nama' => 'required',
        ], $messages);
        $kota = Kota::findOrFail($id);
        $kota->update($data);

        return redirect()->back()->with('success', 'Kota berhasil diUpdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $data = Kota::with('wisata')->find($id);

    if ($data->wisata->isNotEmpty()) {
        // Ada data terhubung dengan tabel Wisata
        session()->flash('warning', 'Terdapat data terhubung di tabel Wisata. Anda tidak bisa menghapus data ini.');
    } else {
        $data->forceDelete(); // Penghapusan permanen jika tidak ada keterkaitan
        session()->flash('success', 'Data berhasil dihapus secara permanen');
    }

    return redirect()->back();
}

}
