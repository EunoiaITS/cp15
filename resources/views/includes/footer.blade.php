<div class="container">
    <div class="row">
        <div class="bbc-footer">
           <p class="text-center">Website developed by <a href="https://www.vemax.com.my/">VEMAX TECHNOLOGY SDN BHD</a>
        </div>
    </div>
</div>
</div>

<!-- js file -->
<script src="{{ URL::asset('public/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{ URL::asset('public/assets/js/vendor/jquery-3.2.1.min.js') }}"><\/script>')</script>
<script src="{{ URL::asset('public/assets/js/plugins.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/moment.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/Chart.bundle.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/bootstrap-select.js') }}"></script>
<!-- jquery-ui.min.js file -->
<script src="{{ URL::asset('public/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('public/assets/js/main.js') }}"></script>
<!-- bootstrap select callback -->
<script>
    $( document ).ready(function() {
        $('.selectfilter').selectpicker({});
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
