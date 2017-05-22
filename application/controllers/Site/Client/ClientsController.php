<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ClientSiteController
 */
class ClientsController extends MY_Controller
{
    protected $client_id;
    /**
     * ClientSiteController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('isLoggedIn') == true){
            $this->client_id = $this->session->userdata('UserLoggedId');
        }
    }

    /**
     * method addFavoriteList
     */
    public function addFavoriteList()
    {
        $expert_id = $this->input->post('expert_id');
        $client_id = $this->session->userdata('UserLoggedId');

        $this::model('FavoriteList')->save([
            'client_id' => $client_id,
            'expert_id' => $expert_id
        ]);
    }
    
    /**
     * method deleteFavoriteList
     */
    public function deleteFavoriteList(){

        $expert_id = $this->input->post('expert_id');
        $client_id = $this->session->userdata('UserLoggedId');
        
        $this::model('FavoriteList')->deleteWhere([
            'client_id' => $client_id,
            'expert_id' => $expert_id
        ]);
    }
    
    /**
     * @param $expert_id
     */
    public function clientMessage($expert_id)
    {
        $mail_price = $this::model('ExpertsInfo')->emilPrice($expert_id)->mail_price;
        
        $client_balance = $this->session->userdata('balance');

            if($this->session->userdata('isLoggedIn')  == 'true' && $this->session->userdata('UserType') == 'client') {

                $message = $this->input->post('message');
                $subject = $this->input->post('subject');

                $msg = str_word_count($message,1);
                $validate = array(
                    array('message', 'Message', 'required|max_length[7200]|trim'),
                    array('subject', 'Subject', 'max_length[40]|trim'),
                );
                if (!$this->validate($validate)) {
                    echo $this->json([], 'error', validation_errors());
                    exit;
                }
                $data = [
                    'client_id' => $this->client_id,
                    'expert_id' => $expert_id,
                    'type' => 'message'
                ];

                $free = $this::model('Free')->oneWhere(['who_id' => $expert_id, 'whom_id' => $this->client_id]);
                if (empty($free)) {
                    // No free messaging
                    if($mail_price <  $client_balance) {

                        $this::model('ExpertClients')->updateMyClients($data);

                        $date = date('Y-m-d h:i:s');

                        $payment_id = $this->model('Payment')->save([
                            'client_id'=>$this->client_id,
                            'expert_id'=>$expert_id,
                            'amount'=>$mail_price,
                            'trx_id'=> uniqid(),
                            'currency_code'=>'USD',
                            'date'=>$date,
                            'type'=>'top_up',
                            'payment_type'=>'message',
                        ]);

                        $this->model('Message')->save([
                            'message' => $message,
                            'to_user_id' => $expert_id,
                            'from_user_id' => $this->client_id,
                            'subject' => $subject,
                            'payment_id' => $payment_id,
                        ]);

                        $this->model('UserBalances')->updateBalance(-$mail_price);

                        // also pay expert half amount
                        $pay_expert_amount = floor($mail_price / 2);
                        $this->model('UserBalances')->payExpert($expert_id, $pay_expert_amount);

                        echo $this->json([], 'success');
                    } else {
                        echo $this->json([],'poor');
                    }
                } else {
                    // Free messaging
                    $this::model('ExpertClients')->updateMyClients($data);

                    $this->model('Message')->save([
                        'message' => $message,
                        'to_user_id' => $expert_id,
                        'from_user_id' => $this->client_id,
                        'subject' => $subject,
                    ]);

                    echo $this->json([], 'success');
                }

        } else {
                exit('Oops You are not a client');

            }
    }

    /**
     * method stars
     * @return JSON
     */
    public function stars()
    {
        $message =$this->input->post('message');
        $stars =$this->input->post('NonFormValue');
        $to_id =$this->input->post('expert_id');
        $id = $this->session->userdata('UserLoggedId');

        $msg = str_word_count($message,1);
        $validate = array(
            array('message', 'Message', 'required|max_length[400]|trim')
        );
        if (!$this->validate($validate))
            echo $this->json([], 'error', validation_errors());
        else {
            foreach ($msg as $key => $value){
                if(strlen($value) > 27 ){
                    echo $this->json([], 'length');
                    exit();
                }
            }

            $this->model('Feedback')->save([
                'message' => $message,
                'from_id' => $id,
                'star' => $stars,
                'to_id' => $to_id,
            ]);
            echo json_encode('Thanks you are successfully leave feedback');
        }
    }

    /**
     * method blockExpert
     */
    public function blockExpert()
    {
        $block_id = $this->input->post('block');
        $client_id = $this->session->userdata('UserLoggedId');
        $client = $this::model('ClientsInfo')->oneWhere(['user_id' => $block_id]);
        $block = $this::model('Block')->oneWhere(['who_user_id' => $client_id,'whom_user_id' => $client->user_id]);
        if (empty($block)) {
            $this->model('Block')->save([
                'who_user_id' => $client_id,
                'whom_user_id' => $client->user_id
            ]);
            echo 'You are successfully blocked this expert';
        } else {
            $this::model('Block')->delete($block->id);
            echo 'You are successfully unblocked this expert';
        }
    }


    /**
     * method clientMessagesAnswer
     * @param $id
     */
    public function clientMessagesAnswer($id)
    {
        $logged_in = $this->session->userdata('isLoggedIn');

        if ($logged_in == 'true') {

            $message = $this->input->post('message');
            $subject = $this->input->post('subject');
            $free = $this->model("Free")->oneWhere(['who_id' => $id,'whom_id' =>  $this->client_id]);
            $msg = str_word_count($message,1);
            $validate = array(
                array('message', 'Message', 'required|max_length[7200]|trim'),
                array('subject', 'Subject', 'max_length[40]|trim'),
            );
            if (!$this->validate($validate))
                echo $this->json([], 'error', validation_errors());
            else {
                foreach ($msg as $key => $value){
                    if(strlen($value) > 32 ){
                        echo $this->json([], 'length');
                        exit();
                    }
                }
//                if(empty($free)){
//                    $this->model('Payment')->save([
//                        'client_id' =>  $this->client_id,
//                        'type' => 'pay',
//                        'currency_code' => 'USD',
//                        'amount' => 1.4,
//                        'expert_id' => $id,
//                        'spend' => 1,
//                    ]);
//                }

                $this->model('Message')->save([
                    'message' => $message,
                    'to_user_id' => $id,
                    'from_user_id' =>  $this->client_id,
                    'subject' => $subject,
                ]);

                echo $this->json([], 'success');
            }
        }
    }

    public function payInvoice()
    {
        if($this->session->userdata('isLoggedIn')  == 'true' && $this->session->userdata('UserType') == 'client') {
            $invoice_id = $this->input->post('invoice_id');
            $expert_id = $this->input->post('expert_id');

            if ($invoice_id) {
                // pay by individual invoice
                if ($this->_payInvoice($invoice_id)) {
                    echo $this->json([], 'success');
                } else {
                    echo $this->json([], 'poor');
                }
            } else {
                // pay by expert
                $invoices = $this::model('Invoice')->allWhere(['client_id' => $this->client_id, 'expert_id' => $expert_id]);

                foreach ($invoices as $invoice) {
                    $this->_payInvoice($invoice->id);
                }

                echo $this->json([], 'success');
            }
        } else {
            echo 'Oops You are not a client';
        }
        exit;
    }

    private function _payInvoice($invoice_id)
    {
        $invoice = $this::model('Invoice')->oneWhere(['id' => $invoice_id]);
        $client_balance = $this->session->userdata('balance');

        if ($invoice->amount < $client_balance) {
            // client has sufficient balance to pay invoice

            $amount = $invoice->amount;
            $date = date('Y-m-d h:i:s');

            $this->model('Payment')->save([
                'client_id'=>$this->client_id,
                'expert_id'=>$invoice->expert_id,
                'amount'=>$amount,
                'trx_id'=> uniqid(),
                'currency_code'=>'USD',
                'date'=>$date,
                'type'=>'top_up',
                'payment_type'=>'invoice',
            ]);

            $this->model('Invoice')->markPaid($invoice_id, $date);

            $this->model('UserBalances')->updateBalance(-$amount);
            $this->session->set_userdata(['balance' => ($client_balance - $amount)]);

            // also pay expert half amount
            $pay_expert_amount = floor($amount / 2);
            $this->model('UserBalances')->payExpert($invoice->expert_id, $pay_expert_amount);

            return true;
        } else {
            return false;
        }
    }

}

