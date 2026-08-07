<?php 
/**
 * Agenda Page Controller
 * @category  Controller
 */
class AgendaController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "agenda";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("agenda.kodeagenda", 
			"agenda.hari", 
			"agenda.tanggal", 
			"agenda.waktu", 
			"agenda.kodeguru", 
			"guru.nama AS guru_nama", 
			"agenda.kodejabatan", 
			"agenda.aktivitas", 
			"agenda.tempat"); 
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				agenda.kodeagenda LIKE ? OR 
				agenda.hari LIKE ? OR 
				agenda.tanggal LIKE ? OR 
				agenda.waktu LIKE ? OR 
				agenda.kodeguru LIKE ? OR 
				agenda.kodejabatan LIKE ? OR 
				agenda.aktivitas LIKE ? OR 
				agenda.tempat LIKE ? OR 
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "agenda/search.php";
		}
		$db->join("guru", "agenda.kodeguru = guru.kodeguru", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("agenda.kodeagenda", ORDER_TYPE);
		}
		$db->where("agenda.kodeguru", get_active_user('kodeguru') );
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->agenda_tanggal)){
			$vals = explode("-to-", str_replace(" ", "", $request->agenda_tanggal));
			$startdate = $vals[0];
			$enddate = $vals[1];
			$db->where("agenda.tanggal BETWEEN '$startdate' AND '$enddate'");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Nama : " . get_active_user('nama');
		$jabatan = $this->view->jabatan = array("agenda.kodejabatan");
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_jabatan = $jabatan;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		// Kolom yang diambil dari query tapi TIDAK ditampilkan di view (di-comment atau disembunyikan).
		// Disembunyikan juga dari export PDF & Excel supaya sesuai tampilan halaman.
		$this->view->report_hidden_fields = array('kodeagenda', 'kodeguru', 'guru_nama', 'kodejabatan');
		$this->render_view("agenda/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("agenda.kodeagenda", 
			"agenda.hari", 
			"agenda.tanggal", 
			"agenda.waktu", 
			"agenda.kodeguru", 
			"guru.nama AS guru_nama", 
			"agenda.kodejabatan", 
			"agenda.aktivitas", 
			"agenda.tempat"); 
		$db->where("agenda.kodeguru", get_active_user('kodeguru') );
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("agenda.kodeagenda", $rec_id);; //select record based on primary key
		}
		$db->join("guru", "agenda.kodeguru = guru.kodeguru", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "Lihat Aktivitas";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("agenda/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("hari","tanggal","waktu","kodeguru","kodejabatan","aktivitas","tempat");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'hari' => 'required',
				'tanggal' => 'required',
				'waktu' => 'required',
				'kodejabatan' => 'required',
				'aktivitas' => 'required',
				'tempat' => 'required',
			);
			$this->sanitize_array = array(
				'hari' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'waktu' => 'sanitize_string',
				'kodejabatan' => 'sanitize_string',
				'aktivitas' => 'sanitize_string',
				'tempat' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['kodeguru'] = USER_NAME;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("agenda");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Tambah Jurnal Aktivitas";
		$this->render_view("agenda/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("kodeagenda","hari","tanggal","waktu","kodeguru","kodejabatan","aktivitas","tempat");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'hari' => 'required',
				'tanggal' => 'required',
				'waktu' => 'required',
				'kodejabatan' => 'required',
				'aktivitas' => 'required',
				'tempat' => 'required',
			);
			$this->sanitize_array = array(
				'hari' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'waktu' => 'sanitize_string',
				'kodejabatan' => 'sanitize_string',
				'aktivitas' => 'sanitize_string',
				'tempat' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['kodeguru'] = USER_NAME;
			if($this->validated()){
		$db->where("agenda.kodeguru", get_active_user('kodeguru') );
				$db->where("agenda.kodeagenda", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("agenda");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("agenda");
					}
				}
			}
		}
		$db->where("agenda.kodeguru", get_active_user('kodeguru') );$db->where("agenda.kodeagenda", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit Aktivitas";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("agenda/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("kodeagenda","hari","tanggal","waktu","kodeguru","kodejabatan","aktivitas","tempat");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'hari' => 'required',
				'tanggal' => 'required',
				'waktu' => 'required',
				'kodejabatan' => 'required',
				'aktivitas' => 'required',
				'tempat' => 'required',
			);
			$this->sanitize_array = array(
				'hari' => 'sanitize_string',
				'tanggal' => 'sanitize_string',
				'waktu' => 'sanitize_string',
				'kodejabatan' => 'sanitize_string',
				'aktivitas' => 'sanitize_string',
				'tempat' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		$db->where("agenda.kodeguru", get_active_user('kodeguru') );
				$db->where("agenda.kodeagenda", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("agenda.kodeagenda", $arr_rec_id, "in");
		$db->where("agenda.kodeguru", get_active_user('kodeguru') );
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("agenda");
	}
}
