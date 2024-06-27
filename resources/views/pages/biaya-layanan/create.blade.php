<div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">Input Biaya Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div id="errorMessages"></div>
                <div class="row">
                    <div class="col-md-12">
                        <form id="myForm" action="{{ route('biaya.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="layanan_select">Jenis Permohonan</label>
                                <select class="form-control" id="layanan_select" name="layanan_select">
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
                                <input type="text" class="form-control" id="namabiaya" placeholder="Biaya Admin"
                                    placeholder="Biaya Admin" name="nama_biaya">
                                {{-- @error('nama_biaya')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror --}}
                            </div>

                            <div class="form-group">
                                <label for="biayaLayanan">Biaya Layanan</label>
                                <input type="number" class="form-control" id="biayaLayanan" placeholder="1000"
                                    name="biaya_layanan" min="0">
                                {{-- @error('biaya_layanan')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror --}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn  btn-primary">Save changes</button>
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
        $('body').on('click', '#btn-create-post', function() {

            //open modal
            $('#exampleModalLive').modal('show');
        });
        $('#myForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var nama_biaya = $('#namabiaya').val();
            var layanan_select = $('#layanan_select').val();
            var biaya_layanan = $('#biayaLayanan').val();

            // Send the AJAX request    
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });




            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: {
                    "nama_biaya": nama_biaya,
                    "layanan_select": layanan_select,
                    "biaya_layanan": biaya_layanan,
                    _token: csrfToken,

                },
                // headers: {
                //     'X-CSRF-TOKEN': csrfToken
                // },
                success: function(response) {
                    if (response.success) {
                        setTimeout(() => {
                            var redirect_target =
                                "{{ route('biaya.show', ':id') }}";
                            redirect_target = redirect_target.replace(':id',
                                layanan_select);
                            window.location.href = redirect_target;

                        }, 800);

                        $('#myForm').trigger('reset');
                        $('#exampleModalLive').modal('hide');



                        var alertHtml =
                            '<div class="index-card alert alert-success alert-dismissible fade show" role="alert">' +
                            'Your form has been submitted successfully.' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                            '</div>';

                        $('.index-card').html(alertHtml).show();


                    }
                    console.log('sukses');
                },
                error: function(xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    console.log('Errors:', errors); // Log the errors object
                    $('.text-danger').remove(); // Remove any existing error messages

                    $.each(errors, function(key, value) {
                        var errorHtml = '<p class="text-danger">' + value + '</p>';
                        $('#myForm').find('[name="' + key + '"]').after(errorHtml);
                        console.log('Key:', key, 'Value:', value);
                    });

                    // $.each(errors, function(key, value) {
                    //     var errorHtml = '<p class="text-danger">' + value + '</p>';
                    //     $('#exampleModalLive .modal-body #errorMessages').append(
                    //         errorHtml); // Append error message inside the modal
                    //     console.log('Key:', key, 'Value:',
                    //         value); // Log key and value for debugging
                    // });

                    $('#exampleModalLive').modal(
                        'show'); // Show the modal with error messages
                }
            });
        });
    });
</script>
