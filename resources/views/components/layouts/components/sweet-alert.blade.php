@if (session('status'))
{{-- alert sukses create data--}}
    <script>
        swal({
            title: '{{ session('status') }}',
            icon: "success",
            timer: 1000,
            buttons: {
                confirm: {
                    className: 'btn btn-success'
                }
            },
        });
    </script>
@endif
<script>
    // success delete data
    Livewire.on('success', (data) => {
        swal({
            icon: 'success',
            text: data.text,
            // timer: 3000,
            buttons: {
                confirm: {
                    className: 'btn btn-success'
                }
            }
        });
    });

    // failed delete data
    Livewire.on('failed', (data) => {
        swal({
            icon: 'error',
            text: data.text,
            // timer: 3000,
            buttons: {
                confirm: {
                    className: 'btn btn-danger',
                }
            }
        });
    });
</script>
