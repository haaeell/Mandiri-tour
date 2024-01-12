<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index()
    {
        $keluhan = Keluhan::orderBy('created_at', 'desc')->get();
        return view('admin.keluhan.index',compact('keluhan'));
    }
    public function store(Request $request)
{
    $messages = [
        'required' => 'Kolom :attribute harus diisi.',
    ];

    $request->validate([
        'subject' => 'required|string|max:255',
        'description' => 'required|string',
    ], $messages);

    // Simpan keluhan ke database
    Keluhan::create([
        'subject' => $request->subject,
        'description' => $request->description,
        'user_id' => auth()->user()->id,
        'status' => 'pending',
    ]);

    return response()->json(['message' => 'Keluhan berhasil dikirim']);
}
public function prosesTanggapi(Request $request, $id)
{
    $request->validate([
        'admin_response' => 'required|string',
    ]);

    $keluhan = Keluhan::findOrFail($id);
    $keluhan->admin_response = $request->admin_response;
    $keluhan->status = 'resolved';
    $keluhan->save();

    return redirect()->route('keluhan.index-admin')->with('success', 'Keluhan berhasil ditanggapi.');
}

}
