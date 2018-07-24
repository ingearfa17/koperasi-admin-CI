<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BootZard - Bootstrap Wizard Template</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/formwizard/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/formwizard/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/formwizard/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/formwizard/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/formwizard/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url()?>assets/formwizard/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url()?>assets/formwizard/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url()?>assets/formwizard/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>assets/formwizard/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

		<!-- Top menu 
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">BootZard - Pencari Kode</a>
				</div>
			</div>
		</nav>-->

        <!-- Top content -->
        <!--<div class="top-content">-->
            <div class="container">
                
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1>Form <strong>Laporan Pokja </strong>Koperasi</h1>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
                    	<form role="form" method="post" class="f1" action="">

                    		<h3>Form Inputan</h3>
                    		<p>SIlahkan isi Form dibawah ini, dengan data yang valid</p>
                    		<a href="<?php echo base_url()?>">Kembali ke Dashboard</a>
                    		<div class="f1-steps">
                    			<div class="f1-progress">
                    			    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66%;"></div>
                    			</div>
                    			<div class="f1-step active">
                    				<div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    				<p>FORM 1</p>
                    			</div>
                    			<div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    				<p>FORM 2</p>
                    			</div>
                    		    <div class="f1-step">
                    				<div class="f1-step-icon"><i class="fa fa-twitter"></i></div>
                    				<p>FORM 3</p>
                    			</div>
                    		</div>
                    		
                    		<fieldset>
                    		    <h4 align="center"><b>Data Koperasi</b></h4>
                    			<div class="form-group">
                    			    <label class="sr-only" for="f1-first-name">Nama Koperasi</label>
                                    <input type="text" name="namakoperasi" placeholder="Nama Koperasi..." class="form-control" id="namakoperasi">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-last-name">No Tanggal Badan Hukum</label>
                                    <input type="text" name="notbh" placeholder="No Tanggal Badan Hukum..." class="form-control" id="nothb">
                                </div>
								<div class="form-group">
                                    <label class="sr-only" for="f1-last-name">No Induk Koperasi</label>
                                    <input type="text" name="nik" placeholder="NO Induk Koperasi..." class="form-control" id="nik">
                                </div>
								<div class="form-group">
									<label class="sr-only" for="f1-about-yourself">Kecamatan</label>
									<select class="form-control" placeholder="Pilih Kecamatan" name="kecamatan" id="kecamatan">
										<option value="">Pilih Kecamatan</option>
                                        <option value="Beji">Beji</option>
                                        <option value="BojongSari">Bojongsari</option>
                                        <option value="Cilodong">Cilodong</option>
                                        <option value="Cimanggis">Cimanggis</option>
                                        <option value="Cinere">Cinere</option>
										<option value="Cipayung">Cipayung</option>
										<option value="Limo">Limo</option>
										<option value="Pancoran Mas">Pancoran Mas</option>
										<option value="Sawangan">Sawangan</option>
										<option value="Sukmajaya">Sukmajaya</option>
										<option value="Tapos">Tapos</option>
                                    </select>
								</div>
								<div class="form-group">
									<label class="sr-only" for="f1-about-yourself">Kelurahan</label>
									<select class="form-control" placeholder="Pilih Kelurahan" name="kelurahan" id="kelurahan">
										<option value="">Pilih Kelurahan</option>
                                        <option value="Beji">Beji</option>
                                        <option value="BojongSari">Beji Timur</option>
                                        <option value="Kemiri Muka">Kemiri Muka</option>
                                        <option value="Pondok Cina">Pondok Cina</option>
                                        <option value="Tanah Baru">Tanah Baru</option>
                                    </select>
								</div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-about-yourself">Alamat Kantor/Sekretariat</label>
                                    <textarea name="alamat" placeholder="Alamat Kantor/Sekretariat..." class="form-control" id="alamat"></textarea>
                                </div>
								<div class="form-group">
                                    <label class="sr-only" for="f1-last-name">No Telp/Fax</label>
                                    <input type="text" name="notelp" placeholder="NO Induk Koperasi..." class="form-control" id="notelp">
                                </div>
								<div class="form-group">
                                    <label class="sr-only" for="f1-last-name">Alamat Website (Optional)</label>
                                    <input type="text" name="website" placeholder="Alamat Website" class="form-control" id="website">
                                </div>
								<div class="form-group">
                                    <label class="sr-only" for="f1-last-name">Email</label>
                                    <input type="text" name="email" placeholder="Alamat Email" class="form-control" id="email">
                                </div>
								<div class="form-group">
                                    <label class="sr-only" for="f1-last-name">NPWP Koperasi</label>
                                    <input type="text" name="npwp" placeholder="NPWP Koperasi" class="form-control" id="npwp">
                                </div>
								<div class="form-group">
                                    <label class="sr-only" for="f1-last-name">Status Kantor/Sekretariat</label>
                                    <input type="text" name="status" placeholder="Status Kantor/Sekretariat" class="form-control" id="status">
                                </div>
								<div class="form-group">
                                    <label class="sr-only" for="f1-last-name">Foto Kantor/Sekretariat</label>
									<h4>Foto Kantor/Sekretariat</h4>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>
								<h4 align="center"><b>Data Kelembagaan</b></h4>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-about-yourself">Keaktifan Koperasi</label>
									<select class="form-control" placeholder="Keaktifan Koperasi" name="keaktifan" id="keaktifan">
										<option value="">Pilih Keaktifan Koperasi</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Rapat Anggota</label>
                                    <select class="form-control" placeholder="Rapat Anggota" name="rat" id="rat">
										<option value="">Pilih Rapat Anggota</option>
                                        <option value="RAT">RAT</option>
                                        <option value="Tidak RAT">Tidak RAT</option>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label class="sr-only">Jumlah Anggota</label>
                                    <input type="text" name="jmlanggota" placeholder="Jumlah Anggota..." class="form-control" id="jmlanggota">
                                </div>
								<div class="form-group">
									<h4 align="center"><b>Pengawas</b></h4>
								</div>
								<h4>Ketua</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_ketua" id="nama_ketua">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="telp_ketua" id="telp_ketua">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="alamat_ketua" id="alamat_ketua">
										</div>
									</div>
								</div>
								<h4>Anggota 1</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_anggota1" id="nama_anggota1">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="telp_anggota1" id="telp_anggota1">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Alamat" name="alamat_anggota1" id="alamat_anggota1">
										</div>
									</div>
								</div>
								<h4>Anggota 2</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_anggota2" id="nama_anggota2">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="telp_anggota2" id="telp_anggota2">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Alamat" name="alamat_anggota2" id="alamat_anggota2">
										</div>
									</div>
								</div>
								<div class="form-group">
									<h4 align="center"><b>Pengurus</b></h4>
								</div>
								<h4>Ketua</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_pengurus_ketua" id="nama_pengurus_ketua">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="notelp_pengurus_ketua" id="notelp_pengurus_ketua">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Alamat" name="alamat_pengurus_ketua" id="alamat_pengurus_ketua">
										</div>
									</div>
								</div>
								<h4>Wakil Ketua</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_pengurus_wakil" id="nama_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="notelp_pengurus_wakil" id="notelp_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Alamat" name="alamat_pengurus_wakil" id="alamat_pengurus_wakil">
										</div>
									</div>
								</div>
								<h4>Sekretaris 1</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_pengurus_wakil" id="nama_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="notelp_pengurus_wakil" id="notelp_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Alamat" name="alamat_pengurus_wakil" id="alamat_pengurus_wakil">
										</div>
									</div>
								</div>
								<h4>Sekretaris 2</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_pengurus_wakil" id="nama_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="notelp_pengurus_wakil" id="notelp_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Alamat" name="alamat_pengurus_wakil" id="alamat_pengurus_wakil">
										</div>
									</div>
								</div>
								<h4>Bendahara 1</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_pengurus_wakil" id="nama_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="notelp_pengurus_wakil" id="notelp_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Alamat" name="alamat_pengurus_wakil" id="alamat_pengurus_wakil">
										</div>
									</div>
								</div>
								<h4>Bendahara 2</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Nama" name="nama_pengurus_wakil" id="nama_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="No Telepon" name="notelp_pengurus_wakil" id="notelp_pengurus_wakil">
										</div>
										<div class="form-group col-md-4">
											<input type="text" class="form-control" placeholder="Alamat" name="alamat_pengurus_wakil" id="alamat_pengurus_wakil">
										</div>
									</div>
								</div>
								<div class="form-group">
									<h4 align="center"><b>Data Usaha dan Keuangan</b></h4>
								</div>
								<h4>Bidang Usaha</h4>
								<div class="form-group">
                                    <label class="sr-only">Bidang Usaha 1</label>
                                    <input type="text" name="bidang_usaha1" placeholder="Bidang Usaha 1..." class="form-control" id="bidang_usaha1">
                                </div>
								<div class="form-group">
                                    <label class="sr-only">Bidang Usaha 2</label>
                                    <input type="text" name="bidang_usaha2" placeholder="Bidang Usaha 2..." class="form-control" id="bidang_usaha2">
                                </div>
								<div class="form-group">
                                    <label class="sr-only">Bidang Usaha 3</label>
                                    <input type="text" name="bidang_usaha3" placeholder="Bidang Usaha 3..." class="form-control" id="bidang_usaha3">
                                </div>
								<h4>Alamat Tempat Usaha</h4>
								<div class="form-group">
									<label class="sr-only">Alamat Tempat Usaha</label>
                                    <input type="text" name="alamat_tempat_usaha" class="form-control" id="alamat_tempat_usaha">
								</div>
								<h4>Status Tempat Usaha</h4>
								<div class="form-group">
									<label class="sr-only">Status Tempat Usaha</label>
                                    <input type="text" name="status_tempat_usaha" class="form-control" id="status_tempat_usaha">
								</div>
								<h4>Omzet/Volume Usaha</h4>
								<div class="form-group">
                                    <label class="sr-only">Omzet/Volume Usaha 1</label>
                                    <input type="text" name="omzet_usaha1" placeholder="Omzet/Volume Usaha 1..." class="form-control" id="omzet_usaha1">
                                </div>
								<div class="form-group">
                                    <label class="sr-only">Omzet/Volume Usaha 2</label>
                                    <input type="text" name="omzet_usaha2" placeholder="Omzet/Volume Usaha 2..." class="form-control" id="omzet_usaha2">
                                </div>
								<div class="form-group">
                                    <label class="sr-only">Omzet/Volume Usaha 3</label>
                                    <input type="text" name="omzet_usaha3" placeholder="Omzet/Volume Usaha 3..." class="form-control" id="omzet_usaha3">
                                </div>
								<div class="form-group">
                                    <label class="sr-only">Foto Tempat Usaha</label>
                                    <input type="file" name="foto_tempat_usaha" class="form-control" id="foto_tempat_usaha">
                                </div>
								<h4>Simpanan Pokok/Anggota</h4>
								<div class="form-group">
                                    <label class="sr-only">Simpanan Pokok/Anggota</label>
                                    <input type="text" name="simpanan_pokok_anggota" class="form-control" id="simpanan_pokok_anggota">
                                </div>
								<h4>Jumlah Simpanan Pokok</h4>
								<div class="form-group">
                                    <label class="sr-only">Jumlah Simpanan Pokok</label>
                                    <input type="text" name="jumlah_simpanan_pokok" class="form-control" id="jumlah_simpanan_pokok">
                                </div>
								<h4>Simpanan Wajib/bulan</h4>
								<div class="form-group">
                                    <label class="sr-only">Simpanan Wajib/bulan</label>
                                    <input type="text" name="simpanan_wajib" class="form-control" id="simpanan_wajib">
                                </div>
								<h4>Jumlah Simpanan Wajib</h4>
								<div class="form-group">
                                    <label class="sr-only">Jumlah Simpanan Wajib</label>
                                    <input type="text" name="jumlah_simpanan_wajib" class="form-control" id="jumlah_simpanan_wajib">
                                </div>
								<h4>SHU Tahun Berjalan</h4>
								<div class="form-group">
                                    <label class="sr-only">SHU Tahun Berjalan</label>
                                    <input type="text" name="shu_tahun_berjalan" class="form-control" id="shu_tahun_berjalan">
                                </div>
								
								
								<div class="form-group">
									<div class="f1-buttons">
										<button type="reset" class="btn btn-next">Reset</button>
										<button type="button" class="btn btn-next">Next</button>
									</div>
								</div>
                            </fieldset>

                            <fieldset>
                                <h4>Hari/Tanggal Kunjungan</h4>
								<div class="form-group">
                                    <input type="date" name="tanggal_kunjungan" class="form-control" id="tanggal_kunjungan">
                                </div>
								<h4>Nama Koperasi</h4>
								<div class="form-group">
                                    <input type="text" name="nama_koperasi" class="form-control" id="nama_koperasi">
                                </div>
								<h4>Nomor dan Tanggal BH</h4>
								<div class="form-group">
									<div class="form-row">
										<div class="form-group col-md-6">
											<input type="text" class="form-control" placeholder="Nomor" name="nomorbh" id="nomorbh">
										</div>
										<div class="form-group col-md-6">
											<input type="date" class="form-control" placeholder="Tanggal BH" name="tanggal_bh" id="tanggal_bh">
										</div>
									</div>
								</div>
								<h4>Alamat</h4>
								<div class="form-group">
                                    <input type="text" name="alamat" class="form-control" id="alamat">
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
									<button type="reset" class="btn btn-next">Reset</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4>Social media profiles:</h4>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-facebook">Facebook</label>
                                    <input type="text" name="f1-facebook" placeholder="Facebook..." class="f1-facebook form-control" id="f1-facebook">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-twitter">Twitter</label>
                                    <input type="text" name="f1-twitter" placeholder="Twitter..." class="f1-twitter form-control" id="f1-twitter">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="f1-google-plus">Google plus</label>
                                    <input type="text" name="f1-google-plus" placeholder="Google plus..." class="f1-google-plus form-control" id="f1-google-plus">
                                </div>
                                <div class="f1-buttons">
                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" class="btn btn-submit">Submit</button>
                                </div>
                            </fieldset>
                    	
                    	</form>
                    </div>
                </div>
                    
            </div>
        <!--</div>-->


        <!-- Javascript -->
        <script src="<?php echo base_url()?>assets/formwizard/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url()?>assets/formwizard/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>assets/formwizard/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url()?>assets/formwizard/js/retina-1.1.0.min.js"></script>
        <script src="<?php echo base_url()?>assets/formwizard/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>