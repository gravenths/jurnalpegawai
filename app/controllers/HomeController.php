<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends SecureController{
	function index(){
    $db = $this->GetModel();
    $fields = array("hari", "tanggal", "waktu", "aktivitas", "tempat");
    $db->orderBy("agenda.tanggal", "desc");
    $db->orderBy("agenda.waktu", "desc");
    $recent_activities = $db->get("agenda", 5, $fields);

    $data = new stdClass;
    $data->recent_activities = $recent_activities;
    $this->render_view("home/index.php" , $data , "main_layout.php");
}
}