<?php

namespace App\Jobs;

use App\Exports\ProductsExport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ExportProductsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function constructFileName()
    {
        $now = Carbon::now('America/Bogota');
        return 'products_' . $now->format('Ymd_His') . '.xlsx';
    }

    protected function exportFile($fileName): void
    {
        $filePath = 'exports/' . $fileName;
        Excel::store(new ProductsExport($fileName), $filePath, 'public');
        Session::put('excel_exported_file', $fileName);
        Session::put('exported_file_downloaded', false); // v

        Log::info('EXCEL exportado: ' . $fileName);
    }

    public function handle(): void
    {
        $fileName = $this->constructFileName();
        $this->exportFile($fileName);

        // Elimina el trabajo de la cola
        $this->delete();
    }
}
