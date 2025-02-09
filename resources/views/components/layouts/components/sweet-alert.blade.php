<script>
    // alert jika berhasil hapus data
    Livewire.on('status', (data) => {
        swal({
            icon: data.icon,
            text: data.text,
            // timer: 2000,
            buttons: {
                confirm: {
                    className: data.btn
                }
            }
        });
    });
</script>
