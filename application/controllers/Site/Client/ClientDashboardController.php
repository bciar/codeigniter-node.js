<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ClientDashboardController
 */
class ClientDashboardController extends GlobalDashboardController
{
    protected $client_id;
    /**
     * ClientDashboardController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('isLoggedIn') == true){
            $this->client_id = $this->session->userdata('UserLoggedId');
        }
    }

    /**
     *  method expertsList
     */
    public function expertsList()
    {
        $client_type = $this->session->userdata('UserType');

        if ($client_type === "client") {
            $all_experts = $this::model('ExpertsInfo')->all();

            $experts = [];
            foreach ($all_experts as $expert) {
                $messages = $this::model('Message')->allWhereOrder([
                    $this->client_id => ['from_user_id', 'to_user_id'],
                    $expert->expert_id => ['from_user_id', 'to_user_id'],
                ], 'id', 'desc');

                if (count($messages)) {
                    $experts[] = $expert;
                }
            }

            $this->_setData([
                'experts' => $experts,
                'my_id' => $this->client_id,
            ]);

            $this->data['page'] = 'client/messages-list';
            $this->load->view('site/layouts/content', $this->_getData());
        } else {
            exit("Oops sorry you are not client");
        }
    }

    /**
     * @param $id
     * @param $sub
     */
    public function messagesList($id, $sub)
    {
        $subject = base64_decode(urldecode($sub));

        $client_type = $this->session->userdata('UserType');

        if ($client_type === "client") {

            $block = false;

            $read = $this->model("Message")->allWhere(['from_user_id' => $id, 'to_user_id' =>  $this->client_id, 'subject' => $subject ]);

            foreach ($read as $item) {
                $this::model('Message')->update($item->id, [
                    'read' => 1
                ]);
            }

            $experts = $this->model("ExpertsInfo")->allWhere(['expert_id' => $id]);
            $clients = $this->model("ClientsInfo")->allWhere(['user_id' =>  $this->client_id ]);
            $messages = $this->model("Message")->allOrder('id');
            $blockClient = $this->model("Block")->oneWhere(['client_id' =>  $this->client_id,'expert_id'=> $id]);

            if(!empty($blockClient)){
                $block = true;
            }

            $clientBalance = $this->session->userdata('balance');

            $invoices = $this->model('Invoice')->allWhere(['client_id' => $this->client_id, 'expert_id' => $id, 'subject' => $subject, 'is_paid' => 0]);
            $prices = [];
            $total_invoice = 0;
            foreach ($invoices as $invoice) {
                $prices[] = $invoice->amount . '$';
                $total_invoice += $invoice->amount;
            }

            $free = $this->model("Free")->oneWhere(['who_id' => $id, 'whom_id' => $this->client_id]);

            $this->_setData([
                'expert' => $experts,
                'messages' => $messages,
                'subject' => $subject,
                'clients' => $clients,
                'block'=>$block,
                'balance' => $clientBalance,
                'invoice_prices' => $prices,
                'invoice_total' => $total_invoice,
                'free' => $free,
            ]);

            $this->data['page'] = 'client/messages-show';
            $this->load->view('site/layouts/content', $this->_getData());


        } else {
            exit("Oops sorry you are not client");
        }
    }


    /**
     * method deleteMessages
     */
    public function deleteMessages()
    {
        $delete = $this->input->post('check');
        foreach ($delete as $item) {
            $id = explode(',', $item);
            $from_user_id = $id[0];
            $to_user_id = $id[1];
            $this->model('Message')->deleteWhere(['from_user_id' => $from_user_id, 'to_user_id' => $to_user_id]);
        }
    }

    /**
     * method blockExpert
     */
    public function blockExpert()
    {
        $block_id = $this->input->post('block');
        $client_id = $this->session->userdata('UserLoggedId');
        $expert = $this::model('ExpertsInfo')->oneWhere(['expert_id' => $block_id]);
        $block = $this::model('Block')->oneWhere(['who_user_id' => $client_id,'whom_user_id' => $expert->expert_id]);
        if (empty($block)) {
            $this->model('Block')->save([
                'who_user_id' => $client_id,
                'whom_user_id' => $expert->expert_id
            ]);
            echo 'You are successfully blocked this expert';
        } else {
            $this::model('Block')->delete($block->id);
            echo 'You are successfully unblocked this expert';
        }
    }
    

    /**
     * method paymentSearch
     * @return JSON
     */
    public function paymentSearch()
    {
        $id = $this->session->userdata('UserLoggedId');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $result = $this->model('Payment')->getPay($from,$to,$id);
        echo json_encode($result);
    }
    
    /**
     * method clientFavoriteList
     */
    public function clientFavoriteList(){

        $client_id = $this->session->userdata('UserLoggedId');

        $result = $this::model('FavoriteList')->SelectWhere(
            [
                'expert_id'
            ],
            [
                'client_id' => $client_id
            ]
        );

        if (!empty($result))    {

            $favorite_experts = [];

            foreach ($result as $item){
                $favorite_experts[]=$item->expert_id;
            }

            $this->getExpertList('','',$favorite_experts);
            
        }

        $this->data['page']='client/favorite-experts';
        $this->load->view('site/layouts/content',$this->data);
    }
}


