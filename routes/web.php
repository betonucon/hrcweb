<?php

use Illuminate\Support\Facades\Route;
use App\Events\KirimCreated;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TunjanganController;
use App\Http\Controllers\ShiftController; 
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\PenggajianController; 
use App\Http\Controllers\AbsenController; 
use App\Http\Controllers\SplController; 
use App\Http\Controllers\UnitController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Cache facade value cleared</h1>';
});
Auth::routes();
Route::get('/testevent', function () {
    KirimCreated::dispatch('sasaaass');
    
    echo 'test broadcast event sangcahaya.id';
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::group(['middleware'    => 'auth'],function(){
    
    Route::group(['prefix' => 'home'],function(){
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/get_data', 'HomeController@get_data');
    });

    Route::group(['prefix' => 'employe'],function(){
        Route::get('/', [EmployeController::class, 'index']);
        Route::get('/get_data', [EmployeController::class, 'get_data']);
        Route::get('/get_data_pilih', [EmployeController::class, 'get_data_pilih']);
        Route::get('/proses_create_user', [EmployeController::class, 'proses_create_user']);
        Route::get('/dashboard', [EmployeController::class, 'dashboard']);
        Route::get('/dokumen', [EmployeController::class, 'index_dokumen']);
        Route::get('/cuti', [EmployeController::class, 'index_cuti']);
        Route::get('/jadwal', [EmployeController::class, 'index_jadwal']);
        Route::post('/dokumen', [EmployeController::class, 'store_dokumen']);
        Route::get('/get_data_dokumen', [EmployeController::class, 'get_data_dokumen']);
        Route::get('/get_data_cuti', [EmployeController::class, 'get_data_cuti']);
        Route::get('/tampil_dokumen', [EmployeController::class, 'tampil_dokumen']);
        Route::get('/delete_data', [EmployeController::class, 'delete_data']);
        Route::get('/delete_sertifikat', [EmployeController::class, 'delete_sertifikat']);
        Route::get('/create', [EmployeController::class, 'create']);
        Route::get('/create_dokumen', [EmployeController::class, 'create_dokumen']);
        Route::get('/download_excel', [EmployeController::class, 'download_excel']);
        Route::post('/', [EmployeController::class, 'store']);
        Route::post('/import', [EmployeController::class, 'import']);
        Route::post('/proses_jadwal', [EmployeController::class, 'proses_jadwal']);
        Route::post('/perbaharuan_cuti', [EmployeController::class, 'perbaharuan_cuti']);
        Route::post('/reset_cuti', [EmployeController::class, 'reset_cuti']);
        

        Route::group(['prefix' => 'penggajian'],function(){
            Route::get('/', [PenggajianController::class, 'index']);
            Route::get('/dashboard', [PenggajianController::class, 'dashboard']);
            Route::get('/get_data', [PenggajianController::class, 'get_data']);
            Route::get('/delete_data', [PenggajianController::class, 'delete_data']);
            Route::get('/delete_sertifikat', [PenggajianController::class, 'delete_sertifikat']);
            Route::get('/create', [PenggajianController::class, 'create']);
            Route::get('/perbaharui_potongan', [PenggajianController::class, 'perbaharui_potongan']);
            Route::post('/', [PenggajianController::class, 'store']);
            Route::post('/import', [PenggajianController::class, 'import']);
            Route::post('/gaji_pokok', [PenggajianController::class, 'gaji_pokok']);
        });

    });

    Route::group(['prefix' => 'slip'],function(){
        Route::get('/', [PenggajianController::class, 'index_slip']);
        Route::get('/view', [PenggajianController::class, 'view_data']);
        Route::get('/slip-gaji', [PenggajianController::class, 'slip']);
        Route::get('/get_data', [PenggajianController::class, 'get_data_slip']);
        Route::post('/', [PenggajianController::class, 'store_slip']);
    });

    Route::group(['prefix' => 'absen'],function(){
        Route::get('/rekap', [AbsenController::class, 'index_rekap']);
        Route::get('/', [AbsenController::class, 'index']);
        Route::post('/proses_rekap', [AbsenController::class, 'proses_rekap']);
        Route::get('/create', [AbsenController::class, 'create']);
        Route::get('/modal', [AbsenController::class, 'modal']);
        Route::get('/slip-gaji', [AbsenController::class, 'slip']);
        Route::get('/get_data', [AbsenController::class, 'get_data']);
        Route::get('/get_data_rekap', [AbsenController::class, 'get_data_rekap']);
        Route::post('/', [AbsenController::class, 'store']);
    });

    Route::group(['prefix' => 'spl'],function(){
        Route::get('/rekap', [SplController::class, 'index_rekap']);
        Route::get('/', [SplController::class, 'index']);
        Route::post('/proses_rekap', [SplController::class, 'proses_rekap']);
        Route::get('/create', [SplController::class, 'create']);
        Route::get('/modal', [SplController::class, 'modal']);
        Route::get('/slip-gaji', [SplController::class, 'slip']);
        Route::get('/cek_download_excel', [SplController::class, 'cek_download_excel']);
        Route::get('/download_excel', [SplController::class, 'download_excel']);
        Route::get('/get_data', [SplController::class, 'get_data']);
        Route::get('/get_data_rekap', [SplController::class, 'get_data_rekap']);
        Route::post('/', [SplController::class, 'store']);
    });

    Route::group(['prefix' => 'master'],function(){
        Route::group(['prefix' => 'jabatan'],function(){
            Route::get('/', [JabatanController::class, 'index']);
            Route::get('/get_data', [JabatanController::class, 'get_data']);
            Route::get('/delete_data', [JabatanController::class, 'delete_data']);
            Route::get('/delete_sertifikat', [JabatanController::class, 'delete_sertifikat']);
            Route::get('/create', [JabatanController::class, 'create']);
            Route::post('/', [JabatanController::class, 'store']);
            Route::post('/import', [JabatanController::class, 'import']);
        });

        Route::group(['prefix' => 'unit'],function(){
            Route::get('/', [UnitController::class, 'index']);
            Route::get('/get_data', [UnitController::class, 'get_data']);
            Route::get('/delete_data', [UnitController::class, 'delete_data']);
            Route::get('/delete_sertifikat', [UnitController::class, 'delete_sertifikat']);
            Route::get('/create', [UnitController::class, 'create']);
            Route::post('/', [UnitController::class, 'store']);
            Route::post('/import', [UnitController::class, 'import']);
        });

        Route::group(['prefix' => 'potongan'],function(){
            Route::get('/', [PotonganController::class, 'index']);
            Route::get('/get_data', [PotonganController::class, 'get_data']);
            Route::get('/delete_data', [PotonganController::class, 'delete_data']);
            Route::get('/delete_sertifikat', [PotonganController::class, 'delete_sertifikat']);
            Route::get('/create', [PotonganController::class, 'create']);
            Route::post('/', [PotonganController::class, 'store']);
            Route::post('/import', [PotonganController::class, 'import']);
        });

        Route::group(['prefix' => 'group'],function(){
            Route::get('/', [GroupController::class, 'index']);
            Route::get('/get_data', [GroupController::class, 'get_data']);
            Route::get('/delete_data', [GroupController::class, 'delete_data']);
            Route::get('/delete_sertifikat', [GroupController::class, 'delete_sertifikat']);
            Route::get('/create', [GroupController::class, 'create']);
            Route::post('/', [GroupController::class, 'store']);
            Route::post('/import', [GroupController::class, 'import']);
        });

        Route::group(['prefix' => 'jadwal'],function(){
            Route::get('/', [JadwalController::class, 'index']);
            Route::get('/get_data', [JadwalController::class, 'get_data']);
            Route::get('/delete_data', [JadwalController::class, 'delete_data']);
            Route::get('/delete_sertifikat', [JadwalController::class, 'delete_sertifikat']);
            Route::get('/create', [JadwalController::class, 'create']);
            Route::post('/', [JadwalController::class, 'store']);
            Route::post('/proses_jadwal', [JadwalController::class, 'proses_jadwal']);
            Route::post('/import', [JadwalController::class, 'import']);
        });

        Route::group(['prefix' => 'tunjangan'],function(){
            Route::get('/', [TunjanganController::class, 'index']);
            Route::get('/get_data', [TunjanganController::class, 'get_data']);
            Route::get('/get_data_tunjangan', [TunjanganController::class, 'get_data_tunjangan']);
            Route::get('/delete_data', [TunjanganController::class, 'delete_data']);
            Route::get('/delete_sertifikat', [TunjanganController::class, 'delete_sertifikat']);
            Route::get('/create', [TunjanganController::class, 'create']);
            Route::post('/', [TunjanganController::class, 'store']);
            Route::post('/import', [TunjanganController::class, 'import']);

        });

        Route::group(['prefix' => 'shift'],function(){
            Route::get('/', [ShiftController::class, 'index']);
            Route::get('/modal', [ShiftController::class, 'modal']);
            Route::get('/get_data', [ShiftController::class, 'get_data']);
            Route::get('/delete_data', [ShiftController::class, 'delete_data']);
            Route::get('/delete_sertifikat', [ShiftController::class, 'delete_sertifikat']);
            Route::get('/create', [ShiftController::class, 'create']);
            Route::post('/', [ShiftController::class, 'store']);
            Route::post('/import', [ShiftController::class, 'import']);
            
        });

    });

});
