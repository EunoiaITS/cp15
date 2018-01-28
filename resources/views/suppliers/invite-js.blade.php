<script>
    $(document).ready(function(){
        var suppliers = '';
        $('.select-suppliers').on('click', function(e){
            e.preventDefault();
            suppliers = '';
            var id = $(this).attr('rel');
            $('.supplier-select').attr('rel', id);
            $('.supplier-select').prop('checked', false);
        });
        $('#confirm-select').on('click', function(e){
            e.preventDefault();
            var qr_id = '';
            $("input:checkbox[class=supplier-select]:checked").each(function(){
                qr_id = $(this).attr('rel');
                suppliers += $(this).val()+',';
            });
            $('#selected-suppliers'+qr_id).val(suppliers);
            suppliers = '';
        });
    });
</script>