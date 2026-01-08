<h3 align="center">SURAT KETERANGAN KEMATIAN</h3>
<p align="center"><b>Nomor: <?= $data['nomor_dokumen']; ?></b></p>
<hr>

<p>Yang bertanda tangan di bawah ini menerangkan bahwa:</p>

<table cellpadding="4">
    <tr>
        <td width="160">Nama Almarhum/Almarhumah</td>
        <td>:</td>
    </tr>
    <tr>
        <td>NIK</td>
        <td>:</td>
    </tr>
    <tr>
        <td>Alamat Terakhir</td>
        <td>:</td>
    </tr>
</table>

<p>
    Telah meninggal dunia dan keterangan tersebut berdasarkan saksi:
</p>

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
    Surat ini dibuat untuk keperluan administrasi dan digunakan sebagaimana mestinya.
</p>

<br><br>
<p align="right">
    Padang Cermin, <?= date('d-m-Y'); ?><br>
    Kepala Desa Padang Cermin
</p>