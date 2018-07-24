<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    document.getElementById('page_pos').value=page_num;  
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    var tblname = $('#tblname').val();
    $('.loading').show();
    $.ajax({
      type: "POST",
      url:'<?php echo base_url(); ?>reff/ajaxPaginationData/'+page_num,
      data: 'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&tblname='+tblname, 
      error : function(xhr, ajaxOptions, thrownError){
          console.log(xhr.status);
          console.log(xhr.responseText);
          console.log(thrownError);
      },
      success : function(html){
            $('#postList').html(html);
            $('.loading').hide();
      }
    });
}

$(document).ready(function() {
    init_grid_data_manipulation();

    $(document).on('shown.bs.modal', function(e) {
      $('input:visible:enabled:first', e.target).focus();
    });
});

$(function(){
    $('#mdl_add').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select,checkbox").val('').end();
        $('#deskripsi').val('').trigger('chosen:updated');
    });
});

function delete_data(){
  delete_record("<?php echo base_url() ?>reff/row_delete",'frm_list')
}

function editdata(id){
  editdata_popup(id, '<?php echo base_url() ?>reff/editdata', 'edit_container', 'mdl_edit', $('#tblname').val()); 
}

</script>

<div class="wrapper-content ibox float-e-margins m-t animated fadeInDown">
    <!-- content here -->
      <div class="container">
          <div class="row">
                 <div class="box-header">
                      <div class="box-tools">
                              <div class="breadcrumbs ace-save-state" id="breadcrumbs" style="width:70%">
                                <button type="button" data-toggle="modal" data-target="#mdl_add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</button>

                                <div class="nav-search" id="nav-search">
                                    <span class="input-icon">
                                      <input type="text" name="searchText" id="keywords" onkeydown = "if (event.keyCode == 13) searchFilter() "  placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                      <i class="ace-icon fa fa-search nav-search-icon"></i>
                                    </span>
                                </div><!-- /.nav-search -->
                              </div>
                      </div>
                  </div><!-- /.box-header -->
           <form id="frm_list" > 
            <input type="hidden" id="tblname" name="tblname" value="<?php echo $tblname ?>" >
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
                              <td style="width:3px" scope="row"><input type="checkbox" class="chk-box"  Onclick="Populate()" name="id_content[]" value='.$row[$arr_col[0]].' /></td>
                              <td ><a href="javascript:editdata('."'".$row[$arr_col[0]]."'".')">'.$row[$arr_col[1]].'</a></td>
                              <td style="width:3px" align="center"><a href="javascript:editdata('."'".$row[$arr_col[0]]."'".')"><i style="font-size:16px;" class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
                            </tr>';
                        $rec_no++;    
                        }
                      }else{
                         echo '<tr><td colspan="3" class="bg-danger">Data not available or not found</td></tr>';
                      }  
                    echo '</table>';
                      ?>
                  </div>
                  <?php echo $this->ajax_pagination->create_links(); ?>        
              </div>
           </form>   
              <div class="col-xs-12 text-right">
                      <div class="form-group" style="width:70%">
                          <button type="button" onclick="add_new()"  data-toggle="modal" data-target="#mdl_add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</button> 
                          <button id="btndelete" type="button" disabled data-toggle="modal"  data-target="#confirm_del" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button> 
                      </div>
               </div>
          </div>
      </div>


<div class="modal fade" tabindex="-1" id="mdl_add" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Input Data Refferences</h4>
      </div>
     <form id="frm_add" enctype="multipart/form-data" role="form">
      <input type="hidden" id="tblname_to_add" name="tblname_to_add" value="<?php echo $tblname ?>" >
      <div class="modal-body">
          <div class="form-group-sm">
               <label for="user_id">Description:</label>
                <input type="text" required class="form-control" id="deskripsi" name="deskripsi">
          </div>
                                                   
      </div>   
      <div class="modal-footer" style="text-align:right">
          <button type="submit" id="btnsave" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
     </form>     
    </div><!-- /.modal-content -->
  </div> <!-- /.modal-dialog-->
</div><!-- /.modal -->

              <script language="javascript">
                  $('#frm_add').submit(function(e) {
                      var form = $(this);
                      var formdata = false;
                      if(window.FormData){
                          formdata = new FormData(form[0]);
                      }

                      var formAction = form.attr('action');
                      $.ajax({
                          type        : 'POST',
                          url         : '<?php echo base_url()?>reff/savedata',
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
                                      timeOut: 3000,
                                      positionClass:"toast-top-center"
                                   };                            
                               toastr["success"](response);
                               searchFilter(document.getElementById('page_pos').value);
                               $('#mdl_add').modal('hide');
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
                     Are you sore want to delete seleted data ?
                  </div>
                  <div class="modal-footer">
                        <button type="button"  onclick="delete_data()" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Yes</button>
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
      <!-- modal edit role -->
      <div class="modal fade" id="mdl_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Edit Refferences</h4>
            </div>
              <div id="edit_container">
                      <!-- content will be here -->
              </div>
          </div>
        </div>
      </div>
      <!-- modal edit role end -->

    <!-- content end here -->
  </div>
</div>




