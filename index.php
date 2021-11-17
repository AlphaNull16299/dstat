<script src="https://code.highcharts.com/highcharts.js"></script>
<div id="container" style="width: 100%; height: 100%; margin: 0 auto"></div>
<script>
divid = "container";
window.previous = 0;
window.hajime = 'true';
            Highcharts.createElement('link', {
//                href: '//fonts.googleapis.com/css?family=Unica+One',
                rel: 'stylesheet',
                type: 'text/css'
            }, null, document.getElementsByTagName('head')[0]);

            var options = {
				plotOptions: {
					series: {
						events: {
							legendItemClick: function(event) {
								event.preventDefault();
							}
						}
					}
				},
                chart: {
                    zoomType: '',
                    renderTo: divid,
                    style: {
                        fontFamily: "'Unica One', sans-serif"
                    },
                    //plotBorderColor: '#606063'
                },
				title:{
				  text: "https://dstat.null2019.repl.co/hit.php"
				  },
				xAxis: {
                    type: 'datetime',
                    dateTimeLabelFormats: {
                        day: '%a'
                    }
                },
				yAxis: {
					title: {
						text: 'リクエスト(秒)',
						margin: 80
					}
				},
				credits: {
					enabled: false
				},
                series: [{
                    type: 'area',
					//shadowSize: 0,
                    name: '合計リクエスト',
					color: '#ffa500',
                    data: []
                }]
            };
            mychart = new Highcharts.Chart(options);
function update(){
ajax = new XMLHttpRequest();
ajax.onload = function(e){
part = ajax.responseText;
var series = mychart.series[0];
console.log(part-window.previous);
if (window.hajime != 'true' && part-window.previous > 0){series.addPoint([Math.floor(Date.now()),part-window.previous],true,series.data.length > 40);}
window.hajime = 'false';
window.previous = part;
//setTimeout('update();',1000);
}
ajax.onerror = function(e){
update();
}
ajax.ontimeout = function(e){
update();
}
ajax.open("GET","get.php");
ajax.send();
}
setInterval('update()',1000);
</script>
<?php
$counter_file = 'counter.txt';
$counter_lenght = 8;
$fp = fopen($counter_file, 'r+');
if ($fp){
    if (flock($fp, LOCK_EX)){
        $counter = fgets($fp, $counter_lenght);
        $counter++;
        rewind($fp);
        if (fwrite($fp,  $counter) === FALSE){
        }
        flock($fp, LOCK_UN);
    }
}
fclose($fp);
?>
