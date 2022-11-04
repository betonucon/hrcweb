<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayatkontrak extends Model
{
    protected $table = 't_riwayat_kontrak';
    protected $fillable = [ 
            'nik',
            'no_ktp',
            'nama',
            'alamat',
            'no_hp',
            'email',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'jabatan_id',
            'foto',
            'no_kontrak',
            'mulai_kontrak',
            'sampai_kontrak',
            'asal_sekolah',
            'pendidikan_id',
            'tahun_pendidikan',
            'group_id',
            'no_ijazah',
            'status_kerja',
            'created_at',
            'updated_at',
            'gaji_pokok',
            'no_bpjs',
            'ayah',
            'ibu',
            'pekerjaan_ayah',
            'pekerjaan_ibu',
            'alamat_ayah',
            'status_lengkap',
            'alamat_ibu',
            'no_jkn',
            'kode_unit',
            'posisi_id',
            'aktif',
        ]; 
    public $timestamps = false;
    function mjabatan(){
        return $this->belongsTo('App\Models\Jabatan','jabatan_id','id');
    }
    function mgroup(){
        return $this->belongsTo('App\Models\Group','group_id','id');
    }
    function mpendidikan(){
        return $this->belongsTo('App\Models\Pendidikan','pendidikan_id','id');
    }
}
