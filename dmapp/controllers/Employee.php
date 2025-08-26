<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('EmployeeModel');
        $this->load->helper(['url','form']);
    }

    public function index()
    {
        $filters = [
            'gender' => $this->input->get('gender'),
            'city'   => $this->input->get('city'),
        ];

        $data['title'] = 'Employees';
        $data['employees'] = $this->EmployeeModel->getEmployees($filters);
        $data['selected_gender'] = $filters['gender'];
        $data['selected_city'] = $filters['city'];
        $data['cities'] = $this->EmployeeModel->getDistinctCities();

        $this->load->view('employee_list', $data);
    }

    // Create/edit form
    public function form($id = null)
    {
        $data = [
            'title' => $id ? 'Edit Employee' : 'Add Employee',
            'formAction' => $id ? 'employee/update' : 'employee/create',
            'employee_id' => '',
            'name'  => '',
            'email' => '',
            'phone' => '',
            'gender'=> '',
            'city'  => '',
        ];

        if ($id) {
            $emp = $this->EmployeeModel->getById($id);
            if ($emp) {
                $data['employee_id'] = $emp->employee_id;
                $data['name'] = $emp->name;
                $data['email'] = $emp->email;
                $data['phone'] = $emp->phone;
                $data['gender'] = $emp->gender;
                $data['city'] = $emp->city;
            }
        }

        $this->load->view('employee_form', $data);
    }

    // Create
    public function create()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $email = trim($this->input->post('email'));
            $disallowed_domains = ['example.com', 'test.com', 'company.com']; // Add company domains here
            $domain = substr(strrchr($email, "@"), 1);

            if (in_array($domain, $disallowed_domains)) {
                redirect('employee/form?error=company_email');
                return;
            }

            if ($this->EmployeeModel->isDuplicateEmail($email)) {
                redirect('employee/form?error=duplicate_email');
                return;
            }

            $res = $this->EmployeeModel->insertEmployee();
            redirect('employee' . ($res ? '?success' : '?failure'));
        }
        redirect('employee');
    }

    // Update
    public function update()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $employee_id = $this->input->post('employee_id');
            $email = trim($this->input->post('email'));
            $disallowed_domains = ['example.com', 'test.com', 'company.com']; // Add company domains here
            $domain = substr(strrchr($email, "@"), 1);

            if (in_array($domain, $disallowed_domains)) {
                redirect('employee/form/' . $employee_id . '?error=company_email');
                return;
            }

            if ($this->EmployeeModel->isDuplicateEmail($email, $employee_id)) {
                redirect('employee/form/' . $employee_id . '?error=duplicate_email');
                return;
            }

            $res = $this->EmployeeModel->updateEmployee();
            redirect('employee' . ($res ? '?upsuccess' : '?upfailure'));
        }
        redirect('employee');
    }

    // Delete
    public function delete($id)
    {
        $this->EmployeeModel->deleteEmployee($id);
        redirect('employee?deleted');
    }

    public function ajax_check_email()
    {
        $email = trim($this->input->post('email'));
        $employee_id = trim($this->input->post('employee_id'));
        $disallowed_domains = ['example.com', 'test.com', 'company.com'];
        $domain = substr(strrchr($email, "@"), 1);

        if (in_array($domain, $disallowed_domains)) {
            echo json_encode('Company emails are not allowed.');
            return;
        }

        if ($this->EmployeeModel->isDuplicateEmail($email, $employee_id)) {
            echo json_encode('This email address is already in use.');
            return;
        }

        echo json_encode(true);
    }
}