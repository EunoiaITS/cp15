<script>
    $(document).ready(function(){
        $('.view-details').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#view-pr-id').text($('#pr_id'+id).text());
            $('#view-pr-type').text($('#pr_type'+id).text());
            $('#view-category').text($('#category'+id).text());
            var itemCount = $('.item-id'+id).length;
            var html_data = '';
            for(i = 1; i <= itemCount; i++){
                var item_id = $('#item'+i+id).text();
                var item_name = $('#item-name'+i+id).text();
                var item_no = $('#item-no'+i+id).text();
                var quantity = $('#quantity'+i+id).text();
                var item_file = $('#item-file'+i+id).text();
                html_data += '<tr>'+
                '<td>'+i+'</td>'+
                '<td>'+item_name+'</td>'+
                '<td>'+item_no+'</td>'+
                '<td>'+quantity+'</td>'+
                '<td><a href="'+item_file+'" target="_blank" download><button class="btn btn-primary btn-supplier input-upload"><i class="fa fa-download"></i></button></a></td>'+
                '</tr>';
            }
            $('#add-item-table-view').html(html_data);
        });
    });
</script>