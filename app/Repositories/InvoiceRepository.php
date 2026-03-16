<?php

namespace App\Repositories;

use App\Models\Invoice;

class InvoiceRepository
{
    protected Invoice $invoice;
    public function __construct(Invoice $invoice)
    {
       $this->invoice = $invoice;
    }

    public function getAll()
    {
        return $this->invoice->get();
    }

    public function getByStatus($status = null)
    {
        return $this->invoice->where('status', $status)->sum('sub_total');
    }

    public function getDiscount()
    {
        return $this->invoice->sum('discount');
    }

}
