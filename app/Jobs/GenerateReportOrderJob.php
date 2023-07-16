<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\ViewModels\OrderViewModel;
use Illuminate\Contracts\View\View;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class GenerateReportOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $startDate;
    public $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    protected function constructFileName()
    {
        $now = Carbon::now('America/Bogota');
        return 'orders_report_' . $now->format('Ymd_His') . '.pdf';
    }


    public function handle()
    {
        $startDate = $this->startDate;
        $endDate = $this->endDate;

        $orders = $this->getOrders($startDate, $endDate);
        $pdf = $this->generatePDF($orders);
        $this->savePDF($pdf);
    }

    protected function getOrders($startDate, $endDate)
    {
        return Order::where(function ($query) use ($startDate, $endDate) {
            $query->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
                ->orWhere(DB::raw('DATE(created_at)'), '>=', $startDate)
                ->orWhere(DB::raw('DATE(created_at)'), '<=', $endDate);
        })
        ->orderBy('created_at')
        ->orderBy('total')
        ->get();
    }

    protected function generatePDF($orders)
    {
        return PDF::loadView('orders.report', compact('orders'));
    }

    protected function savePDF($pdf)
    {
        $fileName = $this->constructFileName();
        $filePath = 'reports/' . $fileName;
        Storage::put($filePath, $pdf->output());

        Session::put('pdf_exported_file', $fileName);
        Session::put('pdf_exported_file_downloaded', false); // Agregar variable de sesión para controlar si el archivo fue descargado

        // Redirige a la página index
        return redirect()->route('orders.index');
    }

}
