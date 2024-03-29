<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateReportOrderJob;
use App\ViewModels\OrderViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Order;
use Illuminate\Support\Carbon;
class OrderController extends Controller
{
    public function index(): View
    {
        return view('orders.index', new OrderViewModel());
    }

    public function report(Request $request): RedirectResponse
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $job = new GenerateReportOrderJob($startDate, $endDate);
        Queue::push($job);

        return redirect()->back();
    }

    public function downloadExport($fileName): StreamedResponse
    {
        $filePath = 'reports/' . $fileName;
        if (Storage::disk('public')->exists($filePath)) {
            Session::put('pdf_exported_file_downloaded', true);

            return Storage::disk('public')->download($filePath);
        }

        abort(404);
    }
}
