<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ExpertDashboardController
 */
class ExpertDashboardController extends GlobalDashboardController
{
    /**
     * @var 
     */
    protected  $expert_id;
    
    /**
     * ExpertDashboardController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->expert_id = $this->session->userdata('UserLoggedId');
    }

    /**
     * method expertSkillView
     */
    public function expertSkillView(){

        $expert = $this::model('ExpertsInfo')->oneSelectWhere(
            ['short_description','bried_description','services','degrees','expert_qualifications','expert_type'],
            ['expert_id' => $this->expert_id]
        );

        $categories = $this::model('ExpertCategories')->oneById($expert->expert_type);

        $this->data['expert_info'] = $expert;
        $this->data['expert_info']->category_name = $categories->category_name;

        $this->data['expert_category'] = $this::model('ExpertCategories')->all();
        $this->data['page']="expert/skills-experience";
        $this->load->view('site/layouts/content',$this->data);

    }

    /**
     *  method expertSkill
     */
    public function expertSkill(){

        $validate=array(
            array('short_description','Short description','required|min_length[4]|max_length[1500]|xss_clean|trim'),
            array('bried_description','Bried description','required|min_length[4]|max_length[1500]|xss_clean|trim'),
            array('services','Services','required|min_length[4]|max_length[1500]|xss_clean|trim'),
            array('degrees','Degrees','required|min_length[5]|max_length[1500]|xss_clean|trim'),
            array('expert_qualifications','Expert/Qualifications','required|min_length[5]|max_length[1500]|xss_clean|trim'),
            array('expert_type','Category List','required|xss_clean|trim'),
        );

        if(!$this->validate($validate)){

            $this->session->set_flashdata('errors', validation_errors());

            redirect('dashboard');

        } else {

            $data = $this->input->post();

            $this::model('ExpertsInfo')->updateWhere(['expert_id'=>$this->expert_id],[
                'short_description'      => $data['short_description'],
                'bried_description'      => $data['bried_description'],
                'services'               => $data['services'],
                'degrees'                => $data['degrees'],
                'expert_qualifications'  => $data['expert_qualifications'],
                'expert_type'            => $data['expert_type']
            ]);

            $this->session->set_flashdata('success', 'Information Successfully Updated');

            redirect('skills-experience');

        }
    }

    /**
     * method messageList
     */
    public function messageList()
    {
        $client_type = $this->session->userdata('UserType');

        if ($client_type === "expert") {
            $this->data['page'] = 'expert/messages-list';
            $this->load->view('site/layouts/content', $this->_getData());
        } else {
            exit("Oops sorry you are not expert");
        }
    }
    

    /**
     * method chatPriceChange
     * @return View
     */
    public function chatPriceChange(){
        $validate=array(
            array('chat_price','Chat Price','required|max_length[1200]|trim'),
        );

        if($this->validate($validate)) {

            $chat_price =  $this->input->post('chat_price');

            $this::model('ExpertsInfo')->updateWhere(['expert_id' => $this->expert_id],['chat_price'=>$chat_price]);

        }

        redirect('dashboard');
    }

    /**
     * method expertStatusChange
     * @return View
     */
    public function expertStatusChange(){

        $status =  $this->input->post('expert-status');

        $this::model('ExpertsInfo')->updateWhere(['expert_id' => $this->expert_id],['expert_status'=>$status]);

        redirect('dashboard');
    }

    /**
     * method messages
     * @param $id
     * @param $sub
     */
    public function messages($id, $sub)
    {
        $subject = base64_decode(urldecode($sub));

        $expert_type = $this->session->userdata('UserType');

        if ($expert_type === "expert") {

            $block = false;

            $read = $this->model("Message")->allWhere(['from_user_id' => $id, 'to_user_id' => $this->expert_id, 'subject' => $subject]);

            foreach ($read as $item) {
                $this::model('Message')->update($item->id,[
                    'read' => 1
                ]);
            }

            $experts = $this->model("ExpertsInfo")->allWhere(['expert_id' => $this->expert_id]);
            $clients = $this->model("ClientsInfo")->allWhere(['user_id' => $id]);
            $messages = $this->model("Message")->allOrder('id');

            $blockClient = $this->model("Block")->oneWhere(['client_id' => $id,'expert_id' => $this->expert_id]);

            if(!empty($blockClient)){
                $block = true;
            }

            $free = $this->model("Free")->oneWhere(['who_id' => $experts[0]->expert_id,'whom_id' => $id]);

            $this->_setData([
                'expert' => $experts,
                'messages' => $messages,
                'clients' => $clients,
                'subject' => $subject,
                'block' => $block,
                'free' => $free,
            ]);

            $this->data['page'] = 'expert/messages-show';
            $this->load->view('site/layouts/content', $this->_getData());
        } else {
            exit("Oops sorry you are not expert");
        }
    }

    public function chat($client_id)
    {
        $from = $this->expert_id;

        $path =  FCPATH.'chat-messages/'.'from'.$client_id.'_'.'to'.$from.'.json';
        $jsondata= [];

        if(file_exists($path) ) {

            $jsondata = file_get_contents($path);
        }

        $this->data['chat_messages'] = json_decode($jsondata, true);

        $this->data['clientInfo'] = $this::model('ClientsInfo')->getClientInfo($client_id);


       

        $this->data['page']="expert/chat-show";
        $this->load->view('site/layouts/content',$this->data);

    }
   
}