<?php

namespace App\Exports;
use App\Models\Lembur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class SplExport implements FromView
{
    private $mulai;
    private $sampai;
    private $status;
    public function __construct($mulai,$sampai,$status) 
    {
        $this->mulai = $mulai;
        $this->sampai = $sampai;
        $this->status = $status;
    }
    public function view(): View
    {
        $mulai=$this->mulai;
        $sampai=$this->sampai;
        return view('lembur.export', [
            'datanya' => Lembur::whereBetween('tanggal',[$this->mulai,$this->sampai])->orderBy('id','Asc')->get()
        ],compact('mulai','sampai'));
    }
}
