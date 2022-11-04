<table border="1">
    <thead>
        <tr>
            <th colspan="8" align="center"><b>DAFTAR ABSENSI KARYAWAN</b></th>
        </tr>
        <tr>
            <th colspan="8" align="center"><b>PERIODE {{$tanggal}}</b></th>
        </tr>
    </thead>

    <thead>
        <tr>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="center" width="50px">No</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">NIK</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" width="200px">Nama</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">Tanggal</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">Masuk</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">Pulang</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">Telat </th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">P.Cepat</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">T.Telat</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $tmasuk=0;
            $tpulang=0;
            $ttelat=0;

        ?>
        @foreach(get_employe_aktif() as $no=>$o)
        <?php
            if(($no+1)%2){
                $color="#fcfdfa";
            }else{
                $color="#e9ffc7";
            }
            $tmasuk+=round(jam_selisih_absen($o->nik,$tanggal,'M'),3);
            $tpulang+=round(jam_selisih_absen($o->nik,$tanggal,'P'),3);
            $ttelat+=(round(jam_selisih_absen($o->nik,$tanggal,'M'),3)+round(jam_selisih_absen($o->nik,$tanggal,'P'),3));
        ?>
        <tr>
            <td style="background:{{$color}};border:solid 1px #000">{{$no+1}}</td>
            <td align="left" style="background:{{$color}};border:solid 1px #000">{{$o->nik}}</td>
            <td align="left" style="background:{{$color}};border:solid 1px #000">{{$o->nama}}</td>
            <td style="background:{{$color}};border:solid 1px #000">{{$tanggal}}</td>
            <td style="background:{{$color}};border:solid 1px #000">{{jam(jam_absen($o->nik,$tanggal,'M'))}}</td>
            <td style="background:{{$color}};border:solid 1px #000">{{jam(jam_absen($o->nik,$tanggal,'P'))}}</td>
            <td style="background:{{$color}};border:solid 1px #000">{{round(jam_selisih_absen($o->nik,$tanggal,'M'),3)}}</td>
            <td style="background:{{$color}};border:solid 1px #000">{{round(jam_selisih_absen($o->nik,$tanggal,'P'),3)}}</td>
            <td style="background:{{$color}};border:solid 1px #000">{{(round(jam_selisih_absen($o->nik,$tanggal,'M'),3)+round(jam_selisih_absen($o->nik,$tanggal,'P'),3))}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" >TOTAL</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" width="100px">{{$tmasuk}}</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" width="100px">{{$tpulang}}</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" width="100px">{{$ttelat}}</th>
        </tr>
    </tfoot>
</table>