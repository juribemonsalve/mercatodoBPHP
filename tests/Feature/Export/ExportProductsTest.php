<?php

namespace Tests\Feature\Export;

use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExportProductsTest extends TestCase
{
    public function user_can_download_invoices_export()
    {
        Excel::fake();
        Storage::fake('public');
        $this->actingAs($this->givenUser())
             ->downloadExport('filename.xlsx');

        Storage::disk('public')->assertExists('exports/filename.xlsx', function ($diskPath) {
            return true;
        });
    }
}
