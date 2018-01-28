<script>
    $(document).ready(function(){
        var count = 1;
        $('#add-item-create').on('click', function(e){
            e.preventDefault();
            count++;
            var html_create ='<tr>'+
                    '<td>'+count+'</td>'+
                    '<td><input type="text" name="item_name'+count+'" class="form-control from-qr" id="pr-item-name" required></td>'+
                    '<td><input type="text" name="item_no'+count+'" class="form-control from-qr" id="pr-item-code" required></td>'+
                    '<td><input type="text" name="quantity'+count+'" class="form-control from-qr" id="pr-quantity" required></td>'+
                    '<input type="hidden" name="count" value="'+count+'">'+
                    '<tr>';
            $('#add-item-table-item').append(html_create);
        });
    });
</script>