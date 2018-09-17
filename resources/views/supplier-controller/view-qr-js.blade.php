<script>
    $(document).ready(function(){
        var count = 0;
        $('.add-item-create').on('click', function(e){
            var rel = $(this).attr('rel');
            //alert(rel);
            e.preventDefault();
            count++;
            var html_create ='<tr>' +
                '<td><input type="text" name="origin'+count+'" class="form-control from-btn-supplier from-qr"></td><input type="hidden" name="item_id'+count+'" value="'+rel+'">' +
                '<td><input type="text" name="genuine'+count+'" class="form-control from-btn-supplier from-qr"></td>' +
                '<td><input type="text" name="oem'+count+'" class="form-control from-btn-supplier from-qr"></td>' +
                '<td><input type="text" name="brand'+count+'" class="form-control from-btn-supplier from-qr"></td>' +
                '<td><input type="text" name="delivery_date'+count+'" class="form-control from-qr from-supplier datepicker-f"></td>' +
                '<td><input type="text" name="unit_price'+count+'" class="form-control from-btn-supplier from-qr unit-price" required></td>' +
                '<td><input type="text" name="comment'+count+'" class="form-control from-qr from-supplier"></td>' +
                '<td>' +
                '<div class="file btn btn-sm btn-primary btn-supplier">' +
                '<div class="upload-icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div><span>Upload</span>' +
                '<input type="file" name="attachment'+count+'" class="input-upload">' +
                '</div>' +
                '</td>' +
                '</tr>';
            $('#add-item-table-item'+rel).append(html_create);
            $('#total').val(count);
            $(document).on("focus", ".datepicker-f", function(){
                $('.datepicker-f').datetimepicker({
                    format: "DD-MM-YYYY",
                    icons: {
                        up: 'fa fa-angle-up',
                        down: 'fa fa-angle-down',
                        previous: 'fa fa-angle-left',
                        next: 'fa fa-angle-right',
                    }
                });
            });
        });
    });
</script>