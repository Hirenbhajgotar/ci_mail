<?php 
class Image extends CI_Controller
{
    public function index()
    {
        $this->load->view('images/image');
        
    }

    public function resize()
    {
        $name_parts = pathinfo($_FILES['image_file']['name']);
        $name_full  = preg_replace('/\s+/', '', $name_parts['filename']);
        $file_name  = $name_full  . '_' . date('Ymd_ihs');

        $config['upload_path']      = './uploads';
        // $config['upload_path']      = './source_image';
        $config['file_name']        = $file_name;
        $config['allowed_types']    = 'png|bmp|jpg|jpeg';
        $config['max_size']         = '100000'; // 1MB~
        $config['overwrite']        = FALSE;

        $this->load->library('upload', $config);
        $error = '';
        if (!$this->upload->do_upload('image_file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('images/image', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $res['image'] = $data['upload_data']['file_name'];
            
            $this->load->library('image_lib');
            if (file_exists('./uploads/' . $res['image'])) {
                $args['image_library'] = 'gd2';
                $args['source_image'] = './uploads/' . $res['image'];
                $args['create_thumb'] = TRUE;
                $args['maintain_ratio'] = TRUE;
                $args['width']         = 75;
                $args['height']       = 50;

                // $this->load->library('image_lib', $args);
                $this->image_lib->initialize($args);
                if (!$this->image_lib->resize()) {
                    echo './uploads/' . $res['image'];

                    echo $this->image_lib->display_errors();
                } else {
                    $this->load->view('images/image');
                    // echo './uploads/' . $image;
                    // echo '<pre>';
                    // print_r($image);
                    // echo '</pre>';
                    // exit;
                }
            } else {
                echo 'file not exists';
            }
        }
    }

}

?>