
<script src="<?php echo base_url()?>assets/js/jquery-ui.js"></script>
<script src="<?php echo base_url()?>assets/js/choosen/chosen.jquery.min.js"></script>

<script src="<?php echo base_url()?>assets/js/choosen/init.js"></script>
<script src="<?php echo base_url()?>assets/js/alert_handler.js"></script>

<link href="<?php echo base_url()?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/css/bootstrap.form.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/css/choosen/prism.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/css/choosen/chosen.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>assets/css/bootstrap-titlebar-color.css" rel="stylesheet" type="text/css">

<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    document.getElementById('page_pos').value=page_num;  
    var keywords = $('#keywords').val();

  $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>users/ajaxPaginationData/'+page_num,
        data:'page='+page_num+'&keywords='+keywords,
        error : function(xhr, ajaxOptions, thrownError){
          console.log(xhr.status);
          console.log(xhr.responseText);
          console.log(thrownError);
         },
          success : function(data){
             $('#postList').html(data);
          }
  });
}

function Populate(){
  var favorite = [];
  $.each($("input[name='id_content']:checked"), function(){
       favorite.push($(this).val());
  });
  $('#tags').val(favorite.join("|"));
}

function add_new(){
  $("#btnsave").html("<i class='fa fa-save'></i> Save");
  $('#roles').val('').trigger('chosen:updated');
  $('#urusan').val('').trigger('chosen:updated');
  $('#opd').val('').trigger('chosen:updated');
}

$('document').ready(function()
{
    $('.select-all').click(function(){
        if(this.checked)
            $(".chk-box").prop("checked", true);
        else
            $(".chk-box").prop("checked", false);
    });
        
    $(".chk-box").click(function()
    {
        if($(".chk-box").length == $(".chk-box:checked").length)
        {
            $(".select-all").prop("checked", true);
        }
        else
        {
            $(".select-all").removeAttr("checked");
        }
    });
});

	
$(document).ready(function() {
  $('#myModal').on('show.bs.modal', function(e) {
    $('.chosen-select', this).chosen({width: "60%"});
  });
});
	
	
function delete_data () {
  var data = $("#frm_role_list").serialize(); 
    $.ajax({
        url: "<?php echo base_url() ?>users/deletedata", // link of your "whatever" php
        type: "POST",
        async: true,
        cache: false,
        data: data, // all data will be passed here
        success: function(response){ 
            $('#confirm_del').modal('hide');
            doModal('Delete Confirmation', response);
            searchFilter(document.getElementById('page_pos').value);
        }
    });
 }

$(function(){
    $('#myModal').on('hidden.bs.modal', function () {
        //$(this).find("input,textarea,select,checkbox").val('').end();
        $('#role').chosen({width: "60%"});

    });
});

function editdata(id){
    var url;
   $('#loading_main').show();
   url= '<?php echo base_url() ?>users/editdata';
   $.ajax({
      type: "POST",
      url: url,
      data: { the_id: id}, 
      error : function(xhr, ajaxOptions, thrownError){
          //console.log(xhr.status);
          //console.log(xhr.responseText);
          //console.log(thrownError);
          doModal('Error Info', xhr.responseText);
      },
      success : function(data){
           $('#loading_main').hide();
           $('#editcontainer').html(data);
           $('#editmodal').modal('show'); 
      }
  });
}



</script>

<style>
.chosen-container{
    width: 50% !important;
}	

@media screen and (min-width: 768px) {
  
  #myModal .modal-dialog  {width:75%; margin-top:1px; }
  #editmodal .modal-dialog  {width:75%; margin-top:1px; }

}


</style>

<div class="row wrapper border-bottom white-bg page-heading">
  <div class="col-lg-10">
    <h2><?php echo $title;?></h2>
    <ol class="breadcrumb">
      <li><?php echo $menu;?></li>
      <li class="active"><strong><?php echo $title;?></strong></li>
    </ol>
  </div>
</div>

<div class="wrapper-content ibox float-e-margins m-t animated fadeInDown">
    <!-- content here -->
      <div class="container">
          <div class="row">
                 <div class="box-header">
                      <div class="box-tools">
                              <div class="loading" style="display: none; position: absolute;left: 50%;top: 50%;">
                                  <div class="content">
                                      <img src="<?php echo base_url().'assets/images/loader/loading.gif'; ?>"/>
                                  </div>
                              </div>
                               <div class="input-group" style="width:70%">
                                   <button type="button" onclick="add_new()"   data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</button> 
                                  <input type="text" onkeydown = "if (event.keyCode == 13) searchFilter() "    
                                  name="searchText" id="keywords"  class="form-control input-sm pull-right" style="width: 200px; " placeholder="Search"/>
                                 <div class="input-group-btn">
                                      <button style="height: 30px; " onclick="searchFilter()" class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                  </div>
                              </div>
                      </div>
                  </div><!-- /.box-header -->
           <form id="frm_role_list" > 
              <input type="hidden" id="page_pos">      
               <div id="messages" ></div>
              <div class="post-list" id="postList">
                   <div id="list_data_container">
                    <?php
                    echo '<table id="myTable" style="width:70%"  class="table table-condensed table-bordered tablesorter">';
                    echo '<thead>
                        <tr>
                          <th style="text-align:right; width:3px" >#</th>
                          <th style="width:3px" ><input type="checkbox" OnChange="Populate()"  class="select-all"   /></th>
                          <th>User Name</th>
                          <th>Email</th>
                          <th>Full Name</th>
                          <th>OPD</th>
                          <th>Role</th>
                          <th style="width:3px">Action</th>
                        </tr>
                        </thead>
                    <tbody>';
                    $rec_no =1;
                    if(!empty($posts)){  
                        $status ='';  
                        foreach($posts as $row){
                          $opd = $row['id_opd'];

                         echo '<tr>
                              <td scope="row" align="right" style="width:3%" >'.$rec_no.'. </td>
                              <td style="width:3px" scope="row"><input type="checkbox" class="chk-box"  Onclick="Populate()" name="id_content[]" value='.$row['user_id'].' /></td>
                              <td ><a href="javascript:editdata('."'".$row['user_id']."'".')">'.$row['user_name'].'</a></td>
                              <td>'.$row['email'].'</td>
                              <td>'.$row['full_name'].'</td>
                              <td>'.get_info_by_id_global_param('ref_opd', 'nm_opd', " WHERE id_opd = '$opd' ").'</td>
                              <td>'.$row['roles_name'].'</td>
                              <td style="width:3px" align="center"><a href="javascript:editdata('."'".$row['user_id']."'".')"><i style="font-size:16px;" class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
                            </tr>';
                        $rec_no++;    
                        }
                      }else{
                         echo '<tr><td colspan="8" class="bg-danger">Data not available or not found</td></tr>';
                      }  
                    echo '</table>';
                      ?>
                  </div>
                  <?php echo $this->ajax_pagination->create_links(); ?>        
              </div>
           </form>   
              <div class="col-xs-12 text-right">
                      <div class="form-group" style="width:70%">
                          <button type="button" onclick="add_new()"  data-toggle="modal" data-target="#myModal" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</button> 
                          <button type="button" data-toggle="modal" data-target="#confirm_del" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button> 
                      </div>
               </div>
          </div>
      </div>


<div class="modal fade" tabindex="-1" id="myModal" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">User Management</h4>
      </div>
      <div class="modal-body">
        <form id="frm_user" enctype="multipart/form-data" role="form">
          <input type="hidden" id="user_id" name="user_id" > 
          <div class="form-group-sm">
               <label for="user_id">User Name:</label>
                <input type="text" required class="form-control" maxlength="35" style="width:60%" id="user_name" name="user_name">
          </div>
          <div class="form-group-sm">
               <label for="password"> Password:</label>
                <input type="password" style="width:30%" required class="form-control" maxlength="25" style="width:60%" id="Password" name="Password">
          </div>
          <div class="form-group-sm" data-validate="email">
               <label for="email"> Email:</label>
                <input type="email" class="form-control" maxlength="128" style="width:60%" id="email" name="email">
          </div>
          <div class="form-group-sm" data-validate="full_name">
               <label for="full_name"> Full Name:</label>
                <input type="text" class="form-control" maxlength="45" style="width:60%" id="full_name" name="full_name">
          </div>
          <div class="form-group" data-validate="role">
               <label for="email">User  Role:</label>
               <br/>
                <?php echo $dt_cbo_role ?>
          </div>

          <div class="form-group" data-validate="role">
               <label for="email">Organisasi Perangkat Daerah</label>
               <br/>
                <?php echo $dt_cbo_opd ?>
          </div>

          <div class="form-group" data-validate="role">
               <label for="email">Urusan</label>
               <br/>
                <?php echo $dt_cbo_urusan ?>
          </div>                                          

      <div class="modal-footer" style="text-align:right">
          <button type="submit" id="btnsave" style="margin-top:5px" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
      </form>    
      </div><!-- .modal body -->

    

    </div><!-- /.modal-content -->
  </div> <!-- /.modal-dialog-->
</div><!-- /.modal -->

              <script language="javascript">
                  $('#frm_user').submit(function(e) {
                      var form = $(this);
                      var formdata = false;
                      if(window.FormData){
                          formdata = new FormData(form[0]);
                      }

                        if(document.getElementById('roles').value==''){
                         $('#alert_dialog').modal('show'); 
                         document.getElementById('roles').focus();
                         return false;
                       } 

       
                      var formAction = form.attr('action');
                      $.ajax({
                          type        : 'POST',
                          url         : '<?php echo base_url()?>users/savedata',
                          cache       : false,
                          data        : formdata ? formdata : form.serialize(),
                          contentType : false,
                          processData : false,
                          error : function(xhr, ajaxOptions, thrownError){
                              console.log(xhr.status);
                              console.log(xhr.responseText);
                              console.log(thrownError);
                          },
                          success : function(response){
                              toastr.options = {
                                          timeOut: 1000
                                       };                            
                               toastr["success"](response);
                               searchFilter(document.getElementById('page_pos').value);
                               $('#myModal').modal('hide');
                          }
                      });
                      e.preventDefault();
                  });
              </script>

       <div class="modal fade" id="confirm_del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
                  </div>
                  <div class="modal-body">
                     <div id="loadingmessage2" style="display:none">
                         <img src="<?php echo base_url()?>assets/images/loader/loading.gif"/>
                     </div>              
                     Are you sore want to delete seleted data ?
                  </div>
                  <div class="modal-footer">
                        <button type="button" style="margin-top: 5px" onclick="delete_data()" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Yes</button>
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-ban"></i> No</button>
                  </div>
              </div>
          </div>
      </div> 

      <!-- Modal alert Popup -->
      <div class="modal fade success-popup" id="alert_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title" id="myModalLabel">Input Validation</h4>
            </div>
            <div class="modal-body text-center">
               
                <p class="title">User Role is required. Please select from the list </p>
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
            
          </div>
        </div>
      </div>
<!-- Modal for Edit -->
<div class="modal fade" tabindex="-1" id="editmodal" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">User Management</h4>
      </div>
      <div class="modal-body" id="editcontainer">
        <!-- form start here -->

        <!-- form end here -->
      </div><!-- .modal body -->
    </div><!-- /.modal-content -->
  </div> <!-- /.modal-dialog-->
</div><!-- /.modal -->
<!-- Modal for Edit end here -->

    <!-- content end here -->
  </div>
</div>




