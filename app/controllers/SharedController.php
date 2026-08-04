<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * agenda_kodejabatan_option_list Model Action
     * @return array
     */
	function agenda_kodejabatan_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT namajabatan AS value,namajabatan AS label FROM jabatan";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * agenda_kelas_option_list Model Action
     * @return array
     */
	function agenda_kelas_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT kelas AS value,kelas AS label FROM kelas";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * guru_kodeguru_value_exist Model Action
     * @return array
     */
	function guru_kodeguru_value_exist($val){
		$db = $this->GetModel();
		$db->where("kodeguru", $val);
		$exist = $db->has("guru");
		return $exist;
	}

	/**
     * guru_email_value_exist Model Action
     * @return array
     */
	function guru_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("guru");
		return $exist;
	}

	/**
     * guru_user_role_id_option_list Model Action
     * @return array
     */
	function guru_user_role_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_guru Model Action
     * @return Value
     */
	function getcount_guru(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM guru";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_kelas Model Action
     * @return Value
     */
	function getcount_kelas(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM kelas";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_jabatan Model Action
     * @return Value
     */
	function getcount_jabatan(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM jabatan";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_agenda Model Action
     * @return Value
     */
	function getcount_agenda(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM agenda";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
