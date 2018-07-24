<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Data Koperasi</h2>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Basic Data Tables example with responsive plugin</h5>
						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>
						</div>
					</div>
					<div class="ibox-content">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example" >
								<thead>
								<tr>
									<th>IDKOP/NIK</th>
									<th>Koperasi</th>
									<th>No Badan Hukum</th>
									<th>Tanggal Badan Hukum</th>
									<th>Kecamatan</th>
									<th>Kelurahan</th>
									<th>Status</th>
									<th>Jenis Koperasi</th>
								</tr>
								</thead>
								<tbody>
								<tr class="gradeX">
									<td>3276010020001</td>
									<td>Koperasi Yadairs Yayasan Darul Irfan</td>
									<td>41/BH/KUKM/1.2/X/2004</td>
									<td>01/10/2004</td>
									<td>Sawangan</td>
									<td>Sawangan</td>
									<td>Aktif</td>
									<td>Konsumen</td>
								</tr>
								<tr class="gradeX">
									<td>3276010020002</td>
									<td>Koperasi Azaria Sekolah</td>
									<td>903/36/BH/KPTS/XIII.25/DKUP/X/2011</td>
									<td>03/10/2011</td>
									<td>Sawangan</td>
									<td>Sawangan</td>
									<td>Aktif</td>
									<td>Konsumen</td>
								</tr>
								<tr class="gradeX">
									<td>3276010020001</td>
									<td>Koperasi Yadairs Yayasan Darul Irfan</td>
									<td>41/BH/KUKM/1.2/X/2004</td>
									<td>01/10/2004</td>
									<td>Sawangan</td>
									<td>Sawangan</td>
									<td>Aktif</td>
									<td>Konsumen</td>
								</tr>
								<tr class="gradeX">
									<td>3276010020001</td>
									<td>Koperasi Yadairs Yayasan Darul Irfan</td>
									<td>41/BH/KUKM/1.2/X/2004</td>
									<td>01/10/2004</td>
									<td>Sawangan</td>
									<td>Sawangan</td>
									<td>Aktif</td>
									<td>Konsumen</td>
								</tr>
								<tr class="gradeX">
									<td>3276010020001</td>
									<td>Koperasi Yadairs Yayasan Darul Irfan</td>
									<td>41/BH/KUKM/1.2/X/2004</td>
									<td>01/10/2004</td>
									<td>Sawangan</td>
									<td>Sawangan</td>
									<td>Aktif</td>
									<td>Konsumen</td>
								</tr>
								</tbody>
								<tfoot>
								<tr>
									<th>IDKOP/NIK</th>
									<th>Koperasi</th>
									<th>No Badan Hukum</th>
									<th>Tanggal Badan Hukum</th>
									<th>Kecamatan</th>
									<th>Kelurahan</th>
									<th>Status</th>
									<th>Jenis Koperasi</th>
								</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footer">
    <div class="pull-right">
        10GB of <strong>250GB</strong> Free.
    </div>
    <div>
        <strong>Copyright</strong> Example Company &copy; 2014-2017
    </div>
</div>

</div>
</div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url()?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?php echo base_url()?>assets/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url()?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url()?>assets/js/plugins/pace/pace.min.js"></script>
<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
						}
                    }
                ]

            });

        });

    </script>

</body>
</html>