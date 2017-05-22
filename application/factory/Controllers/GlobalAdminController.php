<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class GlobalAdminController
 */
class GlobalAdminController extends MY_Controller
{
    /**
     * GlobalAdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

    /**
     *
     */
    public function checkLogin(){
        
        $logged_in  = $this->session->userdata('isLoggedIn');
        $userType   = $this->session->userdata('UserType');

        if($logged_in != true || $userType == ''){
            redirect('admin');
        }
        
    }
    
    
    
}