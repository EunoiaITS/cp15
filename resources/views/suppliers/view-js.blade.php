<script>
        $('.btn-view-table').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#user_id').val(id);
            $('#delete_user_id').val(id);
            $('#supplier-name').val($('#name'+id).text());
            $('#sup-email').val($('#email'+id).text());
            var cat = $('#category'+id).attr('rel');
            $('#sup-category option').each(function (){
                $(this).attr('selected',false);
                if(cat === this.value){
                    //$('#sup-category').val(cat);
                    $(this).attr('selected');
                    //alert('true');
                }
            });
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