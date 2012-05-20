<?php if(!$isAjax) : ?>
    <?php $this->load->view('headerTemplate');?>
<?php endif; ?>

<?php $this->load->view('menuTemplate');?>

<div class="container-fluid" id="statistics">
  <div class="row-fluid">
    <div class="span4">
       <?php $this->load->view('sidebarTemplate');?> 
    </div>
    <div class="span8">
      
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    
    <?php foreach ($championships as $championship) : ?>
     <?php if(count($championship['result']) > 3) : ?>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($championship['result'])?>);
        var options = {
          title: "<?php echo $championship['name'] ?>"
        };
        
        var dataCumul = google.visualization.arrayToDataTable(<?php echo json_encode($championship['cumul'])?>);
        var optionsCumul = {
          title: "<?php echo $championship['name'] ?> Cumul"
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_<?php echo $championship['id'];?>'));
        chart.draw(data, options);
        
        var chartCumul = new google.visualization.LineChart(document.getElementById('cumul_<?php echo $championship['id'];?>'));
        chartCumul.draw(dataCumul, optionsCumul);
        
      }
    </script>
    
    <div id="chart_<?php echo $championship['id'];?>" style="width: 800px; height: 500px;"></div>
    <div id="cumul_<?php echo $championship['id'];?>" style="width: 800px; height: 500px;"></div>
    <?php endif; ?>
    <?php endforeach; ?> 
      
    </div>
  </div>
</div>

<?php if(!$isAjax) : ?>
    <?php $this->load->view('footerTemplate');?>
<?php endif; ?>