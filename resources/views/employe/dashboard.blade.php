            <div class="row">
				<!-- begin col-3 -->
				<div class="col-xl-2 col-md-6">
					<div class="widget widget-stats bg-teal">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">SEMUA EMPLOYE</div>
							<div class="stats-number">{{sum_employe_all()}}</div>
							<div class="stats-desc">semua employe</div>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-xl-2 col-md-6">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">MELENGKAPI</div>
							<div class="stats-number">{{sum_employe_lengkap()}}</div>
							<div class="stats-desc">sudah dilengkap1</div>

						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-xl-2 col-md-6">
					<div class="widget widget-stats bg-indigo">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">NON AKTIF</div>
							<div class="stats-number">{{sum_employe_nonaktif()}}</div>
							<div class="stats-desc">employe non aktif</div>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-xl-2 col-md-6">
					<div class="widget widget-stats bg-dark">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">KONTRAK SELESAI</div>
							<div class="stats-number">{{sum_employe_selesai()}}</div>
							<div class="stats-desc">selsai kontrak</div>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-md-6">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon stats-icon-lg"><i class="fa fa-users fa-fw"></i></div>
						<div class="stats-content">
							<div class="stats-title">KONTRAK LIMIT</div>
							<div class="stats-number">{{sum_employe_limit()}}</div>
							<div class="stats-desc">mendekati selesai</div>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>