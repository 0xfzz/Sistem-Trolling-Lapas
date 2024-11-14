<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index() {
        return view('report.index', [
            'reports' => \App\Models\Report::select('report.*', 'users.tim')->join('users', 'users.id', '=', 'report.user_id')->get()
        ]);
    }

    public function create(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'kondisi_sarpras' => 'required|string',
            'jumlah_hunian' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        // Create a new report
        $report = new \App\Models\Report();
        $report->user_id = $validatedData['user_id'];
        $report->kondisi_sarpras = $validatedData['kondisi_sarpras'];
        $report->jumlah_hunian = $validatedData['jumlah_hunian'];
        $report->keterangan = $validatedData['keterangan'];
        $report->save();

        // Redirect to the index page or show a success message
        return redirect()->route('report-list')->with('success', 'Report created successfully');
    }

    public function update(Request $request, $id) {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'kondisi_sarpras' => 'required|string',
            'jumlah_hunian' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        // Find the report by ID
        $report = \App\Models\Report::findOrFail($id);

        // Update the report
        $report->user_id = $validatedData['user_id'];
        $report->kondisi_sarpras = $validatedData['kondisi_sarpras'];
        $report->jumlah_hunian = $validatedData['jumlah_hunian'];
        $report->keterangan = $validatedData['keterangan'];
        $report->save();

        // Redirect to the index page or show a success message
        return redirect()->route('report-list')->with('success', 'Report updated successfully');
    }

    public function delete($id) {
        // Find the report by ID
        $report = \App\Models\Report::findOrFail($id);

        // Delete the report
        $report->delete();

        // Redirect to the index page or show a success message
        return redirect()->back()->with('success', 'Report deleted successfully');
    }

    public function download(Request $request)
    {
        // Get the start and end date from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Find the reports within the date range
        $reports = new \App\Models\Report();

        if(trim($startDate) != '' && trim($endDate) != '' && !empty($startDate) && !empty($endDate)) {
            $reports = $reports->whereDate('report.created_at', '>=', $startDate)
            ->whereDate('report.created_at', '<=', $endDate);
        }

        $reports = $reports->select('report.*', 'users.tim')->join('users', 'users.id', '=', 'report.user_id')->get();

        // Generate a unique file name
        $fileName = 'reports_' . time() . '.pdf';

        // Set the PDF to landscape
        $pdf = Pdf::loadView('report.pdf', ['startDate' => $startDate, 'endDate' => $endDate, 'reports' => $reports])->setPaper('a4', 'landscape');

        // Stream the PDF file to the browser without saving it to the public directory
        return $pdf->download($fileName);
    }
}
