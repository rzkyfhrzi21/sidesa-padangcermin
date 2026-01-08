<h3 align="center">SURAT KETERANGAN KELAHIRAN</h3>
<p align="center"><b>Nomor: <?= $data['nomor_dokumen']; ?></b></p>
<hr>

<p>Yang bertanda tangan di bawah ini menerangkan bahwa telah lahir seorang anak:</p>

<table cellpadding="4">
    <tr>
        <td width="160">Nama Anak</td>
        <td>:</td>
    </tr>
    <tr>
        <td>Tempat/Tgl Lahir</td>
        <td>:</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
    </tr>
</table>

<p>Berdasarkan keterangan saksi:</p>

<table cellpadding="4">
    <tr>
        <td width="160">Nama Saksi</td>
        <td>: <?= $data['kepala_keluarga']; ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: <?= $data['alamat']; ?></td>
    </tr>
</table>

<p>
    Surat ini dibuat untuk keperluan administrasi kependudukan.
</p>

<br><br>
<p align="right">
    Padang Cermin, <?= date('d-m-Y'); ?><br>
    Kepala Desa Padang Cermin
</p>