@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Employe</li>
    </ol>
    <h1 class="page-header">Employe <small> (tampilan daftar karyawan)</small></h1>
    <div class="btn-group" style="margin-bottom:1%">
        <button class="btn btn-sm btn-success" onclick="location.assign(`{{url('employe/create')}}?id=0`)"><i class="fas fa-plus"></i> Tambah </button>
        <button class="btn btn-success" onclick="$('#modal-import').modal('show')"><i class="fas fa-upload"></i> Import</button>
        <button class="btn btn-success" onclick="proses_create_user()"><i class="fas fa-sync "></i> Reset All Auth</button>
        
    </div>
    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Daftar Employe</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div id="tampil_dashboard"></div>
            <div class="table-responsive ">
                <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-nowrap" width="5%">No</th>
                            <th class="text-nowrap" width="7%">NIK</th>
                            <th class="text-nowrap" >NO KTP</th>
                            <th class="text-nowrap">Nama</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">No Handphone</th>
                            <th class="text-nowrap">JK</th>
                            <th class="text-nowrap">TTGL</th>
                            <th class="text-nowrap">Jabatan</th>
                            <th class="text-nowrap" width="5%">M.Aktif</th>
                            <th class="text-nowrap" width="8%">Act</th>
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
                <h4 class="modal-title">Alert Header</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div>
                <form class="form-horizontal form-bordered" id="mydataimport" method="post" action="{{ url('employe/import') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <div class="form-group">
                        <label>Upload File Excel</label>
                        <input type="file" name="file" class="form-control" />
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
                    ajax:"{{ url('employe/get_data')}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'nik' },
						{ data: 'no_ktp' },
						{ data: 'nama' },
                        { data: 'email' },
						{ data: 'no_hp' },
						{ data: 'jenis_kelamin' },
						
						{ data: 'ttgl' },
						{ data: 'jabatan' },
                        { data: 'statuskontrak' },
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
        $('#tampil_dashboard').load("{{url('employe/dashboard')}}");
        $('#notifikasiimport').hide();
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
        function proses_create_user(){
           
			swal({
				title: "Yakin mereset ulang Authentication ?",
				text: "semua password akan menjadi default yaitu 12345678",
				type: "warning",
				icon: "info",
				showCancelButton: true,
				align:"center",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, proces!",
				closeOnConfirm: false
			}).then((willDelete) => {
				if (willDelete) {
						$.ajax({
							type: 'GET',
							url: "{{url('employe/proses_create_user')}}",
							data: "id=",
							success: function(msg){
								swal("Success! berhasil diproses!", {
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
                    url: "{{ url('employe/import') }}",
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
                            table.ajax.url("{{ url('employe/get_data')}}").load();
                                
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#notifikasiimport').show();
                            $('#notifikasi-import').html(msg);
                        }
                        
                        
                    }
                });
        });
    </script>
@endpush

@push('ajax')
    
@endpush
