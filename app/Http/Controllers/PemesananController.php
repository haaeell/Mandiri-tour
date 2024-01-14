<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Pemesanan;
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
            'jumlah_peserta' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'File :attribute harus berupa gambar.',
        ]);
    
        $hargaPaket = PaketWisata::find($request->paket_id)->harga;
        $totalPembayaran = $hargaPaket * $request->jumlah_peserta;
        // Simpan data ke dalam tabel wisata
        $pemesanan = Pemesanan::create([
            'user_id' => $request->user_id,
            'paket_id' => $request->paket_id,
            'jumlah_peserta' => $request->jumlah_peserta,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
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
            'jumlah_peserta' => 'required|integer|min:1',
            'tanggal_pemesanan' => 'required|date',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'image' => 'File :attribute harus berupa gambar.',
        ]);
    
        $hargaPaket = PaketWisata::find($request->paket_id)->harga;
        $totalPembayaran = $hargaPaket * $request->jumlah_peserta;
        $uuid = Str::uuid();
        // Simpan data ke dalam tabel wisata
        $pemesanan = Pemesanan::create([
            'id' => $uuid,
            'user_id' => $request->user_id,
            'paket_id' => $request->paket_id,
            'jumlah_peserta' => $request->jumlah_peserta,
            'tanggal_pemesanan' => $request->tanggal_pemesanan,
            'bukti_pembayaran' => $request->file('bukti_pembayaran') ? $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public') : null,
            'status_pembayaran' => 'Menunggu Konfirmasi Admin',
            'total_pembayaran' => $totalPembayaran,
        ]);
    
    
        session()->flash('success', 'Pesanan berhasil dibuat');
        return redirect()->route('pemesanan.invoice', $pemesanan->id);
    }
        public function invoice($id)
    {
        $pemesanan = Pemesanan::findorFail($id);
        // dd($pemesanan);

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

    return redirect()->route('pemesanan.index')->with('error', 'Konfirmasi pembayaran berhasil.');
}

    
}
