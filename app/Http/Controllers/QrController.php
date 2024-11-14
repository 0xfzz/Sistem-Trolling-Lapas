<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrController extends Controller
{
    public function index(){
        return view('qr.index', [
            'qrcodes' => \App\Models\QrData::all()
        ]);
    }
    public function create(Request $request)
    {
        $data = $request->validate([
            'lokasi' => 'required|string'
        ]);

        \App\Models\QrData::create($data);

        return redirect()->back()->with('success', 'Data created successfully.');
    }
    public function getLokasiById($id){
        $qrData = \App\Models\QrData::find($id);
        return response()->json($qrData);
    }

    public function edit($id)
    {
        $qrdata = \App\Models\QrData::findOrFail($id);

        return view('edit-qr', compact('qrdata'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'lokasi' => 'required|string'
        ]);

        $qrdata = \App\Models\QrData::findOrFail($id);
        $qrdata->update($data);

        return redirect()->route('kelola-qr')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $qrdata = \App\Models\QrData::findOrFail($id);
        $qrdata->delete();

        return redirect()->route('kelola-qr')->with('success', 'Data deleted successfully.');
    }
}
