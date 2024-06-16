<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;
class PaymentTkExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('invoices as a')
                    ->select('b.nis', 'b.nik', 'b.name', 'd.ta_name', 'c.semester_name', DB::raw('MONTHNAME(a.date) as bulan'), 'a.date', 'a.sub_total', 'a.discount', 'a.status')
                    ->join('siswa as b', 'a.student_id', '=', 'b.id')
                    ->join('semester as c', 'a.semester_id', '=', 'c.id')
                    ->join('tahun_ajaran as d', 'c.ta_id', '=', 'd.id')
                    ->where('a.status', 'lunas')
                    ->where('b.level_id', 1)
                    ->get();
    }

    public function headings(): array
    {
        return [
            'No. Induk Siswa',
            'NIK',
            'Nama Siswa',
            'Tahun Ajaran',
            'Semester',
            'Bulan',
            'Tanggal',
            'Total',
            'Diskon',
            'Keterangan'
        ];
    }
}
