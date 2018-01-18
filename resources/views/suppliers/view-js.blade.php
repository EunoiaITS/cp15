<script>
    $(document).ready(function(){
        $('.btn-view-table').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#user_id').val(id);
            $('#delete_user_id').val(id);
            $('#supplier-name').val($('#name'+id).text());
            $('#sup-email').val($('#email'+id).text());
            $('#sup-catagory').val($('#category'+id).text());
            $('#sup-contact').val($('#contact'+id).text());
            $('#sup-category').val($('#category'+id).text());
        });
    });
</script>