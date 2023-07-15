<?php
namespace App\Jobs;

use App\Exports\ProductsExport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ExportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected function constructFileName()
    {
        $now = Carbon::now('America/Bogota');
        return 'products_' . $now->format('Ymd_His') . '.xlsx';
    }

    protected function exportFile($fileName)
    {
        $filePath = 'exports/' . $fileName;
        Excel::store(new ProductsExport($fileName), $filePath, 'public');
        Session::put('exported_file', $fileName);
    }

    public function handle()
    {
        $fileName = $this->constructFileName();
        $this->exportFile($fileName);

        // Elimina el trabajo de la cola
        $this->delete();
    }




}
