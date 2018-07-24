
<script type="text/javascript">
$(document).ready(function() {
    $('.chosen-select', this).chosen({width: "100%"});
});


$(function(){
  $('.input-group.date').datepicker({
    calendarWeeks: true,
    todayHighlight: true,
    autoclose: true,
    format: 'dd/mm/yyyy'
  });  
});

</script>
<form id="frm_edit" enctype="multipart/form-data" role="form">
  <div class="modal-body" style="height:450px; width:100%; overflow-x:hidden; overflow-y: scroll; padding-bottom:10px;">
                  <input type="hidden" id="id_koperasi" name="id_koperasi_edit" value="<?php echo $dt_init->id_koperasi ?>" > 
                  <!--modal content start here-->

                    <div class="form-group-sm">
                        <div class="row">
                          <div class="col-md-8">
                            <label for="menutext">Nama Koperasi:</label>
                            <input type="text" value="<?php  echo $dt_init->nm_koperasi ?>" autocomplete="false" required class="form-control"  id="nm_koperasi" name="nm_koperasi_edit">
                          </div>
                        </div>
                    </div>

                    <div class="form-group-sm">
                        <div class="row">
                          <div class="col-md-3">
                            <label for="menutext"> Tgl. Badan Hukum:</label>
                            <div class="input-group date">
                              <input type="text" value="<?php  echo format_date_as_id_format($dt_init->tgl_badan_hukum) ?>" class="form-control" id="tgl_badan_hukum" name="tgl_badan_hukum_edit">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </span>
                            </div>
                          </div>

                          <div class="col-md-6">
                           <label for="menutext"> No. Badan Hukum:</label>
                           <input type="text" value="<?php  echo $dt_init->no_badan_hukum ?>" class="form-control"  id="no_badan_hukum" name="no_badan_hukum_edit">
                          </div>

                          <div class="col-md-3">
                            <label for="menutext"> Tgl. RAT :</label>
                            <div class="input-group date">
                              <input type="text" value="<?php  echo format_date_as_id_format($dt_init->rat) ?>" class="form-control" id="rat" name="rat_edit">
                              <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </span>
                            </div>
                          </div>  
                        </div>    
                    </div>
                   
                    <div class="form-group-sm">     
                         <label for="menutext"> Alamat Kantor</label>
                         <input type="text" value="<?php  echo $dt_init->alamat_kantor ?>" class="form-control"  id="alamat_kantor" name="alamat_kantor_edit">
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
                               <input type="text" value="<?php  echo $dt_init->kode_pos ?>" class="form-control" id="kode_pos" name="kode_pos_edit">
                            </div>

                            <div class="col-md-3">
                               <label for="email">No. Telpon. 1:</label>
                               <input type="text" value="<?php  echo $dt_init->no_tlp1 ?>" class="form-control" id="no_tlp1" name="no_tlp1_edit">
                            </div>

                            <div class="col-md-3" >
                               <label for="email">No. Telpon. 2:</label>
                               <input type="text" value="<?php  echo $dt_init->no_tlp2 ?>" class="form-control" id="no_tlp2" name="no_tlp2_edit">
                            </div>
                          
                            <div class="col-md-3" >
                               <label for="email">No. Fax:</label>
                               <input type="text" value="<?php  echo $dt_init->no_fax ?>" class="form-control" id="no_fax" name="no_fax_edit">
                            </div>
                        </div>  
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Email</label>
                               <input type="text" value="<?php  echo $dt_init->email ?>" class="form-control" id="email" name="email_edit">
                            </div>

                            <div class="col-md-4">
                               <label for="email">Website</label>
                               <input type="text" value="<?php  echo $dt_init->website ?>" class="form-control" id="website" name="website_edit">
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
                               <input type="text" value="<?php  echo $dt_init->ketua ?>" class="form-control" id="ketua" name="ketua_edit">
                            </div>

                            <div class="col-md-4">
                               <label for="email">No. Telpon Ketua</label>
                               <input type="text" value="<?php  echo $dt_init->no_tlp_ketua ?>" class="form-control" id="no_tlp_ketua" name="no_tlp_ketua_edit">
                            </div>

                        </div>  
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Sekretaris</label>
                               <input type="text" value="<?php  echo $dt_init->sekretaris ?>" class="form-control" id="sekretaris" name="sekretaris_edit">
                            </div>

                            <div class="col-md-4">
                               <label for="email">No. Telpon Sekretaris</label>
                               <input type="text" value="<?php  echo $dt_init->no_tlp_sekretaris ?>" class="form-control" id="no_tlp_sekretaris" name="no_tlp_sekretaris_edit">
                            </div>

                        </div>  
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Bendahara</label>
                               <input type="text" value="<?php  echo $dt_init->bendahara ?>" class="form-control" id="bendahara" name="bendahara_edit">
                            </div>

                            <div class="col-md-4">
                               <label for="email">No. Telpon Bendahara</label>
                               <input type="text" value="<?php  echo $dt_init->no_tlp_bendahara ?>" class="form-control" id="no_tlp_bendahara" name="no_tlp_bendahara_edit">
                            </div>

                        </div>  
                    </div>
                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-2">
                               <label for="email">Jumlah Anggota Pria</label>
                               <input type="text" value="<?php  echo $dt_init->anggota_pria ?>" class="form-control" id="anggota_pria" name="anggota_pria_edit">
                            </div>

                            <div class="col-md-2">
                               <label for="email">Jumlah Anggota Wanita</label>
                               <input type="text" value="<?php  echo $dt_init->anggota_wanita ?>" class="form-control" id="anggota_wanita" name="anggota_wanita_edit">
                            </div>

                            <div class="col-md-2">
                               <label for="email">Jumlah Manajer Pria</label>
                               <input type="text" value="<?php  echo $dt_init->manajer_pria ?>" class="form-control" id="manajer_pria" name="manajer_pria_edit">
                            </div>
                            <div class="col-md-2">
                               <label for="email">Jumlah Manajer Wanita</label>
                               <input type="text" value="<?php  echo $dt_init->manajer_wanita ?>" class="form-control" id="manajer_wanita" name="manajer_wanita_edit">
                            </div>

                            <div class="col-md-2">
                               <label for="email">Jumlah Karyawan Pria:</label>
                               <input type="text" value="<?php  echo $dt_init->karyawan_pria ?>" class="form-control" id="karyawan_pria" name="karyawan_pria_edit">
                            </div>
                            <div class="col-md-2">
                               <label for="email">Jumlah Karyawan Wanita:</label>
                               <input type="text" value="<?php  echo $dt_init->karyawan_wanita ?>" class="form-control" id="karyawan_wanita" name="karyawan_wanita_edit">
                            </div>
                        </div>  
                    </div>

                    <div class="form-group-sm">
                        <div class="row">

                            <div class="col-md-4">
                               <label for="email">SHU:</label>
                               <input type="text" value="<?php  echo $dt_init->shu ?>" class="form-control" id="shu" name="shu_edit">
                            </div>

                            <div class="col-md-4" >
                               <label for="email">Asset:</label>
                               <input type="text" value="<?php  echo $dt_init->asset ?>" class="form-control" id="asset" name="asset_edit">
                            </div>
                        </div>  
                    </div>                    

                    <div class="form-group-sm">
                        <div class="row">
                            <div class="col-md-4">
                               <label for="email">Modal Sendiri:</label>
                               <input type="text" value="<?php  echo $dt_init->modal_sendiri ?>" class="form-control" id="modal_sendiri" name="modal_sendiri_edit">
                            </div>

                            <div class="col-md-4">
                               <label for="email">Modal Luar:</label>
                               <input type="text" value="<?php  echo $dt_init->modal_luar ?>" class="form-control" id="modal_luar" name="modal_luar_edit">
                            </div>

                            <div class="col-md-4" >
                               <label for="email">Volume Usaha:</label>
                               <input type="text" value="<?php  echo $dt_init->volume_usaha ?>" class="form-control" id="volume_usaha" name="volume_usaha_edit">
                            </div>

                        </div>  
                    </div>

            </div>
            <div class="modal-footer">
                          <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Update</button>
                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
      <!-- modal add role end -->
       <script>
            $('#frm_edit').submit(function(e) {
                var form = $(this);
                var formdata = false;
                if(window.FormData){
                    formdata = new FormData(form[0]);
                }
                var formAction = form.attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : '<?php echo base_url()?>koperasi/updatedata',
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
                                  positionClass:"toast-bottom-right"
                               };                            
                       toastr["info"](response);
                       searchFilter(document.getElementById('page_pos').value);
                       $('#mdl_edit').modal('hide');
                    }
                });
                e.preventDefault();
            });
        </script>
</form>

