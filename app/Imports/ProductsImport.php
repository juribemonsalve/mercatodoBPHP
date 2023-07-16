<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToCollection, WithChunkReading, WithValidation, SkipsEmptyRows, WithHeadingRow
{
    use Importable;
    use RemembersChunkOffset;
    use SkipsFailures;

    public function collection(Collection $rows): void
    {
        $chunkOffset = $this->getChunkOffset();


        foreach ($rows as $row) {
            $product = new Product([
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'category_id' => $row['category_id'],
                'status' => $row['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $productExist = Product::where('id', $row['id'])->first();

            if ($productExist === null) {
                $product->save();

            } else {
                $productExist->name = $row['name'];
                $productExist->description = $row['description'];
                $productExist->price = $row['price'];
                $productExist->quantity = $row['quantity'];
                $productExist->category_id = $row['category_id'];
                $productExist->status = $row['status'];
                $productExist->updated_at = now();

                $productExist->save();
            }
        }
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function chunkSize(): int
    {
        return 20;
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'category_id' => 'required',
            'status' => 'required|in:active,disabled',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
                'id' => 'El campo id es requerido y debe ser de tipo numérico',
                'description' => 'El campo descripción es requerido y debe tener entre 10 y 250 caracteres',
                'price' => 'El campo precio es requerido y debe ser un número mayor que 0',
                'quantity' => 'El campo cantidad es requerido y debe ser un número mayor o igual a 0',
                'category_id' => 'El campo id de categoría es requerido y debe existir',
                'status' => 'El campo estado del producto es requerido y debe ser nuevo o usado',
        ];
    }
}
