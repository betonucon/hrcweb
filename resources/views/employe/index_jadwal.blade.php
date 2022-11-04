@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Jadwal</li>
    </ol>
    <h1 class="page-header">Jadwal Employe <small> (tampilan daftar jadwal Employe)</small></h1>
    <div class="btn-group" style="margin-bottom:1%">
        <button class="btn btn-success" onclick="$('#modal-import').modal('show')"><i class="fas fa-cog"></i> Terapkan Jadwal</button>
        
    </div>
    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Daftar Jadwal Employe</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body form-horizontal form-bordered">
            <div class="form-group row">
                <label class="col-lg-5 col-form-label"></label>
                <label class="col-lg-1 col-form-label">Bulan</label>
                <div class="col-lg-2">
                    <select   id="bulan" value="{{$bulan}}" class="form-control form-control-sm" placeholder="ketik disini...">
                        @for($x=1;$x<13;$x++)
                            <option value="{{$x}}">{{bulan_int($x)}}</option>
                        @endfor
                    </select>
                </div>
                <label class="col-lg-1 col-form-label">Tahun</label>
                <div class="col-lg-2">
                    <input type="text"  maxlength="20"   id="tahun"  value="{{$tahun}}"  class="form-control form-control-sm" placeholder="ketik disini...">
                </div>
                <div class="col-lg-1">
                    <span class="btn btn-primary btn-sm" id="cari-data"><i class="fas fa-search"></i> Cari</span>
                </div>
            </div>
            <div class="table-responsive ">
                <table id="data-table-fixed-header"style="width:135%" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="font-size:11px" class="text-nowrap" width="3%">No</th>
                            <th style="font-size:11px" class="text-nowrap" width="5%" >NIK</th>
                            <th style="font-size:11px" class="text-nowrap" >Nama</th>
                            @foreach(get_jadwal($bulan,$tahun) as $bul=>$jad)
                            <th style="font-size:11px" class="text-nowrap"  width="2.4%" >{{$bul+1}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(get_employe_aktif() as $no=>$o)
                        <tr>
                            <td style="font-size:11px">{{$no+1}}</td>
                            <td style="font-size:11px">{{$o->nik}}</td>
                            <td style="font-size:11px">{{$o->nama}}</td>
                            @foreach(get_jadwal($bulan,$tahun) as $bul=>$jad)
                                <td style="font-size:11px;text-align:center;background:@if(cek_jadwal_employe($o->nik,$jad->tanggal)==0) #df6e6e @else @endif" >{{cek_jadwal_employe($o->nik,$jad->tanggal)}}
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
           
            </div>
        </div>
    </div>
</div>
           
<div class="modal fade" id="modal-import" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Penerapan Jadwal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiproses">
                    <div id="notifikasi-proses"></div>
                    
                </div>
                <form class="form-horizontal form-bordered" id="mydataproses" method="post" action="{{ url('employe/proses_jadwal') }}" enctype="multipart/form-data" >
                    @csrf 
                    <div class="form-group">
                        <label>Tahun</label>
                        <select   name="tahun" class="form-control" placeholder="ketik disini...">
                            @for($x=2020;$x<=date('Y');$x++)
                                <option value="{{$x}}">{{$x}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bulan</label>
                        <select   name="bulan" class="form-control form-control-sm" placeholder="ketik disini...">
                            @for($x=1;$x<13;$x++)
                                <option value="{{$x}}">{{bulan_int($x)}}</option>
                            @endfor
                        </select>
                    </div>
                    <!-- <input type="submit"> -->
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="proses-data" >Proses</a>
            </div>
        </div>
    </div>
</div>           
@endsection

@section('script')
    @include('layouts.scripttable')
@endsection
@push('datatable')
    <script type="text/javascript">
        

        $('#notifikasiproses').hide();
        // $('body .dropdown-toggle').dropdown(); 
        function delete_data(id){
           
			swal({
				title: "Yakin menghapus data ini ?",
				text: "data akan hilang dari daftar ini",
				type: "warning",
				icon: "error",
				showCancelButton: true,
				align:"center",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}).then((willDelete) => {
				if (willDelete) {
						$.ajax({
							type: 'GET',
							url: "{{url('employe/delete_data')}}",
							data: "id="+id,
							success: function(msg){
								swal("Success! berhasil terhapus!", {
									icon: "success",
								});
								
							}
						});
					
					
				} else {
					
				}
			});
			
		}

        $('#cari-data').on('click', () => {
            var bulan=$('#bulan').val();
            var tahun=$('#tahun').val();
            location.assign("{{ url('employe/jadwal') }}?bulan="+bulan+"&tahun="+tahun)
        });
        
        $('#proses-data').on('click', () => {
            
            var form=document.getElementById('mydataproses');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('employe/proses_jadwal') }}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
                        document.getElementById("loadnya").style.width = "100%";
                    },
                    success: function(msg){
                        var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            $('#modal-import').modal('hide');
                            document.getElementById("loadnya").style.width = "0px";
                            swal("Success! berhasil diimport!", {
									icon: "success",
                            });
                            location.assign("{{ url('employe/jadwal') }}?bulan="+bat[2]+"&tahun="+bat[3])
                                
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#notifikasiproses').show();
                            $('#notifikasi-proses').html(msg);
                        }
                        
                        
                    }
                });
        });
    </script>
@endpush

@push('ajax')
    
@endpush
