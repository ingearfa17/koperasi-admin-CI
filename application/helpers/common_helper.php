<?php 
function create_db_combo($tblname, $key_field, $value_field, $order_field, $additional_value='-Plese Select-', $param=''){
     //get main CodeIgniter object  
       $ci =& get_instance();
       //load databse library
       $ci->load->database();

   $ci->db->from($tblname);
     if($param!=''){
        $ci->db->where($param);
     }
     $ci->db->order_by($order_field);
     $result = $ci->db->get();

    $dd[''] = $additional_value ;
    if ($result->num_rows() > 0){
      foreach ($result->result() as $row) {
        $dd[$row->$key_field] = $row->$value_field;
      }
    }
    return $dd;
  }

function create_chosen_db_combo($id_obj, $tblname, $key_field, $value_field, $order_field, $additional_value, $selected_value='', $param='', $multiple=false, $dt_arr_multi=array()){
     $ci =& get_instance();
     $ci->load->database();
     $sql ="SELECT $key_field, $value_field FROM $tblname $param";  //echo $sql ."<br>";
     $query=$ci->db->query($sql);
     $result = $query->result_array();
    $dd='' ;
    $state ='';
    $multi ='';
    $tanda='';
    if($multiple==true){
      $multi = 'multiple';
      $tanda = "[]";
    }

      $dd.= '<select '.$multi.' style="position:absolute;" data-placeholder="" id="'.$id_obj.'" name="'.$id_obj.$tanda.'" single class="chosen-select" tabindex="8" " >';
          $cntr = 0;
          if($additional_value==''){
            //$additional_value ='-Please Select-';
          }
      foreach ($result as $res) {
        $r = array_values($res);
        $flag ='';
//echo " data ". $r[0] ." selected ". $selected_value .'<br>';
            if($r[0]==$selected_value){
              $selected='Selected';
            }else{
              $selected='';
            }

            if($cntr==0){
              $dd.='<option style="fixed; z-index:99999"    value="">'.$additional_value.'</option>';
            } 

            if($multiple==true){//jika dropdown multi select
              if(count($dt_arr_multi)>0){//Jika nilai sudah ada di db utk user tertentu
                     if(in_array($r[0],$dt_arr_multi, true)){
                        $selected='Selected';
                     }else{
                        $selected='';
                     }
                   $dd.='<option  style="fixed; z-index:99999"  '.$flag.' '.$selected.' value="'.$r[0].'">'.$r[1].'</option>';
              }else{//jika nilai blum ada di db utk user tertentu
                   $dd.='<option  style="fixed; z-index:99999"  '.$flag.' value="'.$r[0].'">'.$r[1].'</option>';
              }
            }else{//jika single select
                $dd.='<option  style="fixed; z-index:99999"  '.$flag.' '.$selected.' value="'.$r[0].'">'.$r[1].'</option>';
            }

            $cntr++;
      }
      $dd.= '</select>';
    return $dd;
  }

   function is_data_exist($tblname, $fieldname, $param){
      $ci =& get_instance();
      $ci->load->database();

      $sql ="SELECT $fieldname FROM $tblname WHERE $param ";
      $query=$ci->db->query($sql);
      $row=$query->row();
      if(isset($row)){
        return true;
      }else{
        return false;
      }
   }

  function display_menu($parent='') {
    $ci =& get_instance();
    $ci->load->database();
    $menu_spec = get_sys_setting('009');
    $roles_id = $ci->session->userdata('roles_id');
    $sqlhdr = "SELECT a.id_menu, a.menu_label, a.link_menu, Deriv1.Count, a.parent_id, a.icon_menu  FROM `sys_admin_menu` a 
    LEFT OUTER JOIN (SELECT parent_id, COUNT(*) AS Count FROM `sys_admin_menu` GROUP BY parent_id) Deriv1 
    ON a.id_menu = Deriv1.parent_id WHERE a.parent_id='$parent' and is_active = 'Y' AND menu_spec like '%$menu_spec%' 
    AND id_menu in (SELECT id_menu FROM sys_menu_role WHERE roles_id = '$roles_id') ORDER BY sort_order";
    $queryhdr =$ci->db->query($sqlhdr);

    $class_active ="";$default_page="";
    $menu_item ="<ul class='nav nav-list'>";
                      if($parent==''){
                        $default_page ="Dashboard";
                      } 
                      foreach ($queryhdr->result() as $row){
                          if($row->menu_label==$default_page){
                            $class_active = "class='active'";
                          }else{
                            $class_active = "";
                          }
                      if($row->Count>0){
                          $menu_item.="<li class=''>
                                <a  href='#' class='dropdown-toggle'>
                                    <i class='menu-icon fa fa-".$row->icon_menu."''></i>
                                    <span class='menu-text'> ".$row->menu_label." </span>
                                    <b class='arrow fa fa-angle-down'></b>
                                </a>
                                <b class='arrow'></b>
                                <ul class='submenu'>";
                                    $menu_item.=display_menu($row->id_menu);
                   $menu_item.="</ul>";    
                          $menu_item.="</li>";               
                      } elseif ($row->Count==0) {
                  $menu_item .="<li class='' >
                                    <a onclick=load_page('".base_url().$row->link_menu."','".$row->id_menu."')  href='#'>
                                        <i class='menu-icon fa fa-".$row->icon_menu."'></i>
                                        <span class='menu-text'> ".$row->menu_label." </span>
                                    </a>
                                </li>";
                      } else;
                      }
    $menu_item.=" </ul>";

    return $menu_item;  
    }

function get_breadcrumb_info($idmenu){
    $ci =& get_instance();
    $ci->load->database(); 
    $sql = "SELECT b.menu_label main, a.menu_label child
            FROM sys_admin_menu AS a
            LEFT JOIN sys_admin_menu AS b ON a.parent_id = b.id_menu
            WHERE a.id_menu ='$idmenu' ";
  $query=$ci->db->query($sql);
  $rows=$query->row();
  if(isset($rows)){
    if($rows->main==''){
       $item_bc = array($rows->child);
    }else{
      $item_bc = array($rows->main, $rows->child);
    }
  }
  return $item_bc;
}

function get_info_by_id($tblname, $fieldinfo, $field_id, $nilai){
  $ci =& get_instance();
  //load databse library
  $ci->load->database();    

  $sql ="SELECT  $fieldinfo FROM $tblname WHERE $field_id = '$nilai'";
  //echo $sql."<BR>";
  $query=$ci->db->query($sql);
  $rows=$query->row();
  if(isset($rows)){
    $info = $rows->$fieldinfo;
  }else{
    $info ='';
  }
  return $info;
}

function get_info_by_id_global_param($tblname, $fieldinfo, $param){
  $ci =& get_instance();
  //load databse library
  $ci->load->database();    

  $sql ="SELECT  $fieldinfo FROM $tblname $param ";
  $query=$ci->db->query($sql);
  $rows=$query->row();
  if(isset($rows)){
    $info = $rows->$fieldinfo;
  }else{
    $info ='';
  }
  return $info;
}

 function get_sys_setting($id){
     $ret_val = '';
       //get main CodeIgniter object
       $ci =& get_instance();
       
       //load databse library
       $ci->load->database();
       
     //get data from database
     $sql ="SELECT value_setting FROM sys_settings WHERE id_setting = '$id'";
     $query = $ci->db->query($sql);
     $row=$query->row();
     if($row){
      $ret_val = $row->value_setting;    
     }
     return $ret_val;
   }

function generate_table($array_title, $array_data, $field_to_display, $numeric_col=array()){
$tbl='<style type="text/css">
.paging-nav {
  text-align: right;
  padding-top: 2px;
}

.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 1px 7px;
  background: #91b9e6;
  color: white;
  border-radius: 3px;
}

.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
}

.paging-nav,
#tableData {
  width: 100%;
  margin: 0 auto;
  font-family: Arial, sans-serif;
}
</style>';	
	$tbl.='<script type="text/javascript" src="'.base_url().'assets/js/jquery-2.1.4.min.js"></script> ';
	$tbl.='<script type="text/javascript" src="'.base_url().'assets/js/jquery-ui.js"></script> ';
	$tbl.='<script type="text/javascript" src="'.base_url().'assets/js/paging.js"></script> ';
	$tbl.='<script type="text/javascript">
            $(document).ready(function() {
                $("#tableData").paging({limit:12});
            });
        </script>';
	
   $Rows = count($array_data); 
    $Cols = count($array_title) ; 
    $tbl.= '<table id="tableData" class="table table-condensed table-bordered tablesorter">';
    $tbl.= '<thead>';
    foreach($array_title as $title){
     $tbl.= '<th>'.$title.'</th>';
    }
    $tbl.= '</thead>';
    $tbl.='<tbody>';
	$record = '';
	if(is_array($array_data)){
		foreach( $array_data as $data){ 
		  $r = array_values($data);
		  $tbl.= '<tr>';
		  for($j=0;$j<=$Cols-1;$j++){
        $hasil= array_search($j,$numeric_col);
        if($hasil!=''){
				 $record = number_format( $r[$j]);
          $tbl.= '<td align="right">'.$record.'</td>'; 
         }else{
          $record =  $r[$j];
          $tbl.= '<td>'.$record.'</td>'; 
        }
		  }
		  $tbl.= '</tr>';
		}
	}else{
		$tbl.='<tr >
			<td class="bg-warning" colspan="'.$Cols.'"><div style="text-align:center">Data Not Available</div></td>		
		</tr>';	
	}
    $tbl.='</tbody>';

    $tbl.= '</table>';

    return $tbl;
}


function generate_kd_koperasi($id_kec, $id_kel){
  $ci =& get_instance();
  $ci->load->database();

  $id_provinsi = get_sys_setting ('005');
  $id_kabupaten = get_sys_setting ('006');

  $ci->db->select('id_koperasi, kd_koperasi');
  $ci->db->from('tbl_koperasi');
  $ci->db->where("id_propinsi='$id_provinsi'");
  $ci->db->where("id_kabupaten='$id_kabupaten'");
  $ci->db->where("id_kecamatan='$id_kec'");
  $ci->db->where("id_kelurahan='$id_kel'");
  $ci->db->order_by('id_koperasi DESC');
  $ci->db->limit(1,0);

  $query=$ci->db->get();
  $rows=$query->row();

  $kd_kec = '0'.$id_kel;
  $kd_kel = '0'.$id_kec;
 
  $new_kd = $id_provinsi.$id_kabupaten.$kd_kec.$kd_kel.'001';
  if($rows){
    $kd_koperasi = $rows->kd_koperasi;
    $no_urut = substr($kd_koperasi,10,3);
    $int_no_urut = (int)$no_urut;
    $incre = $int_no_urut + 1;
    $new_kd = $id_provinsi.$id_kabupaten.$kd_kec.$kd_kel.str_pad($incre, 3, "0", STR_PAD_LEFT);
  }
  return $new_kd;
}

function get_menu_by_role_id($role_id){
   $ci =& get_instance();
   $ci->load->database();
   $ci->db->select('id_user_role, b.roles_name, c.menu_label');
   $ci->db->from('sys_menu_role a');
   $ci->db->join("sys_roles b", 'a.roles_id=b.roles_id','inner');
   $ci->db->join("sys_admin_menu c", 'c.id_menu=a.id_menu', 'inner');
   $ci->db->where("b.roles_id='$role_id'");
   $query = $ci->db->get();
   $menu='';
   foreach ($query->result() as $row){
      $menu.=' <span class="badge badge-info">'.$row->menu_label.'</span>';
   }

   return $menu;
}

function format_date_as_db_format($strdate, $oriformat='d/m/Y', $db_ormat='Y-m-d'){
  $date = DateTime::createFromFormat('d/m/Y', $strdate);
  return $date->format('Y-m-d');
}

function format_date_as_id_format($strdate, $oriformat='Y-m-d'){
  $date = DateTime::createFromFormat('Y-m-d', $strdate);
  if($date){
    return $date->format('d/m/Y');
  }else{
    return '';
  }
}

function getsysdate($format="Y-m-d H:i:s"){
    date_default_timezone_set("Asia/Bangkok");
    $sysdate = date($format);
    return $sysdate;
}

function get_left_string($str, $length) {
     return substr($str, 0, $length);
}

function get_right_string($str, $length) {
     return substr($str, -$length);
}

?>