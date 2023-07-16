<?php

namespace App\Http\Controllers;

use App\ViewModels\OrderViewModel;
use Illuminate\Contracts\View\View;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\GenerateReportOrderJob;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(): View
    {
        return view('orders.index', new OrderViewModel());
    }

    public function report(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $job = new GenerateReportOrderJob($startDate, $endDate);
        Queue::push($job);

        return redirect()->back(); // Redirige a la página anterior después de iniciar el trabajo en segundo plan
    }

    public function downloadExport($fileName)
    {
        $filePath = 'reports/' . $fileName;
        if (Storage::disk('public')->exists($filePath)) {
            // Marcar el archivo como descargado
            Session::put('pdf_exported_file_downloaded', true);

            return Storage::disk('public')->download($filePath);
        }

        abort(404);
    }


}
