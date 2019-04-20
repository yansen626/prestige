<script>
    $('.modal-footer').on('click', '.accept', function() {

        $.ajax({
            type: 'POST',
            url: '{{ route($routeUrl) }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'accept-id': $('#accept-id').val(),
                'type': 'json',
            },
            success: function(data) {
                if ((data.errors)){
                    setTimeout(function () {
                        toastr.error('Failed to Confirm', 'Peringatan', {timeOut: 6000, positionClass: "toast-top-center"});
                    }, 500);
                }
                else{
                    window.location = '{{ route($redirectUrl) }}';
                }
            },
            error: function (data) {
                alert("Error");
            }
        });
    });
</script>