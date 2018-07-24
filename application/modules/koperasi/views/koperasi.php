<script src="<?php echo base_url()?>assets/js/choosen/chosen.jquery.min.js"></script>
                                                                                                  
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    document.getElementById('page_pos').value=page_num;  
    var keywords = $('#keywords').val();
    var sortBy = $('#sortBy').val();
    $('.loading').show();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>koperasi/ajaxPaginationData/'+page_num,
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
    $('.chosen-select', this).chosen({width: "100%"});    

    init_grid_data_manipulation();

    $(document).on('shown.bs.modal', function(e) {
      $('input:visible:enabled:first', e.target).focus();
    });

  url_kec='<?php echo base_url() ?>reff/kelurahanbykec_id'
  cascade_dropdown(url_kec, 'id_kecamatan', 'id_kelurahan', false);      

});


$(function(){
    $('#mdl_add').on('hidden.bs.modal', function () {
        $(this).find("input,textarea,select,checkbox").val('').end();
        $('#id_kecamatan').val('').trigger('chosen:updated');
        $('#id_kelurahan').val('').trigger('chosen:updated');
        $('#status_kantor').val('').trigger('chosen:updated');
        $('#bentuk_koperasi').val('').trigger('chosen:updated');
        $('#jenis_koperasi').val('').trigger('chosen:updated');
        $('#klp_koperasi').val('').trigger('chosen:updated');
        $('#sektor_usaha').val('').trigger('chosen:updated');
        $('#unit_usaha').val('').trigger('chosen:updated');
        $('#klasifikasi').val('').trigger('chosen:updated');
        $('#kesehatan').val('').trigger('chosen:updated');
    });
});

function delete_data(){
  delete_record("<?php echo base_url() ?>koperasi/row_delete",'frm_list')
}

function editdata(id){
  editdata_popup(id, '<?php echo base_url() ?>koperasi/editdata', 'edit_container', 'mdl_edit'); 
}

$(function(){
  $('.input-group.date').datepicker({
    calendarWeeks: true,
    todayHighlight: true,
    autoclose: true,
    format: 'dd/mm/yyyy'
  });  
});

</script>

<style>
.chosen-container{
    width: 100% !important;
} 


.chosen-container .chosen-drop {
  border-bottom: 0;
  border-top: 1px solid #aaa;
  top: auto;
  bottom: 40px;
}
.chosen-container.chosen-with-drop .chosen-single {
  border-top-left-radius: 0px;
  border-top-right-radius: 0px;
  border-bottom-left-radius: 5px;
  border-bottom-right-radius: 5px;
  background-image: none;
}
.chosen-container.chosen-with-drop .chosen-drop {
  border-bottom-left-radius: 0px;
  border-bottom-right-radius: 0px;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  box-shadow: none;
  margin-bottom: -16px;
}

.chosen-container .chosen-results {
    max-height:150px;
}
</style>
<div class="container">
          <div class="row">
                 <div class="box-header">
                      <div class="box-tools">
                              <div class="breadcrumbs ace-save-state" id="breadcrumbs" style="width:90%">
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
            <input type="hidden" id="page_pos">      
             <div id="messages" ></div>
            <div class="post-list" id="postList">
                 <div id="list_data_container">
                  <?php
                  echo '<table id="myTable" style="width:90%"  class="table table-condensed table-bordered tablesorter">';
                  echo '<thead>
                      <tr>
                        <th style="text-align:right; width:3px" >#</th>
                        <th style="width:3px" ><input type="checkbox" OnChange="Populate()"  class="select-all"   /></th>
                        <th>Kode Koperasi</th>
                        <th>Nama Koperasi</th>
                        <th>No. Badan Hukum</th>
                        <th>Tgl. Badan Hukum</th>
                        <th>Alamat</th>
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
                            <td style="width:3px" scope="row"><input type="checkbox" class="chk-box"  Onclick="Populate()" name="id_content[]" value='.$row['id_koperasi'].' /></td>
                            <td ><a href="javascript:editdata('."'".$row['id_koperasi']."'".')">'.$row['kd_koperasi'].'</a></td>
                            <td>'.$row['nm_koperasi'].'</td>
                             <td>'.$row['no_badan_hukum'].'</td>
                             <td>'.$row['tgl_badan_hukum'].'</td>
                             <td>'.$row['alamat_kantor'].'</td>
                            <td style="width:3px" align="center"><a href="javascript:editdata('."'".$row['id_koperasi']."'".')"><i style="font-size:16px;" class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
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
                      <div class="form-group" style="width:90%">
                          <button type="button" onclick="add_new()"  data-toggle="modal" data-target="#mdl_add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add New</button> 
                          <button id="btndelete" disabled type="button" data-toggle="modal" data-target="#confirm_del" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>  
                      </div>
               </div>
          </div>
      </div>

       <!-- modal add role -->
      <div class="modal fade" id="mdl_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Input Data Koperasi</h4>
            </div>
           <form id="frm_add" enctype="multipart/form-data" role="form">
            <div class="modal-body" style="height:450px; width:100%; overflow-x:hidden; overflow-y: scroll; padding-bottom:10px;">
                  <input type="hidden" id="id_koperasi" name="id_koperasi" > 
                  <!--modal content start here-->

                    <div class="form-group-sm">
                        <div class="row">
                          <div class="col-md-8">
                            <label for="menutext">Nama Koperasi:</label>
                            <input type="text" autocomplete="false" required class="form-control"  id="nm_koperasi" name="nm_koperasi">
                          </div>
                        </div>
                    </div>

                    <div class="form-group-sm">
                        <div class="row">
                          <div class="col-md-3">
                            <label for="menutext"> Tgl. Badan Hukum:</label>
                            <div class="input-group date">
                              <input type="text" class="form-control" id="tgl_badan_hukum" name="tgl_badan_hukum">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </span>
                            </div>
                          </div>

                          <div class="col-md-6">
                           <label for="menutext"> No. Badan Hukum:</label>
                           <input type="text" class="form-control"  id="no_badan_hukum" name="no_badan_hukum">
                          </div>

                          <div class="col-md-3">
                            <label for="menutext"> Tgl. RAT :</label>
                            <div class="input-group date">
                              <input type="text" class="form-control" id="rat" name="rat">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </span>
                            </div>
                          </div>  
                        </div>    
                    </div>
                   
                    <div class="form-group-sm">     
                         <label for="menutext"> Alamat Kantor</label>
                         <input type="text" class="form-control"  id="alamat_kantor" name="alamat_kantor">
                    </div>

                    <div class="form-group-sm">
                        <div class="row">
                          <div class="col-md-6">
                             <label for="email">Kecamatan</label>
                             <br/>
                             <?php echo $dt_cbo_kec ?>
                             <span id="loading_mini" style="display:none;">
                                <img src="<?php echo base_url().'assets/images/loading_small.gif'; ?>"/>
                                Loading data...
                             </span>
                        </div>
                          <div class="col-md-6" >
                             <label for="email">Kelurahan</label>
                             <br/>
                             <?php echo $dt_cbo_kel ?>
                          </div>
                        </div>
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-3">
                               <label for="email">Kode Pos</label>
                               <input type="text" class="form-control" id="kode_pos" name="kode_pos">
                            </div>

                            <div class="col-md-3">
                               <label for="email">No. Telpon. 1:</label>
                               <input type="text" class="form-control" id="no_tlp1" name="no_tlp1">
                            </div>

                            <div class="col-md-3" >
                               <label for="email">No. Telpon. 2:</label>
                               <input type="text" class="form-control" id="no_tlp2" name="no_tlp2">
                            </div>
                          
                            <div class="col-md-3" >
                               <label for="email">No. Fax:</label>
                               <input type="text" class="form-control" id="no_fax" name="no_fax">
                            </div>
                        </div>  
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Email</label>
                               <input type="text" class="form-control" id="email" name="email">
                            </div>

                            <div class="col-md-4">
                               <label for="email">Website</label>
                               <input type="text" class="form-control" id="website" name="website">
                            </div>

                            <div class="col-md-4" >
                               <label>Status Koperasi</label>
                               <?php echo $dt_cbo_status_kop ?>
                            </div>

                        </div>  
                    </div>
 
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Bentuk Koperasi</label>
                               <?php echo $dt_cbo_bentuk_kop ?>
                            </div>

                            <div class="col-md-4">
                               <label for="email">Jenis Koperasi</label>
                               <?php echo $dt_cbo_jenis_kop ?>
                            </div>

                            <div class="col-md-4" >
                               <label for="email">Kelompok Koperasi</label>
                               <?php echo $dt_cbo_klp_kop ?>
                            </div>
                        </div>  
                    </div>

                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Sektor Usaha</label>
                               <?php echo $dt_cbo_sektor_usaha_kop ?>
                            </div>

                            <div class="col-md-4">
                               <label for="email">Unit Usaha</label>
                               <?php echo $dt_cbo_unit_usaha_kop ?>
                            </div>
                        </div>  
                    </div>                    

                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4" >
                               <label for="email">Klasifikasi</label>
                               <?php echo $dt_cbo_klasifikasi_kop ?>
                            </div>
                          
                            <div class="col-md-4">
                               <label for="email">Kesehatan</label>
                               <?php echo $dt_cbo_kesehatan_kop ?>
                            </div>
                        </div>  
                    </div>

                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Nama Ketua</label>
                               <input type="text" class="form-control" id="ketua" name="ketua">
                            </div>

                            <div class="col-md-4">
                               <label for="email">No. Telpon Ketua</label>
                               <input type="text" class="form-control" id="no_tlp_ketua" name="no_tlp_ketua">
                            </div>

                        </div>  
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Sekretaris</label>
                               <input type="text" class="form-control" id="sekretaris" name="sekretaris">
                            </div>

                            <div class="col-md-4">
                               <label for="email">No. Telpon Sekretaris</label>
                               <input type="text" class="form-control" id="no_tlp_sekretaris" name="no_tlp_sekretaris">
                            </div>

                        </div>  
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Bendahara</label>
                               <input type="text" class="form-control" id="bendahara" name="bendahara">
                            </div>

                            <div class="col-md-4">
                               <label for="email">No. Telpon Bendahara</label>
                               <input type="text" class="form-control" id="no_tlp_bendahara" name="no_tlp_bendahara">
                            </div>

                        </div>  
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-2">
                               <label for="email">Jumlah Anggota Pria</label>
                               <input type="text" class="form-control" id="anggota_pria" name="anggota_pria">
                            </div>

                            <div class="col-md-2">
                               <label for="email">Jumlah Anggota Wanita</label>
                               <input type="text" class="form-control" id="anggota_wanita" name="anggota_wanita">
                            </div>

                            <div class="col-md-2">
                               <label for="email">Jumlah Manajer Pria</label>
                               <input type="text" class="form-control" id="manajer_pria" name="manajer_pria">
                            </div>
                            <div class="col-md-2">
                               <label for="email">Jumlah Manajer Wanita</label>
                               <input type="text" class="form-control" id="manajer_wanita" name="manajer_wanita">
                            </div>

                            <div class="col-md-2">
                               <label for="email">Jumlah Karyawan Pria:</label>
                               <input type="text" class="form-control" id="karyawan_pria" name="karyawan_pria">
                            </div>
                            <div class="col-md-2">
                               <label for="email">Jumlah Karyawan Wanita:</label>
                               <input type="text" class="form-control" id="karyawan_wanita" name="karyawan_wanita">
                            </div>
                        </div>  
                    </div>

                    <div class="form-group-sm">
                        <div class="row">

                            <div class="col-md-4">
                               <label for="email">SHU:</label>
                               <input type="text" class="form-control" id="shu" name="shu">
                            </div>

                            <div class="col-md-4" >
                               <label for="email">Asset:</label>
                               <input type="text" class="form-control" id="asset" name="asset">
                            </div>
                        </div>  
                    </div>                    

                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Modal Sendiri:</label>
                               <input type="text" class="form-control" id="modal_sendiri" name="modal_sendiri">
                            </div>

                            <div class="col-md-4">
                               <label for="email">Modal Luar:</label>
                               <input type="text" class="form-control" id="modal_luar" name="modal_luar">
                            </div>

                            <div class="col-md-4" >
                               <label for="email">Volume Usaha:</label>
                               <input type="text" class="form-control" id="volume_usaha" name="volume_usaha">
                            </div>

                        </div>  
                    </div>

            </div>
            <div class="modal-footer">
                          <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
          </form>
          </div>
        </div>
      </div>
      <!-- modal add role end -->
       <script>
            $('#frm_add').submit(function(e) {
                var form = $(this);
                var formdata = false;
                if(window.FormData){
                    formdata = new FormData(form[0]);
                }
                var formAction = form.attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : '<?php echo base_url()?>koperasi/savedata',
                    cache       : false,
                    data        : formdata ? formdata : form.serialize(),
                    contentType : false,
                    processData : false,
                    error : function(xhr, ajaxOptions, thrownError){
                        console.log(xhr.status);
                        console.log(xhr.responseText);
                        console.log(thrownError);
                        doModal('Error Info', xhr.responseText);
                    },
                    success : function(response){
                      alert(response);
                    toastr.options = {
                                timeOut: 3000,
                                positionClass:"toast-bottom-right"
                             };                            
                    toastr["info"](response);
                      // searchFilter(document.getElementById('page_pos').value);
                       //$('#mdl_add').modal('hide');
                    }

                });
                e.preventDefault();
            });
        </script>


      <!-- modal edit role -->
      <div class="modal fade" id="mdl_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Edit Role</h4>
            </div>
              <div id="edit_container">
                      <!-- content will be here -->
              </div>
          </div>
        </div>
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
               Are you sore want to delete seleted data ?
            </div>
            <div class="modal-footer">
              <?php $hal = $this->uri->segment(4); ?>
                 <button type="button" onclick="delete_data()" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Yes</button>
                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-ban"></i> No</button>
            </div>
        </div>
    </div>
</div> 


