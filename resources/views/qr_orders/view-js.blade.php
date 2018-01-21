<script>
    $(document).ready(function(){
        $('.view-details').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            var itemCount = $('.item-id'+id).length;
            var item_id = $('.item-id'+id).text();
            alert(item_id);
        });
    });
</script>