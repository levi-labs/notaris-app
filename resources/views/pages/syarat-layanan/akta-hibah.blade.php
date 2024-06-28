<div class="form-group">
    <span class="text-dark">KTP & KK Pemberi dan Penerima Hibah*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="ktp_kk_pemberi_penerima_hibah"
            name="ktp_kk_pemberi_penerima_hibah">
        <label class="custom-file-label" for="ktp_kk_pemberi_penerima_hibah">Choose file</label>
        @error('ktp_kk_pemberi_penerima_hibah')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">NPWP Pemberi dan Penerima Hibah</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="npwp_pemberi_penerima_hibah"
            name="npwp_pemberi_penerima_hibah">
        <label class="custom-file-label" for="npwp_pemberi_penerima_hibah">Choose file</label>
        @error('npwp_pemberi_penerima_hibah')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Bukti lunas PBB tahun terakhir*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="bukti_lunas_pbb" name="bukti_lunas_pbb">
        <label class="custom-file-label" for="bukti_lunas_pbb">Choose file</label>
        @error('bukti_lunas_pbb')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Sertifikat tanah (jika belum ada lampirkan Girik)*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="sertifikat-tanah" name="sertifikat_tanah">
        <label class="custom-file-label" for="sertifikat-tanah">Choose file</label>
        @error('sertifikat_tanah')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Buku Nikah</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="buku-nikah" name="buku_nikah">
        <label class="custom-file-label" for="buku-nikah">Choose file</label>
        @error('buku_nikah')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
