<script>
    $('{{ $selector }}').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        swal({
            title: `{{ $title }}?`,
            text: "{{ $text }}!",
            icon: "success",
            timer: 3000,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>
