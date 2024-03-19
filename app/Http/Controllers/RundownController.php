<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use App\Models\Rundown;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class RundownController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $paketWisata = PaketWisata::findOrFail($id);
        return view('admin.rundown.tambah',compact('paketWisata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    

     public function store(Request $request)
     {
        //  $request->validate([
        //      'paket_wisata_id' => 'required|exists:paket_wisata,id',
        //      'hari_ke.*' => 'required|integer|min:1',
        //      'mulai.*' => 'required|date_format:H:i',
        //      'selesai.*' => 'required|date_format:H:i|after:mulai',
        //      'deskripsi.*' => 'required|string|max:255',
        //  ]);
 
         
         $activities = [];
         foreach ($request->hari_ke as $key => $hari) {
             $activities[] = [
                 'paket_wisata_id' => $request->paket_wisata_id,
                 'hari_ke' => $request->hari_ke[$key],
                 'mulai' => $request->mulai[$key],
                 'selesai' => $request->selesai[$key],
                 'deskripsi' => $request->deskripsi[$key],
             ];
         }
 
         Rundown::insert($activities);
 
         session()->flash('success', 'Rundown berhasil ditambah');
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
    $paketWisata = PaketWisata::findOrFail($id);
    $rundowns = Rundown::where('paket_wisata_id', $id)->get();

    // Kirim data paket wisata dan rundown ke view
    return view('admin.rundown.edit', compact('paketWisata', 'rundowns'));
}

public function updateRundown(Request $request, $id)
{
    
    if ($request->has('hari_ke')) {
        foreach ($request->hari_ke as $key => $value) {
            Rundown::updateOrCreate(
                ['id' => $request->activity_id[$key]], // Kriteria pencarian
                [   // Data yang akan diperbarui atau dibuat baru
                    'paket_wisata_id' => $request->paket_wisata_id,
                    'hari_ke' => $value,
                    'mulai' => $request->mulai[$key],
                    'selesai' => $request->selesai[$key],
                    'deskripsi' => $request->deskripsi[$key],
                ]
            );
        }
    }

    session()->flash('success', 'Rundown berhasil diperbarui');
    return redirect()->route('paket-wisata.index');
}




public function deleteActivity(Request $request)
{
    $activityId = $request->activity_id;
    Rundown::findOrFail($activityId)->delete();

    return response()->json(['success' => true]);
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deleteAll($id)
{
    // Lakukan penghapusan semua rundown untuk paket wisata dengan ID tertentu
    Rundown::where('paket_wisata_id', $id)->delete();

    session()->flash('success', 'Semua Rundown Berhasil Dihapus');
    return redirect()->route('paket-wisata.index');
}


public function generatePdf($id)
    {
        // Mendapatkan paket wisata berdasarkan ID
        $paketWisata = PaketWisata::findOrFail($id);
        
        // Mendapatkan grup rundown berdasarkan hari ke dan menyortirnya berdasarkan waktu mulai
        $rundownsGrouped = $paketWisata->rundowns->groupBy('hari_ke')->map(function ($rundowns) {
            return $rundowns->sortBy('mulai');
        });

        // Mengirimkan data ke view PDF
        $nama_paket_wisata = $paketWisata->nama;
        $pdf = $this->renderPdfView($rundownsGrouped, $nama_paket_wisata);

        // Mengembalikan PDF sebagai respons
        return $pdf->stream('rundown.pdf');
    }

    private function renderPdfView($rundownsGrouped, $nama_paket_wisata)
    {
        // Render view ke dalam string
        $html = view('admin.rundown.pdf', compact('rundownsGrouped', 'nama_paket_wisata'))->render();

        // Buat instance Dompdf
        $dompdf = new Dompdf();

        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Mengembalikan instance Dompdf
        return $dompdf;
    }
}
