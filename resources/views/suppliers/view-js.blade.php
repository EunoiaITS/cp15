<script>
        $('.btn-view-table').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#user_id').val(id);
            $('#delete_user_id').val(id);
            $('#supplier-name').val($('#name'+id).text());
            $('#sup-email').val($('#email'+id).text());
            $('#sup-category').val($('#category'+id).text());
            $('#sup-contact').val($('#contact'+id).text());
        });
        $('.selectfilter').on('change',function (e) {
            e.preventDefault();
            var sf = $(this).val();
            if(sf === 'descending'){
                var url = '?order=desc';
                window.location.replace(url);
            }else{
                var url = '?order=asc';
                window.location.replace(url);
            }
        });
</script>