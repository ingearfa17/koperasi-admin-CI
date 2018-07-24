<style>
.chart-container {
  position: relative;
  margin: auto;
  height: 80vh;
  width: 80vw;
}
</style>

<?php echo $chart ?>

<script src="<?php echo base_url()?>assets/Chartjs/Chart.js"></script>
<script src="<?php echo base_url()?>assets/Chartjs/driver.js"></script>

<script>
    (function () {
        loadChartJsPhp();
    })();
</script>
							