<?php

namespace Tests\Feature\Export;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleHasPermission;

use App\Jobs\ExportProductsJob;
use Illuminate\Support\Facades\Queue;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;


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
