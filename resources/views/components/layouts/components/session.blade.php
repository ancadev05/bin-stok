@if (session('status'))
{{-- alert sukses --}}
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
