<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class UserController
 */
class PagesController extends MY_Controller
{
    /**
     * PagesController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->set_css(array(
            'style',
            'bootstrap',
            'bootstrap-theme',
            'modal',
            'admin'
        ));

        $this->set_js(array(
            'bootstrap',
            'sitejs',
            'siteAjax'
        ));
    }

    /**
     * method about
     */
    public function about()
    {
        $this->data['page']='pages/about';
        $this->load->view('site/layouts/content',$this->data);
    }

    /**
     * method about
     */
    public function overview()
    {
        $this->data['page']='pages/overview';
        $this->load->view('site/layouts/content',$this->data);
    }

    /**
     * method about
     */
    public function howItWorks()
    {
        $this->data['page']='pages/howItWorks';
        $this->load->view('site/layouts/content',$this->data);
    }

    /**
     * method about
     */
    public function needHelp()
    {
        $this->data['page']='pages/needHelp';
        $this->load->view('site/layouts/content',$this->data);
    }

    /**
     * method about
     */
    public function questions()
    {
        $this->data['page']='pages/questions';
        $this->load->view('site/layouts/content',$this->data);
    }

    /**
     * @param int $id
     */
    public function getOneExpertById($id){

        if(!empty($id)) {

            $expert = $this->getExpertList('','','',$id);

            if(!empty($expert)){

            $this->data['expert'] = $expert[0];

            $this->data['expert_favorite_client'] = $this::model('FavoriteList')->oneSelectWhere(
                ['client_id'],
                [
                    'expert_id' => $id,
                    'client_id' => $this->session->userdata('UserLoggedId')
                ]
            );

            $this->data['feedback'] = $this->model('Feedback')->getExpertFeedback($id);

            $this->data['reviews'] = count($this::model('Feedback')->allWhere(['to_id' => $id]));
            $this->data['expert']->starRate = $this::model('Feedback')->getStarsRate($id);

            $this->data['page'] = 'expert-profile';
            $this->load->view('site/layouts/content', $this->data);
            }else{
                return redirect('/');
            }
        }
    }

    /**
     * @param $category_slug
     */
    public function specializeExperts($category_slug){
        
        if(!empty($category_slug)){

            $this->getExpertList($category_slug);
            
        

            $this->data['slug'] = $category_slug;

            $this->data['page'] = 'expert-specialize';
            $this->load->view('site/layouts/content', $this->data);
            
        }else{
            $this->back();
        }
        
    }
}