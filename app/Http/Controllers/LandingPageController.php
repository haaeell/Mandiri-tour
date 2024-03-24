<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Keluhan;
use App\Models\Kendaraan;
use App\Models\Pemesanan;
use App\Models\PaketWisata;
use App\Models\User;
use App\Models\Wisata;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class LandingPageController extends Controller
{
    public function index()
    {
        $paketwisata = PaketWisata::all();
        $kategori = Kategori::all();

        return view('landingpage.welcome', compact('paketwisata','kategori'));
    }
    public function keluhan()
    {
        // Dapatkan keluhan yang belum dibaca oleh pengguna
        $unreadNotifications = Auth::user()->unreadNotifications;

        foreach ($unreadNotifications as $notification) {
            // Cek apakah notifikasi terkait dengan keluhan yang sudah ditanggapi
            if ($notification->type === 'App\Notifications\KeluhanDitanggapiNotification') {
                $notificationData = $notification->data;

                $notification->markAsRead();
            }
        }

        // Dapatkan riwayat keluhan untuk ditampilkan di halaman
        $riwayatKeluhan = Keluhan::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('landingpage.keluhan', compact('riwayatKeluhan'));
    }


    public function paketWisata(Request $request)
    {
        $search = $request->keyword;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $city_id = $request->city;
        $kendaraan_id = $request->kendaraan;

        $query = PaketWisata::query();

        if (!empty($search)) {
            $query->where('nama', 'LIKE', '%' . $search . '%');
        }

        if (!empty($min_price)) {
            $query->where('harga', '>=', $min_price);
        }

        if (!empty($max_price)) {
            $query->where('harga', '<=', $max_price);
        }

        if (!empty($city_id)) {
            $query->whereHas('kotas', function ($q) use ($city_id) {
                $q->where('kota_id', $city_id);
            });
        }

        if (!empty($kendaraan_id)) {
            $query->whereHas('kendaraan', function ($q) use ($kendaraan_id) {
                $q->where('kendaraan_id', $kendaraan_id);
            });
        }

        $paketWisata = $query->get();

        $kotas = Kota::all();
        $kendaraan = Kendaraan::all();
        $nama_kota = Kota::find($city_id)->nama ?? '';
        $nama_kendaraan = Kendaraan::find($kendaraan_id)->nama ?? '';

        $paketTerpopuler = PaketWisata::select('paket_wisata.*')
            ->join('pemesanan', 'paket_wisata.id', '=', 'pemesanan.paket_id')
            ->groupBy('paket_wisata.id')
            ->orderByRaw('COUNT(pemesanan.id) DESC')
            ->take(3)
            ->get();

        return view('landingpage.paketwisata', compact('paketWisata', 'kotas', 'search', 'min_price', 'max_price', 'city_id', 'kendaraan_id', 'nama_kota', 'nama_kendaraan', 'paketTerpopuler', 'kendaraan'));
    }

    public function detailPaket($slug)
    {
        $paketWisata = PaketWisata::where('slug', $slug)->firstOrFail();
        $rundownsGrouped = $paketWisata->rundowns->groupBy('hari_ke')->map(function ($rundowns) {
            return $rundowns->sortBy('mulai');
        });
        return view('landingpage.detailPaket', compact('paketWisata', 'rundownsGrouped'));
    }
    public function detailPaketForm($slug)
    {
        $paketWisata = PaketWisata::where('slug', $slug)->firstOrFail();
        $rundownsGrouped = $paketWisata->rundowns->groupBy('hari_ke')->map(function ($rundowns) {
            return $rundowns->sortBy('mulai');
        });
        return view('landingpage.pemesanan.detailPaketForm', compact('paketWisata', 'rundownsGrouped'));
    }
    public function riwayatPesanan()
    {
        $unreadNotifications = Auth::user()->unreadNotifications;

        foreach ($unreadNotifications as $notification) {
            // Cek apakah notifikasi terkait dengan keluhan yang sudah ditanggapi
            if ($notification->type === 'App\Notifications\KonfirmasiPembayaran') {
                $notificationData = $notification->data;

                $notification->markAsRead();
            }
        }

        $riwayatPesanan = Pemesanan::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('landingpage.pemesanan.riwayatPesanan', compact('riwayatPesanan'));
    }

    public function wisata()
    {
        
        return view('landingpage.wisata');
    }

    
    
    public function about()
    {
        return view('landingpage.about');
    }

    public function editProfil($id)
    {
        // Pastikan pengguna hanya dapat mengedit profil mereka sendiri
        if ($id != auth()->user()->id) {
            return redirect()->route('home')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
        }

        $user = User::findOrFail($id);

        return view('landingpage.edit-profil', compact('user'));
    }

    public function updateProfil(Request $request, $id)
    {
    //    dd($request);
        $messages = [
            'required' => 'Kolom :attribute harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ];
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 

        ], $messages);

        if ($id != auth()->user()->id) {
            return redirect()->route('home')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
        }

       

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = 'images';
            $namaGambar = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($path, $namaGambar);
    
            // Hapus gambar lama jika ada
            if (!empty($user->image) && Storage::exists($user->image)) {
                Storage::delete($user->image); // Hapus gambar dari direktori penyimpanan
            }
    
            $user->image = $namaGambar;
        } else {
            // Jika input gambar kosong, hapus gambar di database dan dari direktori penyimpanan
            if (!empty($user->image) && Storage::exists($user->image)) {
                Storage::delete($user->image); // Hapus gambar dari direktori penyimpanan
            }
            $user->image = null;
        }
    
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function hapusGambarProfil(Request $request)
{
    $userId = Auth::user()->id;
    $user = User::findOrFail($userId);
    $user->update(['image' => null]);

    return response()->json(['message' => 'Gambar profil berhasil dihapus']);
}

    public function editPassword($id)
    {
        if ($id != auth()->user()->id) {
            return redirect()->route('home')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
        }

        $user = User::findOrFail($id);

        return view('landingpage.edit-password', compact('user'));
    }
    public function updatePassword(Request $request, $id)
{
    $messages = [
        'required' => 'Kolom :attribute harus diisi.',
        'min' => 'Kolom :attribute harus memiliki minimal :min karakter.',
        'confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ], $messages);

    $user = User::findOrFail($id);

    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error', 'Password saat ini salah.');
    }

    $user->password = bcrypt($request->password);
    $user->save();

    return redirect()->route('customer.edit-password', $id)->with('success', 'Password berhasil diperbarui.');
}

public function fetchWisata(Request $request)
{
    $kotaId = $request->query('kota_id');

    // Jika kota ID disertakan, ambil hanya wisata yang terkait dengan kota tersebut
    if ($kotaId) {
        $wisatas = Wisata::where('kota_id', $kotaId)->get();
    } else {
        // Jika tidak ada kota ID, ambil semua data wisata
        $wisatas = Wisata::all();
    }

    // Format data untuk JSON response
    $formattedWisatas = $wisatas->map(function ($wisata) {
        return [
            'nama' => $wisata->nama,
            'deskripsi' => $wisata->deskripsi,
            'kota' => $wisata->kota->nama,
            'gambar' => asset('/images/'.$wisata->gambar) // Menambahkan URL gambar
        ];
    });

    return response()->json($formattedWisatas);
}

public function fetchKota()
{
    $kotas = Kota::all();
    return response()->json($kotas);
}


}
