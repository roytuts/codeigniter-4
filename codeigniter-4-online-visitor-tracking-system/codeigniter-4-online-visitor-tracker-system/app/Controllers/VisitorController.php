<?php

namespace App\Controllers;

use App\Models\VisitorModel;

class VisitorController extends BaseController {
	
	private $model;
	
	public function __construct() {
		helper(['visitor']);
        $this->model = new VisitorModel();
    }
	
	public function index() {		
        $site_statics_today = $this->model->get_site_data_for_today();
        $site_statics_last_week = $this->model->get_site_data_for_last_week();
        $data['visits_today'] = isset($site_statics_today['visits']) ? $site_statics_today['visits'] : 0;
        $data['visits_last_week'] = isset($site_statics_last_week['visits']) ? $site_statics_last_week['visits'] : 0;
		$chart_data_today = $this->model->get_chart_data_for_today();
		$chart_data_curr_month = $this->model->get_chart_data_for_month_year();
        $data['chart_data_today'] = isset($chart_data_today) ? $chart_data_today : array();
        $data['chart_data_curr_month'] =  isset($chart_data_curr_month) ? $chart_data_curr_month : array();
        
		return view('visitor', $data);
    }

    function get_chart_data() {
        if (isset($_POST)) {
            if (isset($_POST['month']) && strlen($_POST['month']) && isset($_POST['year']) && strlen($_POST['year'])) {
                $month = $_POST['month'];
                $year = $_POST['year'];
                $data = $this->model->get_chart_data_for_month_year($month, $year);
				
                if ($data !== NULL) {
                    foreach ($data as $value) {
                        echo $value->day . "t" . $value->visits . "n";
                    }
                } else {
                    $timestamp = mktime(0, 0, 0, $month);
                    $label = date("F", $timestamp);
                    echo '<div style="width:600px;position:relative;font-weight:bold;top:100px;margin-left:auto;margin-left:auto;color:red;">No data found for the "' . $label . '-' . $year . '"</div>';
                }
            } else if (isset($_POST['month']) && strlen($_POST['month'])) {
                $month = $_POST['month'];
                $data = $this->model->get_chart_data_for_month_year($month);
				
                if ($data !== NULL) {
                    foreach ($data as $value) {
                        echo $value->day . "t" . $value->visits . "n";
                    }
                } else {
                    $timestamp = mktime(0, 0, 0, $month);
                    $label = date("F", $timestamp);
                    echo '<div style="width:600px;position:relative;font-weight:bold;top:100px;margin-left:auto;margin-left:auto;color:red;">No data found for the "' . $label . '"</div>';
                }
            } else if (isset($_POST['year']) && strlen($_POST['year'])) {
                $year = $_POST['year'];
                $data = $this->model->get_chart_data_for_month_year(0, $year);
                if ($data !== NULL) {
                    foreach ($data as $value) {
                        echo $value->day . "t" . $value->visits . "n";
                    }
                } else {
                    echo '<div style="width:600px;position:relative;font-weight:bold;top:100px;margin-left:auto;margin-left:auto;color:red;">No data found for the "' . $year . '"</div>';
                }
            } else {
                $data = $this->model->get_chart_data_for_month_year();
                if ($data !== NULL) {
                    foreach ($data as $value) {
                        echo $value->day . "t" . $value->visits . "n";
                    }
                } else {
                    echo '<div style="width:600px;position:relative;font-weight:bold;top:100px;margin-left:auto;margin-left:auto;color:red;">No data found!</div>';
                }
            }
        }
    }
}
