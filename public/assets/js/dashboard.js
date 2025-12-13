$(function () {
   $.ajax({
        type: 'GET',
        url: site_url+'/dashboard/monthlypayment',
        success: function(response){
           // getMorris('line', 'line_chart',response.payment_chart);
           new Chart(document.getElementById("line_chart").getContext("2d"), getChartJs('line',response.payment_chart));    
        }
    });    
    

    
   
});
function getChartJs(type,record) {
   
    var config = null;

    if (type === 'line') {
        config = {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug" ,"Sep", "Oct", "Nov" , "Dec"],
                datasets: [{
                    label: "Amount",
                    fill: false,
                    data: record,
                    borderColor: 'rgba(0, 188, 212, 0.75)',
                    
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                    pointBorderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: false
            }
        }
    }
    return config;
}
/*function getMorris(type, element, record) {
    console.log(record);
    if (type === 'line') {
        
        Morris.Line({
            element: element,
            data: JSON.parse(record),
            xkey: 'period',
            ykeys: ['amount'],
            labels: ['Amount'],
            lineColors: ['rgb(233, 30, 99)'],
            lineWidth: 3,
            //xLabels:'month',
           
            xLabelFormat: function (m) {
                var months = new Array(12);
                months[0] = "Jan";
                months[1] = "Feb";
                months[2] = "Mar";
                months[3] = "Apr";
                months[4] = "May";
                months[5] = "Jun";
                months[6] = "Jul";
                months[7] = "Aug";
                months[8] = "Sep";
                months[9] = "Oct";
                months[10] = "Nov";
                months[11] = "Dec";
                return months[m.getMonth()];
               },
        });
    }
}*/