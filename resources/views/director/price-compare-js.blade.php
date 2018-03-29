<script>

    // pie chart
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 50);
    };
    // Code snippet for selected same items

    $('.select-multiple').on('change',function (ev) {
        ev.preventDefault();
        var itemCode = $(this).attr('id');
        if(!$(this).is(':checked')){
            $('#'+itemCode).prop('checked', false);
        }else{
            $('#'+itemCode).prop('checked', true);
        }
    });
    var detectPr = '';
    $('.pr-modal').on('click',function (e) {
        e.preventDefault();
        detectPr = $(this).attr('rel');
    });
    $('.price-compare').on('click', function(e) {
        e.preventDefault();
        var item_names = [];
        var uniqueNames = [];
        var item_details = [];
        var quot_id = '';
        var selectClass = 'select-items'+detectPr;
        $("input:checkbox[class="+selectClass+"]:checked").each(function(){
            quot_id = $(this).attr('rel');
            item_names.push($('#item-name-'+quot_id).text());
            item_details.push({
                name: $('#item-name-'+quot_id).text(),
                price: $('#unit-price-'+quot_id).text(),
                supplier: $('#supplier-name-'+quot_id).text()
            });
        });
        $.each(item_names, function(i, el){
            if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
        });
        var html_chart = '';
        for(var i = 0; i < uniqueNames.length; i++){
            html_chart += '<div id="canvas-holder">'+
            '<p class="text-center">'+uniqueNames[i]+'</p>'+
            '<canvas id="chart-area'+i+'"/>'+
            '</div>';
        }
        $('#item-chart').html(html_chart);
        for(var i = 0; i < uniqueNames.length; i++){
            var item_prices = [];
            var item_supps = [];
            for(var j = 0; j < item_details.length; j++){
                if(item_details[j].name == uniqueNames[i]){
                    item_prices.push(item_details[j].price);
                    item_supps.push(item_details[j].supplier);
                }
            }
            var config = {
                type: 'bar',
                data: {
                    labels: item_supps,
                    datasets: [{
                        label: 'Unit Price',
                        data: item_prices,
                        backgroundColor: [
                            '#365A86',
                            '#666',
                            '#4876AD'
                        ],
                        borderWidth: [1,1,1],
                        borderColor: ['#1031a5','#1031a5','#1031a5']
                    }],
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                }
            };
            var ctx = document.getElementById("chart-area"+i).getContext("2d");
            window.myPie = new Chart(ctx, config);
        }
    });
</script>