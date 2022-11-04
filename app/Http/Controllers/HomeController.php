<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(request $request)
    {
        error_reporting(0);
        if($request->bulan==""){
            $bulan=date('m');
        }else{
            $bulan=$request->bulan;
        }
        if($request->tahun==""){
            $tahun=date('Y');
        }else{
            $tahun=$request->tahun;
        }
        dd($bulan);
        $template='top';
        return view('home',compact('template','bulan','tahun'));
    }
    public function get_data(request $request)
    {
        $data = User::orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tampil', function ($row) {
                $btn='
                <div class="panel panel-inverse" data-sortable-id="form-plugins-1" style="border: solid 1px #ceced1;margin-bottom: 0.1%;">
                    <div class="panel-heading ui-sortable-handle" style="background: #9aafc1; color: #fff;">
                        <h4 class="panel-title">MEJA NO : 1</h4>
                        <div class="panel-heading-btn">
                         </div>
                    </div>
                    <div class="panel-body">
                        
                    </div>
                </div>';
                return $btn;
            })
            
            ->rawColumns(['tampil'])
            ->make(true);
    }
}
