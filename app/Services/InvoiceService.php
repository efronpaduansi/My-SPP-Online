<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;

class InvoiceService
{
    protected InvoiceRepository $invoiceRepo;
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepo = $invoiceRepository;
    }

    public function getInvoices()
    {
        return $this->invoiceRepo->getAll();
    }

    public function getUnpaidInvoices()
    {
        $status = 'Belum Bayar';
        return $this->invoiceRepo->getByStatus($status);
    }

    public function getPaidInvoices()
    {
        $status = 'Lunas';
        return $this->invoiceRepo->getByStatus($status);
    }

    public function getIncome()
    {
        $invoices = $this->getInvoices();
        $subTotal = $invoices->sum('sub_total');
        $disCount = $this->invoiceRepo->getDiscount();
        $income = ($subTotal - $disCount);
        return $income;
    }
}
