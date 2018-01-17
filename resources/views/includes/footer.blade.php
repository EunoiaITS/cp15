</div>

<!-- js file -->
<script src="{{ URL::asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{ URL::asset('assets/js/vendor/jquery-3.2.1.min.js') }}"><\/script>')</script>
<script src="{{ URL::asset('assets/js/plugins.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/main.js') }}"></script>
<!--================
add item
========================-->
<script>
    $(document).ready(function(){
        var count = 1;
        $('#add-item-create').on('click', function(e){
            e.preventDefault();
            count++;
            var html_create = '<div class="form-group clearfix">'+
                    '<label for="pr-name" class="label-d">Items Name<span class="fright">:</span></label>'+
                    '<input type="text" name="itemName'+count+'" class="form-control from-qr" id="pr-name'+count+'"></div>'+
                    '<div class="form-group clearfix">'+
                    '<label for="pr-code" class="label-d">Item No<span class="fright">:</span></label>'+
                    '<input type="text" name="itemNo'+count+'" class="form-control from-qr" id="pr-code'+count+'">'+
                    '</div>'+
                    '<div class="form-group clearfix">'+
                    '<label for="pr-quantity" class="label-d">Quantity<span class="fright">:</span></label>'+
                    '<input type="text" name="itemQuantity'+count+'" class="form-control from-qr" id="pr-quantity'+count+'">'+
                    '</div>'+
                    '<input type="hidden" name="count" value="+count+">';
            $('#add-item-table').append(html_create);
        });
    });
</script>

@if(isset($footer_js))
@include($footer_js)
@endif

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
    ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>