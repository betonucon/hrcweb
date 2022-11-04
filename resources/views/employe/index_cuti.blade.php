@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Cuti</li>
    </ol>
    <h1 class="page-header">Cuti <small> (tampilan daftar cuti karyawan)</small></h1>
    <div class="btn-group" style="margin-bottom:1%">
        <button class="btn btn-success" onclick="$('#modal-import').modal('show')"><i class="fas fa-cog"></i> Terapkan Jadwal</button>
        <button class="btn btn-success" onclick="$('#modal-reset').modal('show')"><i class="fas fa-sync-alt"></i> Reset Cuti Tahun</button>

    </div>
    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Daftar Cuti</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="note note-warning note-with-right-icon m-b-15">
                <div class="note-content text-right">
                    <h4><b>Notifikasi</b></h4>
                    <p>
                        Proses perbaharuan cuti akan diperbaharui 1x dalam setahun dengan jumlah 12 cuti, jika cuti tahun sebelumnya masih ada maka cuti tersebut akan ditambahkan
                    </p>
                </div>
                <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
            </div>
            
            <div class="table-responsive ">
                <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-nowrap" width="5%">No</th>
                            <th class="text-nowrap" width="7%">NIK</th>
                            <th class="text-nowrap" width="12%">NO KTP</th>
                            <th class="text-nowrap">Nama</th>
                            <th class="text-nowrap" width="8%">Tahun</th>
                            <th class="text-nowrap" width="8%">Digunakan</th>
                            <th class="text-nowrap" width="8%">Sisa</th>
                            <th class="text-nowrap" width="4%">Act</th>
                        </tr>
                    </thead>
                    
                </table>
           
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-import" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Perbaharuan Cuti Tahunan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div>
                <form class="form-horizontal form-bordered" id="mydataimport" method="post" action="{{ url('employe/perbaharuan_cuti') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <div class="form-group">
                        <label>Tahun</label>
                        <select   name="tahun" class="form-control" placeholder="ketik disini...">
                            @for($x=2020;$x<=date('Y');$x++)
                                <option value="{{$x}}">{{$x}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cuti Tahunan</label>
                        <input type="number"  name="cuti" class="form-control" value="12" placeholder="ketik disini...">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="import-data" >Proses</a>
            </div>
        </div>
    </div>
</div>           
<div class="modal fade" id="modal-reset" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reset Ulang Cuti Tahunan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasireset">
                    <div id="notifikasi-reset"></div>
                    
                </div>
                <form class="form-horizontal form-bordered" id="mydatareset" method="post" action="{{ url('employe/reset_cuti') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <div class="form-group">
                        <label>Tahun</label>
                        <select   name="tahun" class="form-control" placeholder="ketik disini...">
                            @for($x=2020;$x<=date('Y');$x++)
                                <option value="{{$x}}">{{$x}}</option>
                            @endfor
                        </select>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="reset-data" >Proses</a>
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
        /*
        Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
        Version: 4.6.0
        Author: Sean Ngu
        Website: http://www.seantheme.com/color-admin/admin/
        */
        
        var handleDataTableFixedHeader = function() {
            "use strict";
            
            if ($('#data-table-fixed-header').length !== 0) {
                var table=$('#data-table-fixed-header').DataTable({
                    lengthMenu: [20, 40, 60],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: true,
                    ajax:"{{ url('employe/get_data_cuti')}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'nik' },
						{ data: 'no_ktp' },
						{ data: 'nama' },
                        { data: 'cuti_update' },
                        { data: 'cuti_digunakan' },
                        { data: 'sisa_cuti' },
                        { data: 'action' },
						
					],
					language: {
						paginate: {
							// remove previous & next text from pagination
							previous: '<< previous',
							next: 'Next>>'
						}
					}
                });
            }
        };

        var TableManageFixedHeader = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDataTableFixedHeader();
                }
            };
        }();

        $(document).ready(function() {
			TableManageFixedHeader.init();

		});

        $('#notifikasiimport').hide();
        $('#notifikasireset').hide();
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
								var table=$('#data-table-fixed-header').DataTable();
								table.ajax.url("{{ url('employe/get_data')}}").load();
							}
						});
					
					
				} else {
					
				}
			});
			
		}

        $('#import-data').on('click', () => {
            
            var form=document.getElementById('mydataimport');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('employe/perbaharuan_cuti') }}",
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
                            var table=$('#data-table-fixed-header').DataTable();
                            table.ajax.url("{{ url('employe/get_data_cuti')}}").load();
                                
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#notifikasiimport').show();
                            $('#notifikasi-import').html(msg);
                        }
                        
                        
                    }
                });
        });
        $('#reset-data').on('click', () => {
            
            var form=document.getElementById('mydatareset');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('employe/reset_cuti') }}",
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
                            $('#modal-reset').modal('hide');
                            document.getElementById("loadnya").style.width = "0px";
                            swal("Success! berhasil direset!", {
									icon: "success",
                            });
                            var table=$('#data-table-fixed-header').DataTable();
                            table.ajax.url("{{ url('employe/get_data_cuti')}}").load();
                                
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#notifikasireset').show();
                            $('#notifikasi-reset').html(msg);
                        }
                        
                        
                    }
                });
        });
    </script>
@endpush

@push('ajax')
   
@endpush
