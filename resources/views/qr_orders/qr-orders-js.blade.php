<script>
    $(document).ready(function(){
        var count = 1;
        $('#add-item-create').on('click', function(e){
            e.preventDefault();
            count++;
            var html_create ='<tr id="add-item-'+count+'">'+
                    '<td>'+count+'</td>'+
                    '<td><input type="text" name="item_name'+count+'" class="form-control from-qr" id="pr-item-name" required></td>'+
                    '<td><input type="text" name="item_no'+count+'" class="form-control from-qr" id="pr-item-code" required></td>'+
                    '<td><input type="text" name="quantity'+count+'" class="form-control from-qr" id="pr-quantity" required></td>'+
                    '<td>' +
                    '<div class="file btn btn-sm btn-primary btn-supplier">' +
                    '<div class="upload-icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div><span>Upload</span>' +
                    '<input type="file" name="item_file'+count+'" class="input-upload" id="file1" onchange="uploadFile()">' +
                    '</div>' +
                    '</td>'+
                    '<td><button type="button" rel="'+count+'" class="btn btn-primary delete-item"><i class="fa fa-times"></i></button></td>'+
                    '<input type="hidden" name="count" value="'+count+'">'+
                    '<tr>';
            $('#add-item-table-item').append(html_create);
            $('.delete-item').on('click', function(e){
                e.preventDefault();
                var row = $(this).attr('rel');
                $('#add-item-'+row).remove();
            });
        });
    });
</script>