<style>
.chart-container {
  position: relative;
  margin: auto;
  height: 80vh;
  width: 80vw;
}
</style>


<?php
  require APPPATH . '/libraries/ChartJS.php';
    $lblarray= array();
    $dtarray = array();
    foreach($report as $result){
     // $r = array_values($res);
        $nama_keterangan2[0] = $result->nama_keterangan2; //
        $lblarray[] = $result->tahun; //
        $dtarray[] = (float) $result->nilai; //ambil nilai
    }

$data = $dtarray ;// array(28, 48, 40, 19, 86, 27, 90);
$labels = $lblarray;//  array("January", "February", "March", "April", "May", "June", "July");
$colors = array(
              array('backgroundColor' => 'rgba(99,255,132,0.2)', 'borderColor' => '#ad0314'),
              array('backgroundColor' => '#4286f4', 'borderColor' => '#4286f4'),
              array('backgroundColor' => array('blue', 'purple', 'red', 'black', 'brown', 'pink', 'green'))
          );

$options = array(
    'responsive' => false,
    'scales' => array(
        'yAxes' => array(
            array(
                'scaleLabel' => array(
                    'display' => true,
                    'labelString' => $chart_info_y,
                    'fontSize' =>12,
                    'fontStyle'=>'bold'
                )
            )
        )
    ),
    'legend' => array (
        'position' => 'bottom',
        'labels' => array (
            'fontSize' => 12
        )
    )
);

$title = array('labelString' => 'Judul');


//html attributes fot the canvas element
$attributes = array('id' => 'example', 'width' => 500, 'height' => 400, 'style' => 'display:inline; padding-left:5px');

$datasets = array(
                array('data' => $data, 'label' =>$chart_info_x) + $colors[1],
                //array('data' => $data[1], 'label' => "Legend2") + $colors[1],
                //array('data' => $data[0], 'label' => "Legend1") + $colors[2],
                //array('data' => $data[1], 'label' => "Legend2") + $colors[2],
               // array('data' => $data[0]) + $colors[2],
            );



/*
 * Create charts
 *
 */
$ctype = strtolower($ctype); 
if(empty($ctype)){
  $ctype = 'line';
}

$attributes['id'] = 'example_line';
$Line = new ChartJS($ctype, $labels, $options, $attributes, $title);
$Line->addDataset($datasets[0]);
//$Line->addDataset($datasets[0]);

/*$attributes['id'] = 'example_bar';
$Bar = new ChartJS('bar', $labels, $options, $attributes);
$Bar->addDataset($datasets[2]);
//$Bar->addDataset($datasets[3]);

$attributes['id'] = 'example_radar';
$Radar = new ChartJS('radar', $labels, $options, $attributes);
$Radar->addDataset($datasets[0]);
$Radar->addDataset($datasets[1]);

$attributes['id'] = 'example_polarArea';
$PolarArea = new ChartJS('polarArea', $labels, $options, $attributes);
$PolarArea->addDataset($datasets[4]);

$attributes['id'] = 'example_pie';
$Pie = new ChartJS('pie', $labels, $options, $attributes);
$Pie->addDataset($datasets[4]);

$attributes['id'] = 'example_doughnut';
$Doughnut = new ChartJS('doughnut', $labels, $options, $attributes);
$Doughnut->addDataset($datasets[4]);*/


/*
 * Print charts
 *
 */

?><!DOCTYPE html>
<html>
<head>
    <title>Chart.js-PHP</title>
</head>
<body>
<?php
echo $Line;
?><!-- 
<h1>Bar</h1>
<?php
//echo $Bar;
?>
<h1>Radar</h1>
<?php
//echo $Radar;
?>
<h1>Polar Area</h1>
<?php
//echo $PolarArea;
?>
<h1>Pie & Doughnut</h1>
<?php
//echo $Pie. $Doughnut;
?> -->

<script src="<?php echo base_url()?>assets/Chartjs/Chart.js"></script>
<script src="<?php echo base_url()?>assets/Chartjs/driver.js"></script>



<script>
    (function () {
        loadChartJsPhp();
    })();
</script>
</body>
</html>
