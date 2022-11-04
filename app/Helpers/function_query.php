<?php

function get_jabatan(){
   $data=App\Models\Jabatan::orderBy('id','Asc')->get();
   return $data;
}

function get_group(){
   $data=App\Models\Group::where('aktif',1)->orderBy('id','Asc')->get();
   return $data;
}
function get_unit(){
   $data=App\Models\Unit::where('aktif',1)->orderBy('nama_unit','Asc')->get();
   return $data;
}
function get_posisi(){
   $data=App\Models\Posisi::orderBy('posisi','Asc')->get();
   return $data;
}
function get_tingkatanunit(){
   $data=App\Models\Tingkatanunit::orderBy('id','Asc')->get();
   return $data;
}
function get_employe_aktif(){
   $data=App\Models\Employe::where('aktif',1)->orderBy('id','Asc')->get();
   return $data;
}
function get_dokumen(){
   $data=App\Models\Dokumen::where('aktif',1)->where('kat',1)->orderBy('id','Asc')->get();
   return $data;
}
function count_dokumen(){
   $data=App\Models\Dokumen::where('aktif',1)->where('kat',1)->count();
   return $data;
}
function sum_tunjangan($jabatan_id){
   $data=App\Models\Tunjangan::where('jabatan_id',$jabatan_id)->where('kategori_tunjangan_id',1)->sum('nilai');
   return $data;
}
function sum_employe_all(){
   $data=App\Models\Employe::where('aktif',1)->count();
   return $data;
}
function sum_employe_nonaktif(){
   $data=App\Models\Employe::where('aktif','!=',1)->count();
   return $data;
}
function sum_employe_selesai(){
   $data=App\Models\Vemploye::where('aktif',1)->where('selisih','<',1)->count();
   return $data;
}
function sum_employe_limit(){
   $data=App\Models\Vemploye::where('aktif',1)->where('selisih','>',1)->where('selisih','<',61)->count();
   return $data;
}
function gaji_pokok_bulanan($nik,$no_ktp,$bulan,$tahun){
   $cek=App\Models\Tgajipokok::where('nik',$nik)->where('no_ktp',$no_ktp)->where('bulan',$bulan)->where('tahun',$tahun)->count();
   if($cek>0){
      $data=App\Models\Tgajipokok::where('nik',$nik)->where('no_ktp',$no_ktp)->where('bulan',$bulan)->where('tahun',$tahun)->first();
      return $data->nilai;
   }else{
      return 0;
   }
   
}
function sum_employe_lengkap(){
   $data=App\Models\Employe::where('aktif',1)->where('status_lengkap',1)->count();
   return $data;
}
function sum_employe_diproses(){
   $data=App\Models\Employe::where('aktif',1)->where('status_pendapatan',1)->count();
   return $data;
}
function sum_potongan($nik,$no_ktp,$bulan,$tahun){
   $data=App\Models\Employepotongan::where('nik',$nik)->where('no_ktp',$no_ktp)->where('kat',1)->sum('nilai');
   return $data;
}
function sum_slip_potongan($nik,$no_ktp,$bulan,$tahun){
   $data=App\Models\Temployepotongan::where('nik',$nik)->where('no_ktp',$no_ktp)->where('bulan',$bulan)->where('tahun',$tahun)->sum('nilai');
   return $data;
}
function get_tunjangan($jabatan_id){
   $data=App\Models\Tunjangan::where('jabatan_id',$jabatan_id)->where('kategori_tunjangan_id',1)->get();
   return $data;
}
function get_potongan($no_ktp,$nik){
   $data=App\Models\Employepotongan::where('no_ktp',$no_ktp)->where('mulai','<=',date('Y-m-d'))->where('sampai','>=',date('Y-m-d'))->where('nik',$nik)->get();
   return $data;
}
function get_slip_potongan($no_ktp,$nik,$tanggal){
   $data=App\Models\Employepotongan::where('no_ktp',$no_ktp)->where('mulai','<=',$tanggal)->where('sampai','>=',$tanggal)->where('nik',$nik)->get();
   return $data;
}
function uang_shift($jabatan_id){
   $cek=App\Models\Tunjangan::where('jabatan_id',$jabatan_id)->where('kategori_tunjangan_id',3)->count();
   if($cek>0){
      $data=App\Models\Tunjangan::where('jabatan_id',$jabatan_id)->where('kategori_tunjangan_id',3)->firstOrfail();
      return $data['nilai'];
   }else{
      return 0;
   }
   
}
function get_kontribusi($jabatan_id){
   $data=App\Models\Tunjangan::where('jabatan_id',$jabatan_id)->where('kategori_tunjangan_id',2)->get();
   return $data;
}
function jam_jadwal($group_id,$tanggal,$status){
   $cek=App\Models\Vjadwal::where('group_id',$group_id)->where('tanggal',$tanggal)->count();
   if($cek>0){
      $data=App\Models\Vjadwal::where('group_id',$group_id)->where('tanggal',$tanggal)->firstOrfail();
      if($status=='M'){
         $waktu=$tanggal.' '.$data['masuk'];
         return $waktu;
      }else{
         $waktu=$tanggal.' '.$data['pulang'];
         return $waktu;
      }
      
   }else{
      return 0;
   }
   
}
function jam_absen($nik,$tanggal,$status){
   $cek=App\Models\Vabsen::where('nik',$nik)->where('tanggal',$tanggal)->whereNotIn('status_absen',array(4,5))->where('status',$status)->count();
   if($cek>0){
      $data=App\Models\Vabsen::where('nik',$nik)->where('tanggal',$tanggal)->whereNotIn('status_absen',array(4,5))->where('status',$status)->firstOrfail();
      return $data['waktu'];
      
   }else{
      return null;
   }
   
}
function jadwal_absen($nik,$tanggal,$status){
   $cek=App\Models\Employejadwal::where('nik',$nik)->where('tanggal',$tanggal)->count();
   if($cek>0){
      $data=App\Models\Employejadwal::where('nik',$nik)->where('tanggal',$tanggal)->firstOrfail();
      if($data->jadwal==0){
         
            return 1;
         
      }else{
         if($status=='M'){
            return $data['waktu_masuk'];
         }else{
            return $data['waktu_pulang'];
         }
      }
      
      
      
   }else{
      return 0;
   }
   
}
function jam_selisih_absen($nik,$tanggal,$status){
   $cek=App\Models\Vabsen::where('nik',$nik)->where('tanggal',$tanggal)->where('status',$status)->count();
   if($cek>0){
      $data=App\Models\Vabsen::where('nik',$nik)->where('tanggal',$tanggal)->where('status',$status)->firstOrfail();
      $telat=$data['telat'];
      return $telat;
      
   }else{
      return '0.0';
   }
   
}
function statusabsen($nik,$tanggal,$status){
   $cek=App\Models\Vabsen::where('nik',$nik)->where('tanggal',$tanggal)->where('status',$status)->count();
   if($cek>0){
      $data=App\Models\Vabsen::where('nik',$nik)->where('tanggal',$tanggal)->where('status',$status)->firstOrfail();
      $telat=$data->mstatusabsen['keterangan'];
      return $telat;
      
   }else{
      return null;
   }
   
}
function idstatusabsen($nik,$tanggal,$status){
   $cek=App\Models\Vabsen::where('nik',$nik)->where('tanggal',$tanggal)->where('status',$status)->count();
   if($cek>0){
      $data=App\Models\Vabsen::where('nik',$nik)->where('tanggal',$tanggal)->where('status',$status)->firstOrfail();
      $telat=$data->status_absen;
      return $telat;
      
   }else{
      return null;
   }
   
}
function get_shift($jabatan_id){
   $data=App\Models\Tunjangan::where('jabatan_id',$jabatan_id)->where('kategori_tunjangan_id',3)->get();
   return $data;
}
function jumlah_absen($nik,$bulan,$tahun,$status_absen){
   $data=App\Models\Rekapabsen::where('nik',$nik)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->where('status_absen',$status_absen)->count();
   return $data;
}
function total_jumlah_absen($nik,$bulan,$tahun,$jumlah){
   $data=App\Models\Rekapabsen::where('nik',$nik)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->whereIn('status_absen',array(1,2,3,4))->count();
   $tampil=$jumlah-$data;
   return $tampil;
}
function cuti_update($nik){
   $cek=App\Models\Cuti::where('nik',$nik)->count();
   if($cek>0){
      $data=App\Models\Cuti::where('nik',$nik)->orderBy('id','Desc')->firstOrfail();
      return $data->tahun;
   }else{
      return null;
   }
   
}
function sisa_cuti($nik){
   $cuti=App\Models\Cuti::where('nik',$nik)->sum('cuti');
   $absen=App\Models\Absen::where('nik',$nik)->where('status_absen',2)->count();
   $sisa=$cuti-$absen;
   return $sisa;
   
}
function cuti_digunakan($nik){
   $absen=App\Models\Absen::where('nik',$nik)->where('status_absen',2)->count();
   return $absen;
   
}
function jumlah_wajid_kehadiran($bulan=null,$tahun,$group_id){
   $data=App\Models\Jadwal::whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->where('group_id',$group_id)->where('jadwal','!=',0)->count();
   return $data;
}
function jumlah_employe($group_id){
   $data=App\Models\Employe::where('group_id',$group_id)->count();
   return $data;
}
function sum_kontribusi($jabatan_id){
   $data=App\Models\Tunjangan::where('jabatan_id',$jabatan_id)->where('kategori_tunjangan_id',2)->sum('nilai');
   return $data;
}
function get_kategoritunjangan(){
   $data=App\Models\Kategoritunjangan::orderBy('id','Asc')->get();
   return $data;
}
function cek_jam_lembur($nik,$tanggal,$waktu_masuk,$waktu_pulang){
   $data=App\Models\Employejadwal::where('nik',$nik)->where('tanggal',$tanggal)->whereBetween('waktu_masuk',[$waktu_masuk,$waktu_pulang])->whereBetween('waktu_pulang',[$waktu_masuk,$waktu_pulang])->count();
   return $data;
}
function get_jadwal($bulan,$tahun){
   $data=App\Models\Jadwal::select('tanggal')->whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->groupBy('tanggal')->get();
   return $data;
}
function cek_jadwal($tanggal,$group_id){
   $cek=App\Models\Jadwal::where('tanggal',$tanggal)->where('group_id',$group_id)->count();
   if($cek>0){
      $data=App\Models\Jadwal::where('tanggal',$tanggal)->where('group_id',$group_id)->first();
      return $data['jadwal'];
   }else{
      return null;
   }
      
}
function cek_jadwal_employe($nik,$tanggal){
   $cek=App\Models\Employejadwal::where('tanggal',$tanggal)->where('nik',$nik)->count();
   if($cek>0){
      $data=App\Models\Employejadwal::where('tanggal',$tanggal)->where('nik',$nik)->first();
      return $data['jadwal'];
   }else{
      return null;
   }
      
}
function cek_dokumen_employe($no_ktp,$dokumen_id){
   $cek=App\Models\Employedokumen::where('no_ktp',$no_ktp)->where('dokumen_id',$dokumen_id)->count();
   if($cek>0){
      $data=App\Models\Employedokumen::where('no_ktp',$no_ktp)->where('dokumen_id',$dokumen_id)->first();
      return $data['file'];
   }else{
      return 0;
   }
      
}
function count_dokumen_employe($no_ktp){
   $cek=App\Models\Employedokumen::where('no_ktp',$no_ktp)->count();
   return $cek;
      
}

function get_pendidikan(){
   $data=App\Models\Pendidikan::orderBy('id','Asc')->get();
   return $data;
}
function pendidikan_id($pendidikan){
   $cek=App\Models\Pendidikan::where('pendidikan',$pendidikan)->count();
   if($cek>0){
      $data=App\Models\Pendidikan::where('pendidikan',$pendidikan)->first();
      $pen=$data->id;
   }else{
      $pen=10;
   }
   return $pen;
}
function get_sertifikat($no_ktp){
   $data=App\Models\Sertifikat::where('no_ktp',$no_ktp)->orderBy('id','Asc')->get();
   return $data;
}

?>