<script src="<?php echo base_url()?>assets/js/choosen/chosen.jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('.chosen-select', this).chosen({width: "30%"});    
	$("#id_kecamatan").change(function() {
	   $('.loading').show();
	   $.ajax({
	      type: "POST",
	      url: '<?php echo base_url()?>dashboard/status_kantor',
	      data: { id_kecamatan: $("#id_kecamatan").val(), filter:'1'}, 
	      error : function(xhr, ajaxOptions, thrownError){
	          console.log(xhr.status);
	          console.log(xhr.responseText);
	          console.log(thrownError);
	      },
	      success : function(data){
	           $('#status_kop').html(data);
	           $('.loading').hide();
	      }
	  });
	})

	$("#id_kecamatan_jenis").change(function() {
	   $('.loading').show();
	   $.ajax({
	      type: "POST",
	      url: '<?php echo base_url()?>dashboard/jenis_koperasi',
	      data: { id_kecamatan_jenis: $("#id_kecamatan_jenis").val(), filter:'1'}, 
	      error : function(xhr, ajaxOptions, thrownError){
	          console.log(xhr.status);
	          console.log(xhr.responseText);
	          console.log(thrownError);
	      },
	      success : function(data){
	           $('#jenis_kop').html(data);
	           $('.loading').hide();
	      }
	  });
	})


	$("#id_kecamatan_jml_ang").change(function() {
	   $('.loading').show();
	   $.ajax({
	      type: "POST",
	      url: '<?php echo base_url()?>dashboard/jumlah_anggota',
	      data: { id_kecamatan_jml_ang: $("#id_kecamatan_jml_ang").val(), filter:'1'}, 
	      error : function(xhr, ajaxOptions, thrownError){
	          console.log(xhr.status);
	          console.log(xhr.responseText);
	          console.log(thrownError);
	      },
	      success : function(data){
	           $('#chart_jml_ang').html(data);
	           $('.loading').hide();
	      }
	  });
	})

	$("#id_kecamatan_shu").change(function() {
	   $('.loading').show();
	   $.ajax({
	      type: "POST",
	      url: '<?php echo base_url()?>dashboard/shu',
	      data: { id_kecamatan: $("#id_kecamatan_shu").val(), filter:'1'}, 
	      error : function(xhr, ajaxOptions, thrownError){
	          console.log(xhr.status);
	          console.log(xhr.responseText);
	          console.log(thrownError);
	      },
	      success : function(data){
	           $('#shu_kop').html(data);
	           $('.loading').hide();
	      }
	  });
	})

	$("#id_kecamatan_omset").change(function() {
	   $('.loading').show();
	   $.ajax({
	      type: "POST",
	      url: '<?php echo base_url()?>dashboard/omset',
	      data: { id_kecamatan: $("#id_kecamatan_omset").val(), filter:'1'}, 
	      error : function(xhr, ajaxOptions, thrownError){
	          console.log(xhr.status);
	          console.log(xhr.responseText);
	          console.log(thrownError);
	      },
	      success : function(data){
	           $('#omset_kop').html(data);
	           $('.loading').hide();
	      }
	  });
	})

});


</script>
<style>
.chart-container {
  position: relative;
  margin: auto;
  height: 80vh;
  width: 80vw;
}
</style>

<?php if($this->uri->segment(1)=='home'){?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Dashboard</h2>
        <ol class="breadcrumb">
                Home /<li>Dashboard</li>                    
        </ol>
    </div>
</div>            
<?php } ?>

								<div class="row">
									<div class="space-6"></div>

									<div class="col-sm-7 infobox-container">
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-male"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($anggota_by_gender[0]['jmlpria'])?></span>
												<div class="infobox-content">Anggota Pria</div>
											</div>

											<!-- <div class="stat stat-success">8%</div> -->
										</div>

										<div class="infobox infobox-blue">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-male"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($manajer_by_gender[0]['jmlpria'])?></span>
												<div class="infobox-content">Manajer Pria</div>
											</div>

											<!-- <div class="badge badge-success">
												+32%
												<i class="ace-icon fa fa-arrow-up"></i>
											</div> -->
										</div>

										<div class="infobox infobox-pink">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-male"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($karyawan_by_gender[0]['jmlpria'])?></span>
												<div class="infobox-content">Karyawan Pria</div>
											</div>
											<!-- <div class="stat stat-important">4%</div> -->
										</div>

										<div class="infobox infobox-red">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-female"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($anggota_by_gender[0]['jmlwanita'])?></span>
												<div class="infobox-content">Anggota Wanita</div>
											</div>
										</div>

										<div class="infobox infobox-orange">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-female"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($manajer_by_gender[0]['jmlwanita'])?></span>
												<div class="infobox-content">Manajer Wanita</div>
											</div>

											<!-- <div class="badge badge-success">
												7.2%
												<i class="ace-icon fa fa-arrow-up"></i>
											</div> -->
										</div>

										<div class="infobox infobox-blue2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-female"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($karyawan_by_gender[0]['jmlwanita'])?></span>
												<div class="infobox-content">Karyawan Wanita</div>
											</div>
										</div>

										<div class="space-14"></div>

										<div class="col-sm-10">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-signal"></i>
													 Koperasi Berdasar Jenis
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

												
											<div class="widget-body">
												<div class="widget-main padding-4">
											      <div class="form-group" data-validate="role">
											           <label for="email">Pilih Kecamatan: </label>
											           <br/>
											            <?php  echo $dt_cbo_kec_jenis ?>
											      </div>
													<div id="jenis_kop" style="width:100%">
														<?php echo $chart_jenis_koperasi ?>
													</div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
									</div>



									<div class="vspace-12-sm"></div>

									<div class="col-sm-5">
										<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fa fa-signal"></i>
													Koperasi Berdasar Status
												</h5>

												<div  class="widget-toolbar no-border">
													<div class="inline">
														<!-- <button id="btn_view" onclick="toggle_view()" class="btn btn-minier btn-primary btn-xs">
															<?php echo $state ?>
															
														</button> -->
													</div>
												</div>

												<script>
													function toggle_view(){
														if($("#btn_view").text()=='View Chart'){
															view_chart()
														}else{
															view_data()
														}

													}
													function view_data(){
														url_page = "<?php echo base_url()?>dashboard/view_data";
														load_content(url_page, 'piechart-placeholder');
														$("#btn_view").text('View Chart');

													}

													function view_chart(){
														url_page = "<?php echo base_url()?>dashboard/view_chart";
														load_content(url_page, 'piechart-placeholder');
														 $("#btn_view").text('View Data');

													}	

												</script>

											</div>

											<div class="widget-body">
												<div class="widget-main">
											      <div class="form-group" data-validate="role">
											           <label for="email">Pilih Kecamatan: </label>
											           <br/>
											            <?php echo $dt_cbo_kec ?>
											      </div>													
													<div id="status_kop">
														<?php echo $chart_status_kop ?>
													</div>

													
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->

								 <div class="hr hr32 hr-dotted"></div> 

								<div class="row">
									<div class="col-sm-6">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-signal"></i>
													SHU Koperasi berdasar Kecamatan
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-4">
											      <div class="form-group" data-validate="role">
											           <label for="email">Pilih Kecamatan: </label>
											           <br/>
											            <?php echo $dt_cbo_kec_shu ?>
											      </div>													
													<div id="shu_kop" style="width:100%; height: 100%">
														<?php  echo $chart_shu ?>
													</div>
												</div> <!-- /.widget-main-->
											</div><!-- /.widget-body -->
										 </div> <!-- /.widget-box -->
									</div> <!-- /.col-->

									<div class="col-sm-6">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-signal"></i>
													Koperasi berdasarkan Jumlah Omset
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-4">
											      <div class="form-group" data-validate="role">
											           <label for="email">Pilih Kecamatan: </label>
											           <br/>
											            <?php echo $dt_cbo_kec_omset ?>
											      </div>													
													<div id="omset_kop" style="width:100%; height: 100%">
														<?php  echo $chart_omset ?>
													</div>
												</div> <!-- /.widget-main-->
											</div><!-- /.widget-body -->
										 </div> <!-- /.widget-box -->
									</div> <!-- /.col-->
								</div> <!-- /.row -->

								
								<!-- <div class="hr hr32 hr-dotted"></div> -->

								



<script src="<?php echo base_url()?>assets/Chartjs/Chart.js"></script>
<script src="<?php echo base_url()?>assets/Chartjs/driver.js"></script>

<script>
    (function () {
        loadChartJsPhp();
    })();
</script>
							