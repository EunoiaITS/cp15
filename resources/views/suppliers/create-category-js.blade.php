<script>
    $('.edit-button').on('click',function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        if(id == 1){
            $(this).prop('disabled',true);
            $('.e-dis').prop('disabled',true);
        }
        $('#e-cat').val(id);
        $('#e-category').val($('#category'+id).text());
    });
    $('.delete-button').on('click',function (e) {
        e.preventDefault();
        var id = $(this).attr('rel');
        if(id == 1){
            $(this).prop('disabled',true);
            $('.d-dis').prop('disabled',true);
        }
        $('#d-cat').val(id);
    });
</script>