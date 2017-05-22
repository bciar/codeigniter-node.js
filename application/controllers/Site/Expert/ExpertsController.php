<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class ExpertSiteController
 */
class ExpertsController extends MY_Controller
{
    protected  $expert_id;
    /**
     * ExpertSiteController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('isLoggedIn') == true){
            $this->expert_id = $this->session->userdata('UserLoggedId');
        }
    }

  

    /**
     * method clientMessagesAnswer
     * @param $id
     */
    public function expertMessagesAnswer($id)
    {
//        $subject = base64_decode(urldecode($sub));

        $logged_in = $this->session->userdata('isLoggedIn');
        if ($logged_in == 'true') {

            $message = $this->input->post('message');
            $subject = $this->input->post('subject');
            $msg = str_word_count($message,1);

            $validate=array(
                array('message','Message','required|max_length[7200]|trim'),
                array('subject','Subject','max_length[40]|trim'),
            );

            if(!$this->validate($validate))
                echo $this->json([], 'error', validation_errors());
            else {
                foreach ($msg as $key => $value){
                    if(strlen($value) > 32 ){
                        echo $this->json([], 'length');
                        exit();
                    }
                }
                $this->model('Message')->save([
                    'message' => $message,
                    'to_user_id' => $id,
                    'from_user_id' => $this->expert_id,
                    'subject' => $subject,
                ]);
                echo $this->json([], 'success');
            }
        }
    }

    /**
     * method paymentSearch
     * @return responseJSON
     */
    public function paymentSearch()
    {
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $result = $this->model('Payment')->getExpertPay($from,$to,$this->expert_id);
        echo json_encode($result);
    }

    /**
     * method freeMessage
     */
    public function freeMessage()
    {
        $free_id = $this->input->post('free');
        $client_id = $this->session->userdata('UserLoggedId');
        $client = $this::model('ClientsInfo')->oneWhere(['user_id' => $free_id]);
        $free = $this::model('Free')->oneWhere(['who_id' => $client_id,'whom_id' => $client->user_id]);
        if (empty($free)) {
            $this->model('Free')->save([
                'who_id' => $client_id,
                'whom_id' => $client->user_id
            ]);
            echo 'Now that client read message free';
        } else {
            $this::model('Free')->delete($free->id);
            echo 'Now that client read message on pay';
        }
    }

    /**
     * method deleteMessages
     */
    public function deleteMessages()
    {
        $mail_ids = $this->input->post('mails');

        foreach ($mail_ids as $mail_id) {
            $mail = $this->model('Message')->oneSelectWhere('*', [ 'id' => $mail_id ]);
            $test = $this->model('Message')->deleteWhere([ $mail->from_user_id => ['from_user_id', 'to_user_id'], $mail->to_user_id => ['from_user_id', 'to_user_id'], $mail->subject => ['subject'] ]);
        }

        echo $this->json('', 'success', '');
    }

    /**
     *
     */
    public function blockClient(){

        if(empty($this->input->post('unblock'))){

            $data = [
                'client_id' => $this->input->post('client_id'),
                'expert_id' => $this->expert_id,
            ];

            $this::model('Block')->save($data);

        }else{
            $this::model('Block')->deleteWhere(['expert_id'=>$this->expert_id]);
        }

        echo $this->json('','success','');

    }

    /**
     *
     */
    public function getFeedbackMore(){

        $offset = $this->input->post('offset');

        $feedback = $this::model('Feedback')->getExpertFeedback($this->expert_id,$offset);

        $data['feedback']=  $this->load->view('site/expert/partials/feedback', compact('feedback'),true);

        if(count($feedback) < 5){
            $data['count'] = 0;
        }

        echo $this->json($data,'success','');

        exit;
    }

    /**
     *
     */
    public function getExpertsMore(){

        $offset = $this->input->post('offset');

        $expert = $this->getExpertList(false,$offset);

        $data['experts'] = $this->load->view('site/expert-list', $this->data,true);

        if(count($expert) < 6){
            $data['count'] = 0;
        }
        
        echo $this->json($data,'success','');
    }

    /**
     *
     */
    public function updateMyClients(){
        $data = $this->input->post();
        $this::model('ExpertClients')->updateMyClients($data);
    }

    /**
     * method sendInvoice
     */
    public function sendInvoice()
    {
        $expert_id = $this->expert_id;
        $client_id = $this->input->post('client_id');
        $amount = $this->input->post('amount');
        $subject = $this->input->post('subject');
        $sent_time = date('Y-m-d H:i:s');

        $data = [
            'expert_id' => $expert_id,
            'client_id' => $client_id,
            'subject'   => $subject,
            'amount'    => $amount,
            'sent_time' => $sent_time,
        ];

        $this::model('Invoice')->save($data);

        echo $this->json($data, 'success', 'Invoice sent successfully.');
    }

    /**
     * load withdraw form
     */
    public function loadWithdrawform()
    {
        $expert_id = $this->expert_id;

        $balance = $this::model('UserBalances')->getBalance($expert_id);

        $this->_setData([
            'expert_id'     => $this->expert_id,
            'balance'       => $balance->amount,
        ]);

        $this->load->view('site/forms/withdraw', $this->_getData());
    }

    public function withdrawBalance()
    {
        $expert_id = $this->expert_id;
        $amount = $this->input->post('amount');
        $email = $this->input->post('email');

        $balance = $this::model('UserBalances')->getBalance($expert_id);

        if ($amount > $balance->amount) {
            echo $this->json([], 'error', 'Withdrawal amount not correct');
            exit;
        }

        $data = [
            'user_id'       => $expert_id,
            'amount'        => $amount,
            'email'         => $email,
        ];

        $this::model('Withdrawal')->save($data);
        $this::model('UserBalances')->updateBalance(-$amount);

        echo $this->json($data, 'success', 'Withdraw requested successfully');
    }
}
