<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\User;
use App\Notifications\KeluhanBaruNotification;
use App\Notifications\KeluhanDitanggapiNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    $keluhan = Keluhan::create([
        'subject' => $request->subject,
        'description' => $request->description,
        'user_id' => auth()->user()->id,
        'status' => 'pending',
    ]);

    $admin = User::where('role', 'admin')->first();
    $admin->notify(new KeluhanBaruNotification($keluhan));
    return redirect()->back()->with('success', 'Keluhan berhasil dikirim.');

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

    $user = $keluhan->user;
    $user->notify(new KeluhanDitanggapiNotification($keluhan));
    $keluhanId = $keluhan->id;

    Auth::user()->unreadNotifications->where('data.keluhan_id', $keluhanId)->markAsRead();

    return redirect()->route('keluhan.index-admin')->with('success', 'Keluhan berhasil ditanggapi.');
}


}
