<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;



class ProductsExport implements FromCollection, Responsable, WithHeadings, ShouldAutoSize, WithStyles, ShouldQueue
{
    use Exportable;

    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }




    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/xlsx',
    ];

    public function headings(): array
    {
        return [
            'id',
            'name',
            'description',
            'price',
            'quantity',
            'category_id',
            'status',
        ];
    }

    public function collection(): Collection
    {
        return Product::select('id', 'name', 'description', 'price', 'quantity', 'category_id', 'status')->get();
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

}
