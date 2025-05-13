<form action="{{ route('dokumen.upload', $siswa->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>KK:</label>
        <input type="file" name="kk">
    </div>
    <div>
        <label>Akte:</label>
        <input type="file" name="akte">
    </div>
    <div>
        <label>Surat Keterangan Lulus:</label>
        <input type="file" name="surat_keterangan_lulus">
    </div>
    <div>
        <label>KIP:</label>
        <input type="file" name="kip">
    </div>
    <button type="submit">Upload</button>
</form>
