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

    public function collection(Collection $rows)
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
            'id' => 'The id is required and must be of type numeric',
            'description' => 'The description is required with a minimum of 10 and a maximum of 250 characters',
            'price' => 'The price is required and must be a number greater than 0',
            'quantity' => 'The amount is required and must be a number greater than or equal to 0',
            'category_id' => 'The category id is required and must exist',
            'status' => 'The status of the product is required and must be new or used',
        ];
    }
}
