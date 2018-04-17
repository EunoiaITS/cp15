<script>
    $('.edit-button').on('click',function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        $('#e-cat').val(id);
        $('#e-category').val($('#category'+id).text());
    });
    $('.delete-button').on('click',function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        $('#d-cat').val(id);
    });
</script>