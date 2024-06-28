<div class="form-group">
    <span class="text-dark">KTP & KK Ahli Waris*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="ktp-kk-ahli-waris" name="ktp_kk_ahli_waris">
        <label class="custom-file-label" for="ktp-kk-ahli-waris">Choose file</label>
        @error('ktp_kk_ahli_waris')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="form-group">
    <span class="text-dark">NPWP Ahli Waris</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="npwp-ahli-waris" name="npwp_ahli_waris">
        <label class="custom-file-label" for="npwp-ahli-waris">Choose file</label>
        @error('npwp_ahli_waris')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Bukti lunas PBB tahun terakhir*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="pbb-tahun-terakhir" name="bukti_lunas_pbb">
        <label class="custom-file-label" for="pbb-tahun-terakhir">Choose file</label>
        @error('bukti_lunas_pbb')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Surat Kematian Pewaris*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="surat-kematian-pewaris" name="surat_kematian_pewaris">
        <label class="custom-file-label" for="surat-kematian-pewaris">Choose file</label>
        @error('surat_kematian_pewaris')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Akta Kelahiran Ahli Waris*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="akta-kelahiran-ahli-waris" name="akta_kelahiran_ahli_waris">
        <label class="custom-file-label" for="akta-kelahiran-ahli-waris">Choose file</label>
        @error('akta_kelahiran_ahli_waris')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Surat pernyataan ahli waris dari kelurahan*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="pernyataan-ahli-waris" name="pernyataan_ahli_waris">
        <label class="custom-file-label" for="pernyataan-ahli-waris">Choose file</label>
        @error('pernyataan_ahli_waris')
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
