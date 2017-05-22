<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    /**
     *
     */
    use HelperFunctionsTrait;
    /**
     * 
     */
    use CallerTrait;

    /**
     * @var array $models
     */
    private $models = [];
    /**
     * @var array $data
     */
    protected $data;
    /**
     * @var array $add_css
     */
    protected $add_css;
    /**
     * @var array $add_js
     */
    protected $add_js;

    /**
     * MY_Controller constructor.
     */
    public function __construct()
    {
        parent::__construct();
        
        if ($this->session->isLoggedIn == true) {

            $user_id = $this->session->UserLoggedId;

            $this::model('User')->lastVisit($user_id);
        }
    }
    
    /**
     * method checkTotal
     * @param int $id
     * @return int $remainder
     */
    public function checkTotal($id){
        $top_up = $this->model('Payment')->allWhere(['client_id' => $id, 'type' => 'top_up']);
        $pay = $this->model('Payment')->allWhere(['client_id' => $id, 'type' => 'pay']);
        $enter = 0;
        $exit = 0;
        foreach ($top_up as $item){
            $enter += $item->amount;
        }
        foreach ($pay as $item){
            $exit += $item->amount;
        }
        $remainder = $enter - $exit;
        return $remainder;
    }
    
    /**
     * @param $category_slug
     * @param $offset
     * @param $favorite_experts
     * @return array
     */
    public function getExpertList($category_slug = false,$offset = false,$favorite_experts = false,$one_by_id = false){

        $where_in = [];
        $where = [
            'users.type'    => 'expert',
            'users.status'  => 1
        ];

        if($category_slug){
            $where['expert_categories.category_slug']=$category_slug;
        }

        if($favorite_experts){
            $where_in = $favorite_experts;
            $where = [];
        }

        if($one_by_id){
            $where = [];
            $where['expert_id'] = $one_by_id;
        }


        $this->data['experts_list'] = $this::model('ExpertsInfo')->getExperts(
            [
                'expert_id',
                'short_description',
                'bried_description',
                'mail_price',
                'name',
                'image',
                'expert_type',
                'screen_name',
                'users.updated_day',
                'category_slug',
                'category_name',
                'expert_status',
                'degrees',
                'bried_description',
                'services',
                'expert_qualifications',
                'chat_price'
            ],
            $where,
            $offset,
            $where_in,
            [
                'field' => 'expert_order',
                'direction' => 'asc'
            ]
        );

        foreach ($this->data['experts_list'] as $key=> $expert){

            $this->data['experts_list'][$key]->starRate = $this::model('Feedback')->getStarsRate($expert->expert_id);

            $onClass = 'offImg';
            $available = 2;

           $blocksArray = $this::model('Block')->SelectWhere('client_id',['expert_id'=>$expert->expert_id]);

//

            $blocks =  [];

            if(count($blocksArray) > 0){

                foreach ($blocksArray as $value){

                    $blocks[]= $value->client_id ;

                }
            }


            $this->data['experts_list'][$key]->block_users =$blocks;
            

            if($this->data['experts_list'][$key]->expert_status == 1){

                $now = date("Y-m-d H:i:s");
                $last_visit = $expert->updated_day;

                $obj_now = new DateTime($now);
                $obj_last = new DateTime($last_visit);
                $interval = $obj_now->diff($obj_last);

                if ($interval->format("%H:%I:%S") < '00:05:00') {
                    $onClass = 'onImg';
                    $available = 1;
                } else {
                    $onClass = 'offImg';
                }
            }elseif ($this->data['experts_list'][$key]->expert_status == 3){
                $available = 3;
            }

            $this->data['experts_list'][$key]->onClass = $onClass;
            $this->data['experts_list'][$key]->available = $available;
        }


        return $this->data['experts_list'];

    }
    
}