<table>
    <thead>
        <tr>
            <th colspan="7" align="center"><b>DAFTAR LEMBUR KARYAWAN</b></th>
        </tr>
        <tr>
            <th colspan="7" align="center"><b>PERIODE {{$mulai}} s/d {{$sampai}}</b></th>
        </tr>
    </thead>
</table>
<table>
    <thead>
        <tr>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="center" width="50px">No</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">NIK</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" width="200px">Nama</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">Tanggal</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">Mulai</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">Sampai</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left" width="100px">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $total=0;

        ?>
        @foreach($datanya as $no=>$o)
        <?php
            if(($no+1)%2){
                $color="#fcfdfa";
            }else{
                $color="#e9ffc7";
            }
            $total+=$o->total;
        ?>
        <tr>
            <td align="left" style="background:{{$color}};border:solid 1px #000">{{$no+1}}</td>
            <td align="left" style="background:{{$color}};border:solid 1px #000">{{$o->nik}}</td>
            <td align="left" style="background:{{$color}};border:solid 1px #000">{{$o->memploye['nama']}}</td>
            <td align="left" style="background:{{$color}};border:solid 1px #000">{{$o->tanggal}}</td>
            <td align="left" style="background:{{$color}};border:solid 1px #000">{{$o->jam_masuk}}</td>
            <td align="left" style="background:{{$color}};border:solid 1px #000">{{$o->jam_pulang}}</td>
            <td  style="background:{{$color}};border:solid 1px #000">{{$o->total}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold" align="left">Total</th>
            <th style="background:#9aa389;color:#000;border:solid 1px #000;font-weight:bold"  width="100px">{{$total}}</th>
        </tr>
    </tfoot>
</table>