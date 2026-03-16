<?php

namespace App\Livewire\Admin\Dashboard;

use App\Services\InvoiceService;
use Livewire\Component;

class Index extends Component
{
    public function render(InvoiceService $invoiceService)
    {
        $invoiceUnpaid = $invoiceService->getUnpaidInvoices();
        $invoicePaid = $invoiceService->getPaidInvoices();
        $income = $invoiceService->getIncome();
        return view('livewire.admin.dashboard.index', compact('invoiceUnpaid', 'invoicePaid', 'income'));
    }
}
