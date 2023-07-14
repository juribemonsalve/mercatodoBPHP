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

class ExportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $now = Carbon::now('America/Bogota');
        $fileName = 'products_' . $now->format('Ymd_His') . '.xlsx';
        $filePath = 'exports/' . $fileName;

        Excel::store(new ProductsExport($fileName), $filePath, 'public');
        // Puedes agregar cualquier lógica adicional aquí, como registros o notificaciones
        // Elimina el trabajo de la cola después de haber sido procesado
        $this->delete();
    }
}
