
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>HRC WEB</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
    <style>
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
    </style>
</head>
<body class="pace-top">
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
	
	<!-- begin login-cover -->
	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- end login-cover -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-v2" data-pageload-addclass="animated fadeIn">
			<!-- begin brand -->
			<div class="login-header">
				<div class="brand">
					<span class="logo"></span> <b>HRC</b> WEB
					<small>Portal Masuk Aplikasi HRC WEB</small>
				</div>
				<div class="icon">
					<i class="fa fa-lock"></i>
				</div>
			</div>
			<!-- end brand -->
			<!-- begin login-content -->
			<div class="login-content">
				<form action="{{ route('login') }}" method="POST" class="margin-bottom-0">
                    @csrf
					<div class="form-group m-b-20">
						<input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="username" required />
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>Username tidak terdaftar</strong>
                            </span>
                        @endif
                    </div>
                    
					<div class="form-group m-b-20">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>Password salah</strong>
                            </span>
                        @endif
                    </div>
					<div class="checkbox checkbox-css m-b-20">
						<input type="checkbox" id="remember_checkbox" /> 
						<label for="remember_checkbox">
							Remember Me
						</label>
					</div>
					<div class="login-buttons">
						<button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
					</div>
					<div class="m-t-20">
						Not a member yet? Click <a href="javascript:;">here</a> to register.
					</div>
				</form>
			</div>
			<!-- end login-content -->
		</div>
		<!-- end login -->
		
		<!-- begin login-bg -->
		<ul class="login-bg-list clearfix">
			<li class="active"><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-17.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-17.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-16.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-16.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-15.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-15.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-14.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-14.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-13.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-13.jpg)"></a></li>
			<li><a href="javascript:;" data-click="change-bg" data-img="{{url_plug()}}/assets/img/login-bg/login-bg-12.jpg" style="background-image: url({{url_plug()}}/assets/img/login-bg/login-bg-12.jpg)"></a></li>
		</ul>
		<!-- end login-bg -->
		
		
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{url_plug()}}/assets/js/app.min.js"></script>
	<script src="{{url_plug()}}/assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{url_plug()}}/assets/js/demo/login-v2.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
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

       
		
    </script>
</body>
</html>