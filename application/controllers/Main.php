<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{

    public function index(){    
        $config['center'] = 'Denver, Co';
        $config['zoom'] = 2;
        $this->googlemaps->initialize($config);

        $locations = $this->user->get_location();
        
        foreach($locations as $location){
            $marker = array();
            $marker['position'] = $location["city"] . ", " . $location["state"];
            $marker['animation'] = 'DROP';
            // $marker['onclick'] = 
            $this->googlemaps->add_marker($marker);
        }

        $map = $this->googlemaps->create_map();
        $locations = $this->user->get_location();
        $countries = $this->user->distinct_country();
        $activities = $this->box->recent_activity();
        $this->load->view('homepage', array(
        				'map' => $map,
        				'locations' => $locations,
        				'countries' => $countries,
        				'activities' => $activities));
    }

    public function user_profile($id){
        $user = $this->user->view_user_by_id($id);
        $this->load->view("profile", array('user' => $user));

    }

}