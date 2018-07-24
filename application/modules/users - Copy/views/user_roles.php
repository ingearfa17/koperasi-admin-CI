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
                                                    <th style="width:3px" ><input type="checkbox" OnChange="Populate()"  class="select-all basic_checkbox_3"   /></th>
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
                          
                                     