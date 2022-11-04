<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use App\Models\Employe;

class EmployeImport implements ToModel, WithStartRow,WithCalculatedFormulas
{
    
    public function collection(Collection $collection)
    {
        //
    }

    public function model(array $row)
    {
        
        return Employe::updateOrCreate(
            [
                'nik'=>$row[0],
                'no_ktp'=>$row[1],
                'email'=>$row[7],
                
                
            ],
            [
                'nama'=>$row[2],
                'no_hp'=>$row[1],
                'alamat'=>$row[3],
                'jenis_kelamin'=>$row[4],
                'tempat_lahir'=>$row[5],
                'tanggal_lahir'=>$row[6],
                'no_ijazah'=>$row[12],
                'asal_sekolah'=>$row[9],
                'pendidikan_id'=>pendidikan_id($row[10]),
                'tahun_pendidikan'=>$row[11],
                'updated_at'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'aktif'=>1,
            ],
        );
            
        
    }

    public function startRow(): int
    {
        return 2;
    }
}
