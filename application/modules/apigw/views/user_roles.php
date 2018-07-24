<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    document.getElementById('page_pos').value=page_num;  
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $('.loading').show();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>users/user_roles/ajaxPaginationData/'+page_num,
        data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
        beforeSend: function () {
           
        },
        success: function (html) {
            $('#postList').html(html);
            $('.loading').hide();
        }
    });
}

$(document).ready(function() {
    $('.chosen-select', this).chosen({width: "40%"});    
      init_grid_data_manipulation();

});



function delete_data(){
  delete_record("<?php echo base_url() ?>users/user_roles/row_delete",'frm_role_list')
}

function editdata(id){
  edit_record(id, '<?php echo base_url() ?>users/user_roles/editdata', 'list_continer', 'edit_role_container'); 
}


</script>


  <div class="ibox float-e-margins m-t animated fadeInDown">
      <div id="list_continer">
      <!-- content here -->
        <div class="container">
            <div class="row">
                   <div class="box-header">
                        <div class="box-tools">
  <!--                               <div class="loading" style="display: none; position: absolute;left: 50%;top: 50%;">
                                    <div class="content">
                                        <img src="<?php echo base_url().'assets/img/loading_circle.gif'; ?>"/>
                                    </div>
                                </div> -->
                                 <div class="input-group" style="width:70%">
                                     <button type="button" onclick="$('#list_continer').hide('slow'); $('#add_container').show('slow')" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</button> 
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
                <div><br></div>
                <?php
                echo '<table id="myTable" style="width:70%"  class="table table-condensed table-bordered">';
                echo '<thead>
                    <tr>
                      <th style="text-align:right; width:3px" >#</th>
                      <th style="width:3px" ><input type="checkbox" OnChange="Populate()"  class="select-all"   /></th>
                      <th>Roles Name</th>
                      <th>Description</th>
                      <th style="width:3px">Action</th>
                    </tr>
                    </thead>
                <tbody>';
                $rec_no =1;
                if(!empty($posts)){  
                    $status ='';  
                    foreach($posts as $row){
                     echo '<tr>
                          <td scope="row" align="right" style="width:3%" >'.$rec_no.'. </td>
                          <td style="width:3px" scope="row"><input type="checkbox" class="chk-box"  Onclick="Populate()" name="id_content[]" value='.$row['roles_id'].' /></td>
                          <td ><a href="javascript:editdata('."'".$row['roles_id']."'".')">'.$row['roles_name'].'</a></td>
                          <td>'.$row['roles_desc'].'</td>
                          <td style="width:3px" align="center"><a href="javascript:editdata('."'".$row['roles_id']."'".')"><i style="font-size:16px;" class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
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
                            <button type="button" onclick="$('#list_continer').hide('slow'); $('#add_container').show('slow')"   class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</button> 
                            <button id="btndelete" disabled type="button" data-toggle="modal" data-target="#confirm_del" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button> 
                        </div>
                 </div>
            </div>
        </div>
      </div><!-- list container -->  
        <!-- modal add role -->
          <div id="add_container" style="display:none;">
             <form id="frm_add_role" enctype="multipart/form-data" role="form">
              <div class="modal-body">
                    <input type="hidden" id="role_id" name="role_id" > 
                    <!--modal content start here-->
                        <div class="form-group-sm">
                             <label for="menutext">Role Name:</label>
                              <input type="text" required class="form-control" maxlength="150" style="width:60%" id="roles_name" name="roles_name">
                        </div>
                        <div class="form-group-sm">
                             <label for="menutext"> Description:</label>
                              <input type="text" class="form-control" maxlength="255" style="width:60%" id="roles_desc" name="roles_desc">
                        </div>
                       <div class="form-group" data-validate="role">
                           <label for="menu_access">Menu will be able  to Access:</label>
                           <br/>
                            <?php echo $dt_cbo_menu ?>
                      </div>


              </div>
              <div class="modal-footer">
                            <button type="submit" style="margin-top: 5px" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                            <button type="button" onclick="$('#list_continer').show('slow'); $('#add_container').hide('slow')" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              </div>
            </form>
          </div>  
        <!-- modal add role end -->
         <script>
              $('#frm_add_role').submit(function(e) {
                  var form = $(this);
                  var formdata = false;
                  if(window.FormData){
                      formdata = new FormData(form[0]);
                  }
                  var formAction = form.attr('action');
                  $.ajax({
                      type        : 'POST',
                      url         : '<?php echo base_url()?>users/user_roles/savedata',
                      cache       : false,
                      data        : formdata ? formdata : form.serialize(),
                      contentType : false,
                      processData : false,
                      error : function(xhr, ajaxOptions, thrownError){
                          console.log(xhr.status);
                          console.log(xhr.responseText);
                          console.log(thrownError);
                          //doModal('Error Info', xhr.responseText);
                      },
                      success : function(response){
                        toastr.options = {
                                    timeOut: 1000
                                 };                            
                         toastr["success"](response);
                         searchFilter(document.getElementById('page_pos').value);
                         $('#list_continer').show('slow'); 
                         $('#add_container').hide('slow');
                      }

                  });
                  e.preventDefault();
              });
          </script>


        <!-- modal edit role -->
            <div id="edit_role_container" style="display:none;">
            </div>
        <!-- modal edit role end -->




   <div class="modal fade" id="confirm_del" tabindex="-1" role="dialog" aria-labelledby="mdl_roleLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="mdl_roleLabel">Delete Confirmation</h4>
              </div>
               <div class="modal-body">
                  <div class="row">
                     <div class="col-xs-1">
                       <span class="fa fa-trash fa-2x"> </span>
                     </div>
                     <div class="col-xs-11">
                        Are you sore want to delete seleted data ?
                     </div>
                   </div>                  
              </div>
              <div class="modal-footer">
                   <button type="button" onclick="delete_data()" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Yes</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-ban"></i> No</button>
              </div>
          </div>
      </div>
  </div> 

