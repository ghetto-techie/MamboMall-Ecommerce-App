<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class InvoiceService
{
    public function generateAndStore(Order $order): string
    {
        $order->load(['user', 'items.product']);

        $pdf = Pdf::loadView('invoices.order', [
            'order' => $order,
        ])->setPaper('A4');

        $filename = 'invoice-ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . '.pdf';
        $path = 'invoices/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());

        return $path; // relative path inside storage
    }

    public function generateBulk(array $orders): string
    {
        $zipName = 'invoices-' . now()->format('Ymd-His') . '.zip';
        $zipPath = storage_path('app/public/invoices/' . $zipName);

        $zip = new ZipArchive;
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($orders as $order) {
            $path = $this->generateAndStore($order);

            $absolutePath = storage_path('app/public/' . $path);
            $zip->addFile(
                $absolutePath,
                basename($absolutePath)
            );
        }

        $zip->close();

        return 'invoices/' . $zipName;
    }
}
