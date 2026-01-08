<h3 align="center">SURAT KETERANGAN DOMISILI</h3>
<p align="center"><b>Nomor: <?= $data['nomor_dokumen']; ?></b></p>
<hr>

<p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

<table cellpadding="4">
    <tr>
        <td width="160">Nama</td>
        <td>: <?= $data['nama_lengkap']; ?></td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>: <?= $data['nik']; ?></td>
    </tr>
    <tr>
        <td>Alamat Domisili</td>
        <td>: <?= $data['alamat']; ?></td>
    </tr>
</table>

<p>
    Yang bersangkutan benar berdomisili di wilayah Desa Padang Cermin.
</p>

<p>
    Surat ini dibuat untuk keperluan administrasi dan digunakan sebagaimana mestinya.
</p>

<br><br>
<p align="right">
    Padang Cermin, <?= date('d-m-Y'); ?><br>
    Kepala Desa Padang Cermin
</p>