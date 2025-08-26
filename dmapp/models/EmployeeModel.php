<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmployeeModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // List employees with optional filters (gender, city)
    public function getEmployees($filters = [])
    {
        if (!empty($filters['gender'])) {
            $this->db->where('gender', $filters['gender']);
        }
        if (!empty($filters['city'])) {
            $this->db->where('city', $filters['city']);
        }
        $this->db->order_by('name', 'ASC');
        return $this->db->get('employee')->result();
    }

    // Distinct city list for filters
    public function getDistinctCities()
    {
        $this->db->distinct();
        $this->db->select('city');
        $this->db->where('city !=', '');
        $this->db->order_by('city', 'ASC');
        $result = $this->db->get('employee')->result();
        return $result;
    }

    public function getById($employeeId)
    {
        $this->db->where('employee_id', $employeeId);
        return $this->db->get('employee')->row();
    }

    public function isDuplicateEmail($email, $employeeId = null)
    {
        $this->db->where('email', $email);
        if ($employeeId) {
            $this->db->where('employee_id !=', $employeeId);
        }
        return $this->db->get('employee')->num_rows() > 0;
    }

    public function insertEmployee()
    {
        $status = '0';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = [
                'name'        => trim($this->input->post('name')),
                'email'       => trim($this->input->post('email')),
                'phone'       => trim($this->input->post('phone')),
                'gender'      => trim($this->input->post('gender')),
                'city'        => trim($this->input->post('city')),
                'create_date' => date('Y-m-d H:i:s'),
                'update_date' => date('Y-m-d H:i:s'),
            ];

            if ($this->db->insert('employee', $data)) {
                $status = '1';
            }
        }
        return $status;
    }

    public function updateEmployee()
    {
        $status = '0';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $employeeId = $this->input->post('employee_id');
            $data = [
                'name'        => trim($this->input->post('name')),
                'email'       => trim($this->input->post('email')),
                'phone'       => trim($this->input->post('phone')),
                'gender'      => trim($this->input->post('gender')),
                'city'        => trim($this->input->post('city')),
                'update_date' => date('Y-m-d H:i:s'),
            ];
            $this->db->where('employee_id', $employeeId);
            if ($this->db->update('employee', $data)) {
                $status = '1';
            }
        }
        return $status;
    }

    public function deleteEmployee($employeeId)
    {
        $this->db->where('employee_id', $employeeId);
        return $this->db->delete('employee');
    }
}