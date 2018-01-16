<script>
    $(document).ready(function(){
        $('.btn-view-table').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#user_id').val(id);
            $('#supplier-name').val($('#name'+id).text());
            $('#pr-email').val($('#email'+id).text());
            var val = $('#role'+id).text();
            $("#catagory-catagory option[value="+val+"]").prop("selected", true);
        });
    });
</script>