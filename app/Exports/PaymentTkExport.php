<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
class PaymentTkExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('invoices as a')
                    ->select('b.nis', 'b.name', 'c.semester_name', 'a.date', 'a.sub_total', 'a.discount', 'a.status')
                    ->join('siswa as b', 'a.student_id', '=', 'b.id')
                    ->join('semester as c', 'a.semester_id', '=', 'c.id')
                    ->where('a.status', 'lunas')
                    ->get();
    }
}
