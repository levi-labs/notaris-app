<div id="biayaTambahan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">Input Biaya Tambahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"
                        id="close-modal">×</span></button>
            </div>
            <div class="modal-body">
                <div id="errorMessages"></div>
                <div class="row">
                    <div class="col-md-12">
                        <form id="myForm" action="{{ route('biaya-tambahan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="ppat_id" name="ppat_id" value="{{ $ppat->id }}">

                            <div class="form-group">
                                <label for="nama_biaya">Nama Biaya</label>
                                <input type="text" class="form-control" id="nama_biaya" placeholder="Biaya Admin"
                                    placeholder="Biaya Admin" name="nama_biaya">
                                {{-- @error('nama_biaya')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror --}}
                            </div>

                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="number" class="form-control" id="nominal" placeholder="1000"
                                    name="nominal" min="0">
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
        $('body').on('click', '#verify', function() {

            //open modal
            $('#biayaTambahan').modal('show');
        });
        $('#close-modal').on('click', function() {
            $('#biayaTambahan').modal('hide');
            $('.text-danger').remove();
            $('#myForm').trigger('reset');
            window.location.reload();

        });
        $('#myForm').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var nama_biaya = $('#nama_biaya').val();
            var ppat_id = $('#ppat_id').val();
            var nominal = $('#nominal').val();

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
                    "ppat_id": ppat_id,
                    "nominal": nominal,
                    _token: csrfToken,

                },
                // headers: {
                //     'X-CSRF-TOKEN': csrfToken
                // },
                success: function(response) {
                    if (response.success) {
                        setTimeout(() => {
                            window.location.reload();
                        }, 800);

                        $('#myForm').trigger('reset');
                        $('#biayaTambahan').modal('hide');



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

                    $('#biayaTambahan').modal(
                        'show'); // Show the modal with error messages
                }
            });
        });
    });
</script>
