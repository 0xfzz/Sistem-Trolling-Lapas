<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class KontrolController extends Controller
{
    public function index(){
        return view('kontrol-scan');
    }
    public function store(Request $request)
    {

        $request->validate([
            'nama_lengkap' => 'required|string',
            'reports' => 'required|array',
            'reports.*.qrdata_id' => 'required|integer',
            'reports.*.kondisi_sarpras' => 'required|string',
            'reports.*.jumlah_hunian' => 'required|integer',
            'reports.*.keterangan' => 'nullable|string',
        ]);

        foreach ($request->input('reports') as $reportData) {
            Report::create([
                'user_id' => Auth::id(),
                'nama_lengkap' => $request->input('nama_lengkap'),
                'qrdata_id' => $reportData['qrdata_id'],
                'kondisi_sarpras' => $reportData['kondisi_sarpras'],
                'jumlah_hunian' => $reportData['jumlah_hunian'],
                'keterangan' => $reportData['keterangan'],
                'status' => 'SUBMITTED',
            ]);
        }
        return response()->json('Data created successfully.');
    }
}
