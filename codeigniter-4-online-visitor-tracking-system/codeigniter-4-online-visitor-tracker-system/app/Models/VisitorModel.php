<?php

namespace App\Models;
use CodeIgniter\Model;

class VisitorModel extends Model {

	protected $table = 'visitors';
	
	function get_site_data_for_today() {
        $results = array();
        
		$query = $this->db->query('SELECT SUM(no_of_visits) as visits 
            FROM ' . $this->table . ' 
            WHERE CURDATE()=DATE(access_date)
            LIMIT 1');
			
        if ($query->resultID->num_rows == 1) {
            $row = $query->getRow();
            $results['visits'] = $row->visits;
        }

        return $results;
    }

    function get_site_data_for_last_week() {
        $results = array();
		
        $query = $this->db->query('SELECT SUM(no_of_visits) as visits
            FROM ' . $this->table . '
            WHERE DATE(access_date) >= CURDATE() - INTERVAL DAYOFWEEK(CURDATE())+6 DAY
            AND DATE(access_date) < CURDATE() - INTERVAL DAYOFWEEK(CURDATE())-1 DAY 
            LIMIT 1');
			
        if ($query->resultID->num_rows == 1) {
            $row = $query->getRow();
            $results['visits'] = $row->visits;

            return $results;
        }
    }

    function get_chart_data_for_today() {
        $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(access_date,"%h %p") AS hour
                FROM ' . $this->table . '
                WHERE CURDATE()=DATE(access_date)
                GROUP BY HOUR(access_date)');
				
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        }
		
        return NULL;
    }

    function get_chart_data_for_month_year($month = 0, $year = 0) {
        if ($month == 0 && $year == 0) {
            $month = date('m');
            $year = date('Y');
			
            $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(access_date,"%d-%m-%Y") AS day 
                FROM ' . $this->table . '
                WHERE MONTH(access_date)=' . $month . '
                AND YEAR(access_date)=' . $year . '
                GROUP BY DATE(access_date)');
            
			if ($query->resultID->num_rows > 0) {
                return $query->getResult();
            }
        }
		
        if ($month == 0 && $year > 0) {
            $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(timestamp,"%M") AS day
                FROM ' . $this->table . '
                WHERE YEAR(access_date)=' . $year . '
                GROUP BY MONTH(access_date)');
            
			if ($query->resultID->num_rows > 0) {
                return $query->getResult();
            }
        }
		
        if ($year == 0 && $month > 0) {
            $year = date('Y');
			
            $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(access_date,"%d-%m-%Y") AS day
                FROM ' . $this->table . '
                WHERE MONTH(access_date)=' . $month . '
                AND YEAR(access_date)=' . $year . '
                GROUP BY DATE(access_date)');
				
            if ($query->resultID->num_rows > 0) {
                return $query->getResult();
            }
        }

        if ($year > 0 && $month > 0) {
            $query = $this->db->query('SELECT SUM(no_of_visits) as visits,
                DATE_FORMAT(access_date,"%d-%m-%Y") AS day
                FROM ' . $this->table . '
                WHERE MONTH(access_date)=' . $month . '
                AND YEAR(access_date)=' . $year . '
                GROUP BY DATE(access_date)');
				
            if ($query->resultID->num_rows > 0) {
                return $query->getResult();
            }
        }

        return NULL;
    }
	
}