
				
					<li class="has-sub @if(Request::is('master/*')==1) active @endif">
						<a href="javascript:;" class="text-white">
							<b class="caret"></b>
							<i class="fas fa-archive text-white"></i>
							<span>Master Data </span>
						</a>
						<ul class="sub-menu" @if(Request::is('master/*')==1) style="display: block;" @endif>
							<li><a href="{{url('master/jabatan')}}" >Jabatan {{Request::is('jabatan/*')}}</a></li>
							<li><a href="{{url('master/group')}}">Group</a></li>
							<li><a href="{{url('master/jadwal')}}">Jadwal</a></li>
							<li><a href="{{url('master/unit')}}">Unit Kerja</a></li>
							<li><a href="{{url('master/tunjangan')}}">Tunjangan & Kontribusi</a></li>
							<li><a href="{{url('master/potongan')}}">Potongan Bulanan</a></li>
						</ul>
					</li>
					<li class="has-sub @if(Request::is('employe/*')==1 || Request::is('employe')==1) active @endif">
						<a href="javascript:;"  class="text-white">
							<b class="caret"></b>
							<i class="fa fa-users text-white"></i>
							<span>Master Employe </span>
						</a>
						<ul class="sub-menu" @if(Request::is('employe/*')==1 || Request::is('employe')==1) style="display: block;" @endif>
							<li><a href="{{url('employe')}}" >Employe</a></li>
							<li><a href="{{url('employe/dokumen')}}">Dokumen</a></li>
							<li><a href="{{url('employe/jadwal')}}">Jadwal</a></li>
							<li><a href="{{url('employe/cuti')}}">Cuti</a></li>
							<li><a href="{{url('employe/penggajian')}}">Pendapatan Bulanan</a></li>
						</ul>
					</li>
					<li class="has-sub @if(Request::is('absen/*')==1 || Request::is('absen')==1) active @endif">
						<a href="javascript:;"  class="text-white">
							<b class="caret"></b>
							<i class="fa fa-calendar-alt text-white"></i>
							<span>Absensi </span>
						</a>
						<ul class="sub-menu" @if(Request::is('absen/*')==1 || Request::is('absen')==1) style="display: block;" @endif>
							<li><a href="{{url('absen')}}" >Absen Harian</a></li>
							<li><a href="{{url('absen/rekap')}}" >Rekapan Absensi</a></li>
						</ul>
					</li>
					<li class="has-sub @if(Request::is('spl/*')==1 || Request::is('spl')==1) active @endif">
						<a href="javascript:;"  class="text-white">
							<b class="caret"></b>
							<i class="fa fa-calendar-alt text-white"></i>
							<span>SPL </span>
						</a>
						<ul class="sub-menu" @if(Request::is('spl/*')==1 || Request::is('spl')==1) style="display: block;" @endif>
							<li><a href="{{url('spl')}}" >Pengajuan SPL</a></li>
							<li><a href="{{url('spl/rekap')}}" >Rekapan SPL</a></li>
						</ul>
					</li>
					<li class="has-sub @if(Request::is('slip')==1) active @endif">
						<a href="{{url('slip')}}"  class="text-white">
							<i class="fas fa-credit-card text-white"></i> 
							<span>Slip Gaji</span>
						</a>
					</li>
					
					
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left text-white"></i></a></li>
					
				