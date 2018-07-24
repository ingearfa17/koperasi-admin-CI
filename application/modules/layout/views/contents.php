        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.button.css" />

						<script>

						function load_page(url_page,id_menu){
						   var id='';
						   $('.loading').show();	
						   $.ajax({
						      type: "POST",
						      url: url_page,
						      data: {idmenu: id_menu}, 
						      error : function(xhr, ajaxOptions, thrownError){
						          console.log(xhr.status);
						          console.log(xhr.responseText);
						          console.log(thrownError);
						      },
						      success : function(data){
						      	   $('.loading').hide();
						           $('#web_container').html(data);

						          // $('#editmodal').modal('show'); 
						      }
						  });
						}

						</script>

<!--                       <div class="loading" style="display: none; position: absolute;left: 50%;top: 50%;">
                          <div class="content">
                              <img src="<?php echo base_url().'assets/images/loading_circle.gif'; ?>"/>
                          </div>
                      </div> -->						
						<div class="row">
							<div class="col-xs-12">
								<div id="web_container">
								<!-- PAGE CONTENT BEGINS -->
									<?php
									if ( ! defined('BASEPATH')) exit('No direct script access allowed');

									if($isi)
									{
									    $this->load->view($isi);
									}
									?>									
								<!-- PAGE CONTENT ENDS -->
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->


