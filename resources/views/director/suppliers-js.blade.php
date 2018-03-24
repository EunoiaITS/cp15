<script>
    $(document).ready(function () {
        $('.p-desc').hide();
        var html = '@foreach($asc_result as $res)'+
            '<tr>'+
            '<td id="name{{$res->id}}">{{$res->name}}</td>'+
            '<td id="category{{$res->id}}">@foreach($res->info as $in){{ $in->category }}@endforeach</td>'+
            '<td id="email{{$res->id}}">{{$res->email}}</td>'+
            '<td id="contact{{$res->id}}">@foreach($res->info as $in){{ $in->contact }}@endforeach</td>'+
            '</tr>'+
            '@endforeach';
        $('#filtered-data').html(html);
    });
    $('.selectfilter').on('change',function (e) {
        e.preventDefault();
        var sf = $(this).val();
        if(sf == 'ascending'){
            var html = '@foreach($asc_result as $res)'+
                '<tr>'+
                '<td id="name{{$res->id}}">{{$res->name}}</td>'+
                '<td id="category{{$res->id}}">@foreach($res->info as $in){{ $in->category }}@endforeach</td>'+
                '<td id="email{{$res->id}}">{{$res->email}}</td>'+
                '<td id="contact{{$res->id}}">@foreach($res->info as $in){{ $in->contact }}@endforeach</td>'+
                '</tr>'+
                '@endforeach';
            $('#filtered-data').html(html);
            $('.p-desc').hide();
            $('.asc').attr('selected','selected');
        }else if(sf == 'descending'){
            var html = '@foreach($desc_result as $res)'+
                '<tr>'+
                '<td id="name{{$res->id}}">{{$res->name}}</td>'+
                '<td id="category{{$res->id}}">@foreach($res->info as $in){{ $in->category }}@endforeach</td>'+
                '<td id="email{{$res->id}}">{{$res->email}}</td>'+
                '<td id="contact{{$res->id}}">@foreach($res->info as $in){{ $in->contact }}@endforeach</td>'+
                '</tr>'+
                '@endforeach';
            $('#filtered-data').html(html);
            $('.desc').attr('selected','selected');
            $('.p-asc').hide();
            $('.p-desc').show();
        }
    });
</script>