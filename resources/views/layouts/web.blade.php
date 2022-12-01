
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>HRC WEB</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
    <link href="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	
	<link href="{{url_plug()}}/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/datatables.net-fixedheader-bs4/css/fixedheader.bootstrap4.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<style>
		.form-control {
			border: 1px solid #afc4d5;
		 }
		.panel.panel-inverse>.panel-heading {
			background: #f2f4f7;
			color: #342f2f;
			text-transform: uppercase;
			font-weight: bold;
		}
		.form-horizontal.form-bordered .form-group .col-form-label+div {
			border-left: 1px solid #fbfbfb;
		}
		.form-horizontal.form-bordered .form-group {
			border-bottom: 1px solid #fbfbfb;
			margin: 0;
			background: #fafaff;
		}
		.widget-icon.widget-icon-xl {
			width: 90%;
			height: 100px;
			font-size: 56px;
		}
		.photo_akun{
			height: 110px;
    		width: 100%;
		}
		.form-horizontal.form-bordered .form-group>div {
			padding: 6px;
		}
		.form-horizontal.form-bordered .form-group .col-form-label {
    		padding: 5px 15px;
			vertical-align:top;
		}
		.select2.select2-container .selection .select2-selection.select2-selection--multiple, .select2.select2-container .selection .select2-selection.select2-selection--single {
			border-color: #d5dbe0;
			outline: 0;
			height: 30px;
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-align: center;
			align-items: center;
		}
		
		.loadnya {
			height: 100%;
			width: 0;
			position: fixed;
			z-index: 1070;
			top: 0;
			left: 0;
			background-color: rgb(0,0,0);
			background-color: rgb(243 230 230 / 81%);
			overflow-x: hidden;
			transition: transform .9s;
		}
		.loadnya-content {
			position: relative;
			top: 25%;
			width: 100%;
			text-align: center;
			margin-top: 30px;
			color:#fff;
			font-size:20px;
		}
		.sidebar .sub-menu {
			background: #242020;
		}
		.sidebar .nav>li {
			position: relative;
			border-bottom: 1px solid #4a3e3e;
		}
		.sidebar .nav .has-sub.active>.sub-menu {
				background: #242020;
		}
		
	  
	  

	</style>
</head>
<body style="font-family: sans-serif;font-size: .75rem;background-color: #b4c0cd;">
	<!-- begin #page-loader -->
	<div id="loadnya" class="loadnya">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="loadnya-content">
			<button class="btn btn-light" type="button" disabled>
  				<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  				Loading...
			</button>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
    
	@include('layouts.container')
    
	<div class="modal fade" id="modal-notifikasi" style="display: none;" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Notifikasi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger m-b-0">
						<div id="notifikasi"></div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Tutup</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{url_plug()}}/assets/js/app.min.js"></script>
	
    <script src="{{url_plug()}}/assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	@yield('script')
	<script src="{{url_plug()}}/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="{{url_plug()}}/assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
	<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
	
	@stack('ajax')
	@stack('datatable')
	<script type="text/javascript">
       
		function load(){
			document.getElementById("loadnya").style.width = "100%";
		}
		function close_load(){
			document.getElementById("loadnya").style.width = "0%";
		}
		$(document).ready(function() {
			
			load();
		});
		
		window.setTimeout(function () {
			document.getElementById("loadnya").style.width = "0%";
		}, 500);

        
        $('.dropdown-toggle').dropdown()
		
    </script>
</body>
</html>