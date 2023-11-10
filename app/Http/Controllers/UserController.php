<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
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

    $user = User::findOrFail($id);
    

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

    $user->update($data);

    session()->flash('success', 'Data berhasil diperbarui');
    return redirect()->back();
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
{
    $loggedInUserId = $request->user()->id; // Mendapatkan ID pengguna yang sedang login

    if ($id == $loggedInUserId) {
        session()->flash('error', 'Anda tidak dapat menghapus pengguna yang sedang login.');
        return redirect()->route('users.index');
    }

    $data = User::findOrFail($id);
    $data->delete();

    session()->flash('success', 'Data berhasil dihapus');
    return redirect()->route('users.index');
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
    public function resetPassword(Request $request)
{
    $validatedData = $request->validate([
        'new_password' => 'required|min:8',
        'confirm_password' => 'required|same:new_password',
    ], [
        'new_password.required' => 'Password baru diperlukan',
        'new_password.min' => 'Password harus memiliki minimal 8 karakter',
        'confirm_password.required' => 'Konfirmasi Password diperlukan',
        'confirm_password.same' => 'Konfirmasi Password harus sama dengan Password baru',
    ]);

    

        $user = User::find($request->user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        if ($validatedData['new_password'] !== $validatedData['confirm_password']) {
            session()->flash('error', 'Konfirmasi Password harus sama dengan Password baru');
            return redirect()->back();
        }
        session()->flash('success', 'Password Berhasil diReset');
        return redirect()->back();
}

public function exportToPDF()
{
    $users = User::where('role', 'customer')->get();

    $dompdf = new Dompdf();
    $dompdf->setPaper('A4', 'portrait');

    $html = view('admin.users.pdf', compact('users'))->render();

    $dompdf->loadHtml($html);

    $dompdf->render();

    return $dompdf->stream('customers.pdf');
}








}
