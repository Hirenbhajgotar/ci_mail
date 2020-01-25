<?php
// defined('BASEPATH') or exit('No direct script access allowed');
// defined('BASEPATH') or show_404();
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class User extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required');
        $this->form_validation->set_error_delimiters("<span class='text-danger text-small'><small>", "</small></span>");
        if ($this->form_validation->run() === false) {
            $this->load->view("user/register");
        } else {
            // echo 'run';

            $this->load->library("email");
            $config['protocol'] = 'smtp';
            $config['mailpath'] = '/usr/sbin/sendmail';
            // $config['charset'] = 'iso-8859-1';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);
            $this->email->from('bhajgotar8918514@gmail.com', 'Hiren');
            $this->email->to($this->input->post('email'));

            $this->email->subject('User registration');
            $this->email->message('Testing the email class.');
            $this->email->attach(base_url("assets/image/adult-book-business-297755.jpg"));

            if ($this->email->send()) {
                // redirect('/','refresh');
               echo 'email has been sent';
            } else {
                show_error($this->email->print_debugger());
            }

            
            
        }

    }
}

?>