<?php 
/**
 * Rekap_agenda Page Controller
 * @category  Controller
 */
class Rekap_agendaController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "agenda";
	}
	/**
     * Custom list page
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;	
		$sqltext = "Select SQL_CALC_FOUND_ROWS  * From agenda";
		$queryparams = null;
		$fields = array("agenda.kodeagenda", 
			"agenda.hari",
			"agenda.tanggal",
			"agenda.waktu", 
			"agenda.kodeguru", 
			"agenda.kodejabatan", 
			"agenda.aktivitas", 
			"agenda.tempat", 
			"guru.kodeguru AS guru_kodeguru");
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
				agenda.tempat LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "rekap_agenda/search.php";
		}

		$tc = $db->withTotalCount();
		$records = $db->query($sqltext, $pagination, $queryparams);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = (!empty($pagination) ? $pagination[1] : 1);
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Rekap Jurnal Aktivitas Pegawai";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("rekap_agenda/list.php", $data); //render the full page
	}
}
