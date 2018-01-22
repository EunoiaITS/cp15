<script>
    $(document).ready(function(){
        var count = 1;
        var addCount = 0;
        $('#add-item-create').on('click', function(e){
            e.preventDefault();
            count++;
            addCount++;
            var html_create ='<tr>'+
                    '<td>'+count+'</td>'+
                    '<td><input type="text" name="add_item_name'+addCount+'" class="form-control from-qr" id="pr-item-name"></td>'+
                    '<td><input type="text" name="add_item_no'+addCount+'" class="form-control from-qr" id="pr-item-code"></td>'+
                    '<td><input type="text" name="add_quantity'+addCount+'" class="form-control from-qr" id="pr-quantity"></td>'+
                    '<td><button type="button" class="btn btn-info btn-view-table open-popup-delete"><i class="fa fa-times"></i></button></td>'+
                    '<input type="hidden" name="addCount" value="'+addCount+'">'+
                    '<tr>';
            $('#add-item-table-edit').append(html_create);
        });
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
                html_data += '<tr>'+
                '<td>'+i+'</td>'+
                '<td>'+item_name+'</td>'+
                '<td>'+item_no+'</td>'+
                '<td>'+quantity+'</td>'+
                '</tr>';
            }
            $('#add-item-table-view').html(html_data);
        });
        $('.edit-qr').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#edit-qr-id').val(id);
            $('#edit-pr-id').val($('#pr_id'+id).text());
            $('#edit-pr-type').val($('#pr_type'+id).text());
            $('#edit-pr-category').val($('#category'+id).text());
            var itemCount = $('.item-id'+id).length;
            count = itemCount;
            var html_data = '';
            for(i = 1; i <= itemCount; i++){
                var item_id = $('#item'+i+id).text();
                var item_name = $('#item-name'+i+id).text();
                var item_no = $('#item-no'+i+id).text();
                var quantity = $('#quantity'+i+id).text();
                html_data += '<tr>'+
                '<td>'+i+'</td>'+
                '<td><input name="item_name'+i+'" type="text" class="form-control from-qr" id="pr-item-name-edit" value="'+item_name+'"></td>'+
                '<td><input name="item_no'+i+'" type="text" class="form-control from-qr" id="pr-item-code-edit" value="'+item_no+'"></td>'+
                '<td><input name="quantity'+i+'" type="text" class="form-control from-qr" id="pr-quantity-edit" value="'+quantity+'"></td>'+
                '<td><button type="button" class="btn btn-info btn-view-table open-popup-delete"><i class="fa fa-times"></i></button></td>'+
                '<input type="hidden" name="editCount" value="'+i+'">'+
                '<input type="hidden" name="edit_id'+i+'" value="'+item_id+'">'+
                '</tr>';
            }
            $('#add-item-table-edit').html(html_data);
        });
        $('.delete-qr').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#delete_id').val(id);
        });
    });
</script>