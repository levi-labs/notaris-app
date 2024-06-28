<div class="form-group">
    <span class="text-dark">KTP & KK Penjual dan Pembeli*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="inputGroupFile01" name="ktp_kk_penjual_pembeli">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        @error('ktp_kk_penjual_pembeli')
            <p class="text-danger" id="ktp_kk_penjual_pembeli-error"> {{ $message }}
            </p>
        @enderror
    </div>
</div>

<div class="form-group">
    <span class="text-dark">NPWP Penjual dan Pembeli*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="inputGroupFile02" name="npwp_penjual_pembeli">
        <label class="custom-file-label" for="inputGroupFile2">Choose file</label>
        @error('npwp_penjual_pembeli')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Bukti lunas PBB tahun terakhir*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="inputGroupFile03" name="bukti_lunas_pbb">
        <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
        @error('bukti_lunas_pbb')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Sertifikat tanah (jika belum ada lampirkan Girik)*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="inputGroupFile04" name="sertifikat_tanah">
        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
        @error('sertifikat_tanah')
            <p class="text-danger mb-2">{{ $message }}</p>
        @enderror
    </div>
</div>
<div class="form-group">
    <span class="text-dark">Buku Nikah*</span>
    <div class="custom-file my-2">
        <input type="file" class="custom-file-input" id="inputGroupFile05" name="buku_nikah">
        <label class="custom-file-label" for="inputGroupFile5">Choose
            file</label>
        @error('buku_nikah')
            <p class="text-danger mb-2">{{ $message }}</p>
        @enderror
    </div>
</div>
