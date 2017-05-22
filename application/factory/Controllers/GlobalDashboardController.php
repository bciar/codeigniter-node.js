<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class GlobalAdminController
 */
class GlobalDashboardController extends MY_Controller
{
    /**
     * @var
     */
    public $user_id;
    /**
     * @var
     */
    public $logged_in;

    /**
     * GlobalAdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->set_css(array(
            'datatables',
            'style',
            'bootstrap',
            'bootstrap-theme',
            'modal',
            'admin',
        ));

        $this->set_js(array(
            'bootstrap',
            'img-crop',
            'jquery.dataTables',
            'dashboard',
            'sitejs',
            'siteAjax',
        ));

        $this->logged_in  = $this->session->userdata('isLoggedIn');
        $this->user_id    = $this->session->userdata('UserLoggedId');

        if(empty($this->logged_in) || empty($this->user_id) ){
            redirect(base_url());
        }
    }
}