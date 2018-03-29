<script>
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