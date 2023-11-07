<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
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
        'min' => 'Kolom :attribute harus memiliki nilai minimal :min.',
    ];
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'password' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'role' => 'required',
        'address' => 'required',
    ], $messages);

    
    if ($image = $request->file('image')) {
        $path = 'images';
        $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($path, $namaGambar);
        $data['image'] = $namaGambar;
    }

    User::create($data);

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
        'min' => 'Kolom :attribute harus memiliki nilai minimal :min.',
    ];

    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'role' => 'required',
        'address' => 'required',
    ], $messages);

    // Untuk memperbarui data pengguna, pertama kita harus mengambil data pengguna yang akan diperbarui.
    $user = User::findOrFail($id);

    // Jika ada file gambar baru yang diunggah, simpan gambar baru dan hapus gambar lama.
    if ($image = $request->file('image')) {
        $path = 'images';
        $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($path, $namaGambar);

        // Hapus gambar lama jika ada
        if (!empty($user->image) && Storage::exists($user->image)) {
            Storage::delete($user->image);
        }

        $data['image'] = $namaGambar;
    }

    // Perbarui data pengguna yang ada.
    $user->update($data);

    return response()->json(['message' => 'Data berhasil diperbarui']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
{
    
    $data = User::findorFail($id);
    $data->delete();

    return response()->json(['message' => 'Data berhasil dihapus']);
}

    public function batchDelete(Request $request)
{
    $selectedItems = $request->input('selectedItems');
    
    if (!empty($selectedItems)) {
        User::whereIn('id', $selectedItems)->delete();
        return redirect()->back()->with('success', 'Item-item yang dipilih berhasil dihapus.');
    } else {
        return redirect()->back()->with('error', 'Tidak ada item yang dipilih untuk dihapus.');
    }
}



}
