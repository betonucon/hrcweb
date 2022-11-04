<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use App\Models\Employe;
use App\Models\Accesstoken;
use App\Models\Vemploye;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login(Request $request)
    {
        error_reporting(0);
        if(Auth::attempt(['email' => $request->username, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $employe = Vemploye::where('nik',$user->username)->first(); 
            if($user->active_status==1){

                $berier=$user->createToken('MyApp')->plainTextToken;
                $token=explode('|',$berier);
                // $success['token'] =  $berier; 
                $success['token'] =  $berier; 
                $success['nama'] =  $employe->nama;
                $success['email'] =  $employe->email;
                $success['alamat'] =  $employe->alamat;
                $success['jenis_kelamin'] =  $employe->jenis_kelamin;
                $success['status_kerja'] =  $employe->nama_status_kerja;
                $success['group_id'] =  $employe->group_id;
                $success['group'] =  $employe->nama_group;
                $success['no_hp'] =  $employe->no_hp;
                $success['nik'] =  $employe->nik;
                $success['no_ktp'] =  $employe->no_ktp;
                $success['jabatan'] =  $employe->jabatan;
                $success['mulai_kontrak'] =  tanggal_indo($employe->mulai_kontrak);
                $success['sampai_kontrak'] =  tanggal_indo($employe->sampai_kontrak);
                return $this->sendResponse($success, 'User login successfully.');
            }else{
                if($user->active_status==2){
                    $error='Menunggu Approval admin';
                    return $this->sendResponseerror($error);
                }else{
                    $error='Akun anda telah dibekukan';
                    return $this->sendResponseerror($error);
                }
            }
            
        } 
        else{ 
            $error='Email atau password anda salah';
            return $this->sendResponseerror($error);
        } 
    }

    public function fcm_token(Request $request)
    {
        $akses = $request->user(); 
        $token=explode('|',$request->bearerToken());
        $cek=Accesstoken::where('tokenable_id',$akses->id)->where('id','!=',$token[0])->where('token_device',$request->token)->update([
            'active_status'=>0
        ]);
        $update=Accesstoken::where('id',$token[0])->update([
            'token_device'=>$request->token,
            'active_status'=>1,
        ]);
        $delete=Accesstoken::where('id','!=',$token[0])->where('token_device',$request->token)->delete();
        
        $success=[];
        return $this->sendResponse($success, 'success');
    }
}