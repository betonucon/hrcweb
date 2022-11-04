<?php
   
namespace App\Http\Controllers\Api;
use App\Events\KirimCreated;   
use App\Events\LemburCreated;   
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use App\Models\Absen;
use App\Models\Vabsen;
use App\Models\Lembur;
use App\Models\Vemploye;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
   
class AbsenController extends BaseController
{
    /**
     * Register api ssssssssssssssssssssssssssss
     *
     * @return \Illuminate\Http\Response
     */
    public function absen(Request $request)
    {
        error_reporting(0);
        $akses = $request->user(); 
        $employe = Vemploye::where('nik',$akses->username)->first(); 
        $rules = [];
        $messages = [];

        $rules['lat'] = 'required';
        $rules['long'] = 'required';
        $rules['status'] = 'required';
        $rules['files'] = 'required';
        
        
        $validator = Validator::make($request->all(), $rules,$messages);
        $val=$validator->Errors();
        if($validator->fails()){
            $error="";
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                   $error.=$isi."\n";
                }
            }
            return $this->sendResponseerror($error, 'gagal');
        }else{
           
            $tanggal=date('Y-m-d');
            $status=$request->status;
            $cekabsen=Absen::where('nik',$akses->username)->where('status',$status)->where('tanggal',$tanggal)->count();
            if($cekabsen>0){
                if($status=='M'){
                    $error='Anda sudah melakukan absen masuk';
                }else{
                    $error='Anda sudah melakukan absen pulang';
                }
                
                return $this->sendResponseerror($error, 'gagal');
            }else{

            
                if(jadwal_absen($employe->nik,$tanggal,$status)==0){
                    $error='Jadwal belum tersedia';
                    return $this->sendResponseerror($error, 'gagal');
                }else{
                    $waktu=date('Y-m-d H:i:s');
                    if(jadwal_absen($employe->nik,$tanggal,$status)==1){
                        $jamaktual=$waktu;
                        $status_absen=5;
                    }else{
                        $jamaktual=jadwal_absen($employe->nik,$tanggal,$status);
                        $status_absen=1;
                    }
                        $nama=$employe->nik.'-'.date('ymd').'-'.$status;
                        
                        $image = $request->file('files');
                        $imageFileName =$nama.'.'.$image->getClientOriginalExtension();
                        $filePath =$imageFileName;
                        $file =\Storage::disk('public_absen');
                        $success=[];
                        if($file->put($filePath, file_get_contents($image))){
                            $data=Absen::updateOrCreate(
                                [
                                    'nik'=>$employe->nik,
                                    'tanggal'=>$tanggal,
                                    'status'=>$status,
                                ],
                                [
                                    'jam_aktual'=>$jamaktual,
                                    'group_id'=>$employe->group_id,
                                    'waktu'=>$waktu,
                                    'lat'=>$request->lat,
                                    'status_absen'=>$status_absen,
                                    'long'=>$request->long,
                                    'foto'=>$filePath,
                                    'approve'=>0,

                                ]

                            );
                            $success['tanggal']=$tanggal;
                            $success['jam_masuk']=jam_absen($employe->nik,$tanggal,'M');
                            $success['jam_pulang']=jam_absen($employe->nik,$tanggal,'P');
                        }
                            
                        KirimCreated::dispatch('sukses');
                        return $this->sendResponse($success, 'success');
                
                }
            }
        }
        
        
    }

    public function lembur(Request $request)
    {
        error_reporting(0);
        $akses = $request->user(); 
        $employe = Vemploye::where('nik',$akses->username)->first(); 
        $rules = [];
        $messages = [];
        

        $rules['tanggal'] = 'required';
        $rules['jam_masuk'] = 'required';
        $rules['jam_pulang'] = 'required';
        $rules['alasan'] = 'required';

        $messages['tanggal.required'] = 'Tentukan tanggal';
        $messages['jam_masuk.required'] = 'Tentukan jam masuk';
        $messages['jam_pulang.required'] = 'Tentukan jam pulang';
        $messages['alasan.required'] = 'Harap isi alasan';
        $success=[];
        
        $validator = Validator::make($request->all(), $rules,$messages);
        $val=$validator->Errors();
        if($validator->fails()){
            $error="";
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                   $error.=$isi."\n";
                }
            }
            return $this->sendResponseerror($error, 'gagal');
        }else{
           
            $tanggal=$request->tanggal;
            $status=$request->status;
            $ceklembur=Lembur::where('nik',$employe->nik)->where('tanggal',$tanggal)->count();

            if($ceklembur>0){
                $error='Data lembur ditanggal ini sudah tersedia';
                return $this->sendResponseerror($error, 'gagal');
            }else{
                if(jadwal_absen($employe->nik,$tanggal,$status)==0){
                    $error='Jadwal belum tersedia';
                    return $this->sendResponseerror($error, 'gagal');
                }else{
                    $masuk=$request->jam_masuk.':00';
                    $waktumasuk=$tanggal.' '.$masuk;
                    
                    $pulang=$request->jam_pulang.':00';
                    $waktupulang=$tanggal.' '.$pulang;
                    if($waktupulang>$waktumasuk){
                        if(jadwal_absen($employe->nik,$tanggal,$status)==1){
                            $data=Lembur::updateOrCreate(
                                [
                                    'nik'=>$employe->nik,
                                    'tanggal'=>$tanggal,
                                ],
                                [
                                    'group_id'=>$employe->group_id,
                                    'tanggal'=>$tanggal,
                                    'status_absen'=>5,
                                    'waktu_masuk'=>$waktumasuk,
                                    'jam_masuk'=>$masuk,
                                    'total'=>selisih_waktu($waktumasuk,$waktupulang),
                                    'waktu_pulang'=>$waktupulang,
                                    'jam_pulang'=>$pulang,
                                    'approve'=>0,
                                ]
                            );
                            LemburCreated::dispatch('sukses');
                            return $this->sendResponse($success, 'success');
                        }else{
                            if(
                                ($waktumasuk<jadwal_absen($employe->nik,$tanggal,'M') && $waktupulang<jadwal_absen($employe->nik,$tanggal,'M')) ||
                                ($waktumasuk>jadwal_absen($employe->nik,$tanggal,'P') && $waktupulang>jadwal_absen($employe->nik,$tanggal,'P')) 
                            )
                            {
                            
                                $data=Lembur::updateOrCreate(
                                    [
                                        'nik'=>$employe->nik,
                                        'tanggal'=>$tanggal,
                                    ],
                                    [
                                        'group_id'=>$employe->group_id,
                                        'tanggal'=>$tanggal,
                                        'total'=>selisih_waktu($waktumasuk,$waktupulang),
                                        'status_absen'=>5,
                                        'waktu_masuk'=>$waktumasuk,
                                        'jam_masuk'=>$masuk,
                                        'waktu_pulang'=>$waktupulang,
                                        'jam_pulang'=>$pulang,
                                        'approve'=>0,
                                        'created_at'=>sekarang(),
                                    ]
                                );
                                LemburCreated::dispatch('sukses');
                                return $this->sendResponse($success, 'success');
                            }else{
                                $error='Waktu lembur harus diluar jam kerja';
                                return $this->sendResponseerror($error, 'gagal');
                            }
                        }
                    }else{
                        $error='Kesalahan pengisian jam';
                        return $this->sendResponseerror($error, 'gagal');
                    }
                        
                            
                
                }
            }
        }
        
        
    }

    public function rekap_absensi(Request $request)
    {
        error_reporting(0);
        $akses = $request->user(); 
        $employe = Vemploye::where('nik',$akses->username)->first(); 
        $bulan=$request->bulan;
        $tahun=$request->tahun;
        $count = Vabsen::where('nik',$akses->username)->whereMonth('waktu',$bulan)->whereYear('waktu',$tahun)->where('status','M')->count();
        $telatjam = Vabsen::where('nik',$akses->username)->whereMonth('waktu',$bulan)->whereYear('waktu',$tahun)->where('status','M')->sum('telat_jam');
        $telatmenit = Vabsen::where('nik',$akses->username)->whereMonth('waktu',$bulan)->whereYear('waktu',$tahun)->where('status','M')->sum('telat_menit');
        $telat=$telatjam+round($telatmenit/60,2);
        $success=[];
        $success['nama']=$employe->nama;
        $success['nik']=$employe->nik;
        $success['bulan']=$bulan;
        $success['tahun']=$tahun;
        $success['nik']=$employe->nik;
        $success['hadir']=$count;
        $success['telat']=$telat;
        return $this->sendResponse($success, 'success');
        
        
    }
    

    
}