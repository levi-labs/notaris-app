<div id="exampleModalUpdate" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">Update Biaya Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div id="errorMessages"></div>
                <div class="row">
                    <div class="col-md-12">
                        <form id="myFormEdit" action="{{ route('biaya.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="layanan_select">Jenis Permohonan</label>
                                <select class="form-control" id="layanan_select-edit" name="layanan_select">
                                    <option selected disabled>Pilih Jenis Layanan Permohonan</option>
                                    @foreach ($layanan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                {{-- @error('layanan_select')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror --}}
                            </div>
                            <div class="form-group">
                                <label for="namabiaya">Nama Biaya</label>
                                <input type="text" class="form-control" id="namabiaya-edit" placeholder="Biaya Admin"
                                    placeholder="Biaya Admin" name="nama_biaya">
                                {{-- @error('nama_biaya')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror --}}
                            </div>

                            <div class="form-group">
                                <label for="biayaLayanan">Biaya Layanan</label>
                                <input type="number" class="form-control" id="biayaLayanan-edit" placeholder="1000"
                                    name="biaya_layanan" min="0">
                                {{-- @error('biaya_layanan')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn  btn-primary" id="update">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('body').on('click', '#btn-edit-post', function() {

            console.log("masuk");
            let id = $(this).attr('data-id');
            console.log(id);
            let url = $(this).data('url');

            console.log("biaya/" + id);
            $.ajax({
                type: 'GET',
                url: `/biaya/edit/${id}`,
                cache: false,
                success: function(response, status, xhr) {
                    if (xhr.status == 200) {
                        console.log(response.data);
                        $('#id').val(response.data.id);
                        $('#layanan_select-edit').val(response.data.layanan_permohonan_id);
                        $('#namabiaya-edit').val(response.data.nama_biaya);
                        $('#biayaLayanan-edit').val(response.data.harga);

                        $('#exampleModalUpdate').modal('show');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('#update').on('click', function(e) {
            e.preventDefault();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var id = $('#id').val();
            var layanan_select = $('#layanan_select-edit').val();
            var namabiaya = $('#namabiaya-edit').val();
            var biayaLayanan = $('#biayaLayanan-edit').val();
            var url = "{{ route('biaya.update', ':id') }}";

            url = url.replace(':id', id);


            // Send the AJAX request    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'PUT',
                url: url,
                data: {
                    layanan_select: layanan_select,
                    nama_biaya: namabiaya,
                    biaya_layanan: biayaLayanan
                },
                success: function(response, status, xhr) {
                    console.log('oke');
                    if (xhr.status == 200) {
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                        $('#myFormEdit').trigger('reset');
                        $('#exampleModalUpdate').modal('hide');
                        var alertHtml =
                            '<div class="index-card alert alert-success alert-dismissible fade show" role="alert">' +
                            'Your form has been submitted successfully.' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>';

                        $('.index-card').html(alertHtml).show();

                        // window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    console.log('Errors:', errors); // Log the errors object
                    $('.text-danger').remove(); // Remove any existing error messages

                    $.each(errors, function(key, value) {
                        var errorHtml = '<p class="text-danger">' + value + '</p>';
                        $('#myFormEdit').find('[name="' + key + '"]').after(
                            errorHtml);
                        console.log('Key:', key, 'Value:', value);
                    });

                    $('#exampleModalUpdate').modal(
                        'show'); // S
                }
            });
        })
    });
</script>
