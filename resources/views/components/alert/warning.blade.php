<script>
    $('{{ $selector }}').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        swal({
            title: `{{ $title }}?`,
            text: "{{ $text }}!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
