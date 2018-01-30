<script>
    // pie chart
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 50);
    };

    var config = {
        type: 'bar',
        data: {
            labels: ["Supplier-1", "Supplier-2", "Supplier-3"],
            datasets: [{
                data: [300, 600, 900],
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

    var item_names = [];
    var uniqueNames = [];
    var quot_id = '';
    $('#price-compare').on('click', function(e) {
        e.preventDefault();
        $("input:checkbox[class=select-items]:checked").each(function(){
            quot_id = $(this).attr('rel');
            item_names.push($('#item-name-'+quot_id).text());
        });
        $.each(item_names, function(i, el){
            if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
        });
        alert(uniqueNames);
        var html_chart = '';
        for(i = 0; i < uniqueNames.length; i++){
            alert(uniqueNames[i]);
            html_chart += '<div id="canvas-holder">'+
            '<p class="text-center">'+uniqueNames[i]+'</p>'+
            '<canvas id="chart-area'+i+'"/>'+
            '</div>';
        }
        $('#item-chart').html(html_chart);
        for(i = 0; i < uniqueNames.length; i++){
            var ctx = document.getElementById("chart-area"+i).getContext("2d");
            window.myPie = new Chart(ctx, config);
        }
    });
</script>