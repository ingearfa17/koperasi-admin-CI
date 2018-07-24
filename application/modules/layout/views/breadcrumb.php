					<!-- /.breadcrumb -->
					<div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url()?>">Home</a>
							</li>
							<?php 
							    $itembc ='';
								if(is_array($title)){
									foreach($title as $item){
										$itembc.= "<li>
													$item
												  </li>";
									}
								}else{
										$itembc= "<li class='active'>$title</li>";									
								}
							 echo $itembc;

							 ?>
						</ul><!-- /.breadcrumb -->

						<!-- <div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div> --><!-- /.nav-search -->
					</div>
					<!-- will be closed on footer -->
					<div class="page-content">