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
                    ajax:"{{ url('home/get_data')}}",
					columns: [
						{ data: 'tampil' },
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
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Dashboard <small>header small text goes here...</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				@foreach(get_group() as $group)
				<div class="col-xl-2 col-md-6">
					<div class="widget widget-stats bg-{{$group->background}}">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4 style="text-transform:uppercase">{{$group->group}}</h4>
							<p>{{jumlah_wajid_kehadiran($bulan,$tahun,$group->id)}}</p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<!-- end row -->
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				
				
				<div class="col-xl-8 ui-sortable">
					<div class="panel panel-inverse" data-sortable-id="chart-js-2" data-init="true">
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Bar Chart</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="panel-body">
							<p>
								A bar chart is a way of showing data as bars.
								It is sometimes used to show trend data, and the comparison of multiple data sets side by side.
							</p>
							<div><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
								<canvas id="bar-chart" data-render="chart-js" width="495" height="247" style="display: block; width: 495px; height: 247px;" class="chartjs-render-monitor"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="index-6">
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">GROUP DAN JADWAL {{bulan($bulan)}} {{$tahun}}</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-valign-middle table-panel mb-0">
								<thead>
									<tr>	
										<th>Group</th>
										<th>Employe</th>
										<th>H.Kerja</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach(get_group() as $grp)
                                        <tr>
                                            <td  style="background:{{$grp->background}};text-transform:uppercase">
                                                <label class="label">{{$grp->group}}</label>
                                            </td>
                                            <td>
                                                {{jumlah_employe($grp->id)}}
                                            </td>
                                            <td>
                                                {{jumlah_wajid_kehadiran($bulan,$tahun,$grp->id)}} Hari
                                            </td>
                                            
                                        </tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<!-- end panel -->
					
				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
        
@endsection
@section('script')
    @include('layouts.scripttable')
	<script src="{{url_plug()}}/assets/plugins/chart.js/dist/Chart.min.js"></script>
@endsection
@push('ajax')
    <script>
		/*
		Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
		Version: 4.6.0
		Author: Sean Ngu
		Website: http://www.seantheme.com/color-admin/admin/
		*/

		Chart.defaults.global.defaultFontColor = COLOR_DARK;
		Chart.defaults.global.defaultFontFamily = FONT_FAMILY;
		Chart.defaults.global.defaultFontStyle = FONT_WEIGHT;

		var randomScalingFactor = function() { 
			return Math.round(Math.random()*100)
		};

		
		var barChartData = {
			labels: [
				@foreach(get_group() as $grp)
					'{{$grp->group}}',
				@endforeach
			],
			datasets: [{
				label: 'Total',
				borderWidth: 2,
				borderColor: 'blue',
				backgroundColor: 'blue',
				data: [
					@foreach(get_group() as $grp)
						{{$grp->id}},
					@endforeach
				]
			}, {
				label: 'Hadir',
				borderWidth: 2,
				borderColor: 'green',
				backgroundColor: 'green',
				data: [
					@foreach(get_group() as $grp)
						{{$grp->id}},
					@endforeach
				]
			}, {
				label: 'Sakit',
				borderWidth: 2,
				borderColor: 'red',
				backgroundColor: 'red',
				data: [
					@foreach(get_group() as $grp)
						{{$grp->id}},
					@endforeach
				]
			}]
		};

		

		var handleChartJs = function() {
			var ctx2 = document.getElementById('bar-chart').getContext('2d');
			var barChart = new Chart(ctx2, {
				type: 'bar',
				data: barChartData
			});

			
		};

		var ChartJs = function () {
			"use strict";
			return {
				//main function
				init: function () {
					handleChartJs();
				}
			};
		}();

		$(document).ready(function() {
			ChartJs.init();
		});
    </script>
@endpush
