<script>
    $(document).ready(function(){
        $('.btn-view-table').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#user_id').val(id);
            $('#delete_user_id').val(id);
            $('#suppliers-name').val($('#name'+id).text());
            $('#sup-email').val($('#email'+id).text());
            $('#sup-categoty').val($('#category'+id).text());
            $("#sup-catagory option[value="+val+"]").prop("selected", true);
        });
    });
</script>