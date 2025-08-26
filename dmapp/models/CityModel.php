<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CityModel extends CI_Model
{

    public function insertCity()
    {
        $status = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $user_id = $this->session->userdata('user_id');

            $data = array(
                'country_id' => $this->input->post('country_id'),
                'state_id' => $this->input->post('state_id'),
                'city_name' => trim($this->input->post('city_name')),
                'city_short_name' => trim($this->input->post('city_short_name')),
                'city_status' => $this->input->post('city_status'),
                'create_date' => date('Y-m-d H:i:s'),
                'created_by' => $user_id,
                'update_date' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id,
            );

            if ($this->db->insert('city', $data)) {
                $city_id = $this->db->insert_id();
                $this->insertCityAreas($city_id);
                $status = "1"; 
            } else {
                $status = "0"; 
            }
        }
        return $status;
    }

    private function insertCityAreas($city_id)
    {
        $city_area_names = $this->input->post('city_area_names');
        if (!empty($city_area_names)) {
            $areas = explode(',', $city_area_names);
            foreach ($areas as $area_name) {
                $area_name = trim($area_name);
                if (!empty($area_name)) {
                    $area_data = array(
                        'city_id' => $city_id,
                        'country_id' => $this->input->post('country_id'), 
                        'city_area_name' => $area_name,
                        'create_date' => date('Y-m-d H:i:s'),
                        'update_date' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('city_area', $area_data);
                }
            }
        }
    }

    public function updateCity()
    {
        $status = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $user_id = $this->session->userdata('user_id');
            $city_id = $this->input->post('city_id');

            $data = array(
                'country_id' => $this->input->post('country_id'),
                'state_id' => $this->input->post('state_id'),
                'city_name' => $this->input->post('city_name'),
                'city_short_name' => $this->input->post('city_short_name'),
                'city_status' => $this->input->post('city_status'),
                'update_date' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id,
            );

            $this->db->where('city_id', $city_id);
            if ($this->db->update('city', $data)) {
                $status = "1"; 
            } else {
                $status = "0"; 
            }
        }
        return $status;
    }

    public function deleteCity($cityId)
    {
        $status = "";
        if ($cityId != "") {
            $this->db->where('city_id', $cityId);
            if ($this->db->delete('city')) {
                $status = "1"; 
            } else {
                $status = "0"; 
            }
        }
        return $status;
    }

    public function insertCityArea($country_id, $city_id, $city_area_name)
    {
        $data = array(
            'country_id' => $country_id,
            'city_id' => $city_id,
            'city_area_name' => $city_area_name,
            'create_date' => date('Y-m-d H:i:s'),
            'update_date' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('city_area', $data);
    }

    public function updateCityArea($city_area_id, $country_id, $city_id, $city_area_name)
    {
        $data = array(
            'country_id' => $country_id,
            'city_id' => $city_id,
            'city_area_name' => $city_area_name,
            'update_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('city_area_id', $city_area_id);
        return $this->db->update('city_area', $data);
    }

    public function deleteCityArea($city_area_id)
    {
        $this->db->where('city_area_id', $city_area_id);
        return $this->db->delete('city_area');
    }
    public function getCityAreasByCityId($cityId)
    {
        $this->db->where('city_id', $cityId);
        return $this->db->get('city_area')->result();
    }

    public function getCityById($cityId)
    {
        $this->db->where('city_id', $cityId);
        return $this->db->get('city')->row(); 
    }

    public function deleteCityAreasByCityId($cityId)
    {
        $this->db->where('city_id', $cityId);
        return $this->db->delete('city_area'); 
    }

    public function check_state_exists($city_name, $city_short_name, $country_id, $city_id = null) {
        $this->db->where('city_short_name', $city_short_name);
        if ($city_id) {
            $this->db->where('city_id !=', $city_id);
        }
        $short_name_query = $this->db->get('city');
        $this->db->where('city_name', $city_name);
        $this->db->where('country_id', $country_id);

        if ($city_id) {
            $this->db->where('city_id !=', $city_id);  
        $query = $this->db->get('city');
        if ($query->num_rows() > 0) {
            return 1;
        }
    
        if ($short_name_query->num_rows() > 0) {
            return 2; 
        }
        return false; 
    }
}

}