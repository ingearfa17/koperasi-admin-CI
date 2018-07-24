
<form id="frm_edit" enctype="multipart/form-data" role="form">
  <div class="modal-body">
    <input type="hidden" value="<?php echo $data_init->$arr_col[0] ?>" id="id_edit" name="id_edit" > 
    <input type="hidden" value="<?php echo $tblname ?>" id="tblname_edit" name="tblname_edit" > 
    <div class="form-group-sm">
        <label for="user_id">Description:</label>
        <input type="text" required class="form-control" value="<?php echo $data_init->$arr_col[1] ?>" id="deskripsi" name="deskripsi">
    </div> 
  </div>
  <div class="modal-footer">
      <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Update</button>
      <button  type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
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
                    url         : '<?php echo base_url()?>reff/updatedata',
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
