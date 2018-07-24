<script>
$(document).ready(function() {
    $('.chosen-select', this).chosen({width: "40%"});    
      init_grid_data_manipulation();

});

</script>
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
 