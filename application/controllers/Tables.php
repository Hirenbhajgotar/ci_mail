<?php 
class Tables extends CI_Controller
{
    public function index()
    {
        $this->load->library('db_tables');
        $this->db_tables->get_tables();
        // echo defined('TAB3');
        // echo defined('TAB2');
        echo TAB1 . "<br>";
        echo TAB2 . "<br>";
        echo TAB3 . "<br>";
    }
}

?>