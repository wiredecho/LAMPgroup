<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Box extends CI_Model{

    function recent_activity(){
        $query = $this->db->query("SELECT box.title, user.screenname, user.id FROM box LEFT JOIN user ON box.user_id=user.id");
        return $query->result_array();
    }
}