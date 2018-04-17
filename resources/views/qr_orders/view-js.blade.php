<script>
    $(document).ready(function(){
        var count = 1;
        var addCount = 0;
        $('#add-item-create').on('click', function(e){
            e.preventDefault();
            count++;
            addCount++;
            var html_create ='<tr id="row-add'+addCount+'">'+
                    '<td>'+count+'</td>'+
                    '<td><input type="text" name="add_item_name'+addCount+'" class="form-control from-qr" id="pr-item-name"></td>'+
                    '<td><input type="text" name="add_item_no'+addCount+'" class="form-control from-qr" id="pr-item-code"></td>'+
                    '<td><input type="text" name="add_quantity'+addCount+'" class="form-control from-qr" id="pr-quantity"></td>'+
                    '<td><button type="button" rel="'+addCount+'" class="btn btn-primary item-delete-add"><i class="fa fa-times"></i></button></td>'+
                    '<input type="hidden" name="addCount" value="'+addCount+'">'+
                    '<tr>';
            $('#add-item-table-edit').append(html_create);
            $('.item-delete-add').on('click', function(e){
                e.preventDefault();
                var row = $(this).attr('rel');
                $('#row-add'+row).remove();
            });
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
                html_data += '<tr class="" id="row'+item_id+'">'+
                '<td>'+i+'</td>'+
                '<td><input name="item_name'+i+'" type="text" class="form-control from-qr" id="pr-item-name-edit" value="'+item_name+'"></td>'+
                '<td><input name="item_no'+i+'" type="text" class="form-control from-qr" id="pr-item-code-edit" value="'+item_no+'"></td>'+
                '<td><input name="quantity'+i+'" type="text" class="form-control from-qr" id="pr-quantity-edit" value="'+quantity+'"></td>'+
                '<td><button type="button" rel="'+item_id+'" class="btn btn-primary item-delete"><i id="btn-delete-'+item_id+'" class="fa fa-times"></i></button></td>'+
                '<input type="hidden" name="editCount" value="'+i+'">'+
                '<input type="hidden" name="edit_id'+i+'" value="'+item_id+'">'+
                '</tr>';
            }
            $('#add-item-table-edit').html(html_data);
            $('.item-delete').on('click', function(e){
                e.preventDefault();
                var id_item = $(this).attr('rel');
                var del_checker = $("#row"+id_item).attr('class');
                if(del_checker != "bg-danger"){
                    $("#row"+id_item).attr('class', 'bg-danger');
                    $("#row"+id_item+" input").prop('readonly', true);
                    $("#btn-delete-"+id_item).attr('class', 'fa fa-undo');
                    $('#deleted-items').append('<input type="hidden" id="delete_item_no'+id_item+'" name="delete_item_no'+id_item+'" value="'+id_item+'">');
                }else{
                    $("#row"+id_item).attr('class', '');
                    $("#row"+id_item+" input").prop('readonly', false);
                    $("#btn-delete-"+id_item).attr('class', 'fa fa-times');
                    $('#delete_item_no'+id_item).remove();
                }
            });
        });
        $('.delete-qr').on('click', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            $('#delete_id').val(id);
        });
    });
    var cat = 'input.category';
    var data_no = [<?php echo $cat; ?>];
    var options_no = {
        source: data_no,
        minLength: 0
    };
    var targetName = null;
    $(document).on('keydown.autocomplete', cat, function() {
        $(this).autocomplete(options_no);
    });
</script>