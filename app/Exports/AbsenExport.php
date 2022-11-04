<?php

namespace App\Exports;
use App\Models\Lembur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class AbsenExport implements FromView
{
    private $tanggal;
    public function __construct($tanggal) 
    {
        $this->tanggal = $tanggal;
    }
    public function view(): View
    {
        $tanggal=$this->tanggal;
        return view('absen.export',compact('tanggal'));
    }
}
