<?php
defined('BASEPATH') OR exit('No direct script access allowed');

trait HelperFunctionsTrait
{
    /**
     * model method
     * Alias of load->model() method (cane be called statically)
     * @param string $name
     * @return MY_Model
     * */
    protected function model($name)
    {
        if (!array_key_exists($name . "Model", $this->models)) {
            $this->load->model($name . "Model");
            $this->models[$name . "Model"] = $this->{$name . "Model"};
        }
        return $this->models[$name . "Model"];
    }

    /**
     * method requestMethod
     * @return bool
     * */
    protected function requestMethod()
    {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            ? (isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) . "Ajax" : null)
            : (isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : null);
    }

    /**
     * isRequest method
     * @param string $key
     * @return bool
     * */
    protected function isRequest($key)
    {
        switch (strtolower($key)) {
            case "ajax":
                return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? true : false;
                break;
            default:
                return $_SERVER['REQUEST_METHOD'] == $key ? true : false;
                break;
        }
    }

    /**
     * method set_css
     * @param $data ;
     * @return array();
     * @functionality Setting Css in Header Part, By Array;
     */
    public function set_css($data)
    {
        $this->data['css'] = $data;
    }

    /**
     * method set_js
     * @param $data ;
     * @return array();
     * @functionality Setting js in Header Part, By Array;
     */
    public function set_js($data)
    {
        $this->data['js'] = $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function validate($data)
    {
        $this->load->library('form_validation');
        $count = sizeof($data);

        for ($i = 0; $i < $count; $i++) {
            $this->form_validation->set_rules($data[$i][0], $data[$i][1], $data[$i][2]);
        }

        return $this->form_validation->run();

    }

    /**
     * json method
     * @param array|object $data
     * @param string $status
     * @param string $message
     * @return json
     * */
    protected function json($data, $status = "success", $message = "")
    {
        return json_encode([
            'response' => $data,
            'status' => $status,
            'message' => $message
        ]);
    }

    /**
     * method image_resizing
     * @param $file_name ;
     * @return boolean;
     * @functionality Getting Images and resizing uploading and resizing
     */
    public function image_resizing($file_name)
    {

        $config['upload_path'] = FCPATH . './assets/site/site-images/originalimages';
        $config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
        $config['max_size'] = 10000;
        $config['max_width'] = 3600;
        $config['max_height'] = 1900;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);


        if ($this->upload->do_upload($file_name)) {

            $image_data = $this->upload->data();
            //dp($image_data,true);
            $config = array(

                array(
                    'image_library' => 'gd2',
                    'source_image' => $image_data['full_path'],
                    'new_image' => FCPATH . './assets/site/site-images/mediumimages',
                    'maintain_ratio' => TRUE,
                    'width' => 500,
                    'height' => 300,
                ),


                array(
                    'image_library' => 'gd2',
                    'source_image' => $image_data['full_path'],
                    'new_image' => FCPATH . './assets/site/site-images/thumbimages',
                    'maintain_ratio' => TRUE,
                    'width' => 300,
                    'height' => 150,
                ),

            );

            $count = sizeof($config);
            $this->load->library('image_lib', $config);

            for ($i = 0; $i < $count; $i++) {
                $this->image_lib->initialize($config[$i]);
                $this->image_lib->resize();
            }
            $this->session->set_flashdata('success', 'bomba');
            
            $data = array('upload_data' => $this->upload->data());


        }
        return TRUE;

    }

    /**
     * @param null $key
     * @return array|mixed
     */
    protected function _getData($key = null)
    {
        return !is_null($key)
            ? @$this->data[$key]
            : $this->data;
    }

    /**
     * @param $keyOrArray
     * @param mixed $value
     * @return void
     */
    protected function _setData($keyOrArray, $value = null)
    {
        if(is_array($keyOrArray)){
            foreach ($keyOrArray as $kay => $value){
                $this->_setData($kay, $value);
            }
        }
        else
        {
            $this->data[$keyOrArray] = $value;
        }
    }


    /**
     *
     */
    public function back(){
        
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function timeAgo($time_ago)
    {
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );

        // Seconds
        if ($seconds <= 60) {
            return "just now";
        }
        //Minutes
        else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if ($hours <= 24) {
            if ($hours == 1) {
                return "an hour ago";
            } else {
                return "$hours hrs ago";
            }
        }
        //Days
        else if ($days <= 7) {
            if ($days == 1) {
                return "yesterday";
            } else {
                return "$days days ago";
            }
        }
        //Weeks
        else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        }
        //Months
        else if ($months <= 12) {
            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months months ago";
            }
        }
        //Years
        else {
            if ($years == 1) {
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }

}
