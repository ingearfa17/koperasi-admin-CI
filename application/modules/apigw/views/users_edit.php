<style>
.chosen-container{
    width: 50% !important;
} 

@media screen and (min-width: 768px) {
  
  #myModal .modal-dialog  {width:75%; margin-top:1px; }

}
</style>


<script type="text/javascript">
  $(document).ready(function() {
    $('#editmodal').on('show.bs.modal', function(e) {
      $('.chosen-select', this).chosen({width: "60%"});
    });
  });
</script>
<form id="frm_edit_user" enctype="multipart/form-data" role="form">
          <input type="hidden" value="<?php echo $hdr['user_id'] ?>" id="user_id_edit" name="user_id_edit" > 
          <div class="form-group-sm">
               <label for="user_id">User Name:</label>
                <input type="text" required class="form-control" readonly="readonly" value="<?php echo $hdr['user_name'] ?>" maxlength="35" style="width:60%" id="user_name_edit" name="user_name_edit">
          </div>
          <div class="form-group-sm">
               <label for="password"> Password:</label>
                <input type="password" style="width:30%" required class="form-control" value="<?php echo $hdr['pwd'] ?>" maxlength="25" style="width:60%" id="Password_edit" name="Password_edit">
          </div>
          <div class="form-group-sm" data-validate="email">
               <label for="email"> Email:</label>
                <input type="email" class="form-control" readonly="readonly" value="<?php echo $hdr['email'] ?>" maxlength="128" style="width:60%" id="email_edit" name="email_edit">
          </div>
          <div class="form-group-sm" data-validate="full_name">
               <label for="full_name"> Full Name:</label>
                <input type="text" class="form-control" value="<?php echo $hdr['full_name'] ?>" maxlength="45" style="width:60%" id="full_name_edit" name="full_name_edit">
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
          <button type="submit" id="btnsave_edit" style="margin-top:5px" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i> Update</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
      </form>
              <script language="javascript">
                  $('#frm_edit_user').submit(function(e) {
                      var form = $(this);
                      var formdata = false;
                      if(window.FormData){
                          formdata = new FormData(form[0]);
                      }

                        if(document.getElementById('roles_edit').value==''){
                         $('#alert_dialog').modal('show'); 
                         document.getElementById('roles_edit').focus();
                         return false;
                       } 

       
                      var formAction = form.attr('action');
                      $.ajax({
                          type        : 'POST',
                          url         : '<?php echo base_url()?>users/updatedata',
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
                               $('#editmodal').modal('hide');
                          }
                      });
                      e.preventDefault();
                  });
              </script>      