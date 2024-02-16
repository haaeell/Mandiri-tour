<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Pemesanan;
use App\Models\User;
use App\Notifications\KonfirmasiPembayaran;
use App\Notifications\KonfirmasiPembayaranNotification;
use App\Notifications\PemesananBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $pemesanan = Pemesanan::orderBy('created_at', 'desc')->get();
        return view('admin.pemesanan.index',compact('pemesanan'));
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
        
        $request->validate([
            'user_id' => 'required',
            'paket_id' => 'required',
            'jumlah_paket' => 'required|integer|min:1',
            'tanggal_keberangkatan' => 'required|date',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'File :attribute harus berupa gambar.',
        ]);
    
        $hargaPaket = PaketWisata::find($request->paket_id)->harga;
        $totalPembayaran = $hargaPaket * $request->jumlah_paket;
        // Simpan data ke dalam tabel wisata
        $pemesanan = Pemesanan::create([
            'user_id' => $request->user_id,
            'paket_id' => $request->paket_id,
            'jumlah_paket' => $request->jumlah_paket,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'bukti_pembayaran' => $request->file('bukti_pembayaran') ? $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public') : null,
            'status_pembayaran' => 'Menunggu Konfirmasi Admin',
            'total_pembayaran' => $totalPembayaran,
        ]);
    
    
        session()->flash('success', 'Pesanan berhasil dikirim');
        return response()->json(['message' => 'Pemesanan berhasil!', 'data' => $pemesanan]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function pesanPaket(Request $request)
    {
       
        $request->validate([
            'user_id' => 'required',
            'paket_id' => 'required',
            'jumlah_paket' => 'required|integer|min:1',
            'tanggal_keberangkatan' => 'required|date',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'alamat' => 'required|string',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'File :attribute harus berupa gambar.',
        ]);
    
        $hargaPaket = PaketWisata::find($request->paket_id)->harga;
        $totalPembayaran = $hargaPaket * $request->jumlah_paket;
        $uuid = Str::uuid();
        // Simpan data ke dalam tabel wisata
        $pemesanan = Pemesanan::create([
            'id' => $uuid,
            'user_id' => $request->user_id,
            'paket_id' => $request->paket_id,
            'jumlah_paket' => $request->jumlah_paket,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'bukti_pembayaran' => $request->file('bukti_pembayaran') ? $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public') : null,
            'total_pembayaran' => $totalPembayaran,
            'alamat' => $request->alamat,
        ]);
        $admin = User::where('role', 'admin')->first();
        $admin->notify(new PemesananBaru($pemesanan));
    
        session()->flash('success', 'Pesanan berhasil dibuat');
        return redirect()->route('pemesanan.invoice', $pemesanan->id);
    }
        public function invoice($id)
    {
        $pemesanan = Pemesanan::findorFail($id);

        return view('landingpage.pemesanan.invoice', compact('pemesanan'));
    }
    // PemesananController.php

public function uploadBukti(Request $request, $id)
{
    $pemesanan = Pemesanan::findOrFail($id);

    $request->validate([
        'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Simpan bukti pembayaran ke penyimpanan yang sesuai
    $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

    // Update informasi pembayaran
    $pemesanan->bukti_pembayaran = $path;
    $pemesanan->status_pembayaran = 'Menunggu Konfirmasi Admin';
    $pemesanan->save();

    $admin = User::where('role', 'admin')->first();
    $admin->notify(new KonfirmasiPembayaranNotification($pemesanan));

    return redirect()->route('riwayatPesanan')->with('success', 'Bukti Pembayaran berhasil diunggah!');
}
public function cancel($id)
{
    $pemesanan = Pemesanan::findOrFail($id);

    // Pastikan pengguna yang melakukan pembatalan adalah pemilik pemesanan
    if ($pemesanan->user_id != auth()->user()->id) {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk membatalkan pemesanan ini.');
    }

    // Tambahkan logika pembatalan pemesanan sesuai kebutuhan Anda
    // Contoh: Update status pembayaran dan status pembatalan
    $pemesanan->update([
        'status_pembayaran' => 'Pemesanan Dibatalkan',
    ]);

    return redirect()->route('riwayatPesanan')->with('success', 'Pemesanan berhasil dibatalkan.');
}

public function konfirmasiPembayaran($id)
{
    
    $pemesanan = Pemesanan::findOrFail($id);

    
    $pemesanan->update([
        'status_pembayaran' => 'Pembayaran Diterima',
    ]);

    $user = $pemesanan->user;
    $user->notify(new KonfirmasiPembayaran($pemesanan));
    $pemesananId = $pemesanan->id;
    Auth::user()->unreadNotifications->where('data.pemesanan_id', $pemesananId)->markAsRead();

    return redirect()->route('pemesanan.index')->with('success', 'Konfirmasi pembayaran berhasil.');
}

public function pemesananBaru()
{
    $unreadNotifications = Auth::user()->unreadNotifications;

    foreach ($unreadNotifications as $notification) {
        // Cek apakah notifikasi terkait dengan pemesanan yang sudah ditanggapi
        if ($notification->type === 'App\Notifications\PemesananBaru') {
            $notificationData = $notification->data;

            $notification->markAsRead();
        }
    }
    $pemesanan = Pemesanan::where('status_pembayaran', 'Belum Dibayar')
        ->latest() // Mengurutkan berdasarkan tanggal pembuatan terbaru
        ->get();

    return view('admin.pemesanan.pemesanan-baru', ['pemesanan' => $pemesanan]);
}

public function menungguKonfirmasi()
{
    $pemesanan = Pemesanan::where('status_pembayaran', 'Menunggu Konfirmasi Admin')
        ->whereNotNull('bukti_pembayaran') // Hanya ambil yang bukti pembayarannya sudah ada
        ->latest() // Mengurutkan berdasarkan tanggal pembuatan terbaru
        ->get();

    return view('admin.pemesanan.menunggu-konfirmasi', ['pemesanan' => $pemesanan]);
}
public function pesananDibatalkan()
{
    $pemesanan = Pemesanan::where('status_pembayaran', 'Pemesanan Dibatalkan')
        ->latest()
        ->get();

    return view('admin.pemesanan.pesanan-dibatalkan', ['pemesanan' => $pemesanan]);
}
public function pesananDiterima()
{
    $pemesanan = Pemesanan::where('status_pembayaran', 'Pembayaran Diterima')
        ->latest()
        ->get();

    return view('admin.pemesanan.pesanan-diterima', ['pemesanan' => $pemesanan]);
}
    
}
