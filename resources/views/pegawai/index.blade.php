@extends('layouts.web')
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
                $('#data-table-fixed-header').DataTable({
                    lengthMenu: [20, 40, 60],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: true,
                    ajax:"{{ url('produk/get_data')}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'username' },
						{ data: 'name' },
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
    </script>
@endpush
@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
        <li class="breadcrumb-item active">Blank Page</li>
    </ol>
    <h1 class="page-header">Blank Page <small>header small text goes here...</small></h1>
    <div class="btn-group" style="margin-bottom:1%">
        <button class="btn btn-sm btn-success" onclick="location.assign(`{{url('produk/create')}}?id=0`)"><i class="fas fa-plus"></i> Tambah </button>
        <button class="btn btn-success"><i class="fas fa-print"></i> Cetak Label</button>
    </div>
    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Bootstrap Date Time Picker</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body">
        
            <div class="table-responsive">
                <table id="data-table-fixed-header" class="table table-bordered table-td-valign-middle">
                    <thead>
                        <tr>
                            <th class="text-nowrap" width="5%">No</th>
                            <th class="text-nowrap">Username</th>
                            <th class="text-nowrap">Nama</th>
                            <th class="text-nowrap" width="8%">Act</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
        
@endsection
@section('script')
    @include('layouts.scripttable')
@endsection
@push('ajax')
    <script src="{{url_plug()}}/js/app.js"></script>
    <script type="text/javascript">
        $.noConflict();
        var i = 0;
        window.Echo.channel('message').listen('KirimCreated', (data) => {
            i++;
            // $("#notification").append('<div class="alert alert-success">'+i+'. '+data.title+'</div>');
            alert(i)
        });
    </script>
    
    
    

@endpush
