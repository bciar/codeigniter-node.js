<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class AdminController extends MY_Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->set_css(array(
            'style',
        ));
    }

    /**
     * method index
     */
    public function index()
    {
        $this->load->view('admin/admin-layouts/login');
    }

    /**
     *
     */
    public function dashboard()
    {
        $this->load->view('admin/dashboardView');
    }

    /**
     *
     */
    public function login()
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $validate = array(
            array('username', 'Username', 'required|xss_clean|trim'),
            array('password', 'Password', 'required|xss_clean|trim'),
        );

        $getAdmin = $this::model('admin')->oneWhere([
            'username' => $username
        ]);

        if ($this->validate($validate)) {
            if (!is_null($getAdmin) && password_verify($password, $getAdmin->password)) {

                $this->session->set_userdata([
                    'isLoggedIn' => true,
                    'UserLoggedId' => $getAdmin->id,
                    'UserType' => 'SuperAdmin',
                ]);

                redirect(base_url('admin/dashboard'));

            } else {
                exit('hajox');
            }
        } else {
            exit('hajox APEEEE');
        }

    }


    /**
     *
     */
    public function logout()
    {
        $this->session->set_userdata([
            'isLoggedIn' => false,
            'UserLoggedId' => null,
            'UserType' => null,
        ]);

        redirect(base_url());
    }

    /**
     * delete_user method
     * @functionality deleting user
     * @return boolean
     */
    public function delete_user()
    {

        $id = $this->input->post('id');

        $this::model('user')->delete($id);

        echo $this->json([], 'success', '<p>User Deleted</p>');

    }

    /**
     * editActivationView method
     * @functionality Its Ajax function for expert,client ,admin activate user,and sending email about activate
     */
    public function editUserStatus()
    {

        $id = $this->input->post('expert_id');
        $data['status'] = $this->input->post('status');
        $email = $this->input->post('email');
        $type = $this->input->post('type');


        $this::model('user')->update($id, $data);

        if ($data['status'] == 1) {

            $this->load->library('email');
            $this->email->from('bulval@mail.ru');
            $this->email->to($email);
            $this->email->set_mailtype("html");

            $this->email->subject('Your account was activate by admin of site');
            $this->email->message('
                                <!DOCTYPE html>
                                     <html>
                                       <head>
                                       </head>
                                       <body>
                                          <p>Your account activated.</p>
                                          <p>Please go to the next link and sign your account <a href="http://bulval.am/pv-cod/">bulval.am/pv-cod</a> thanks.</p><br>
                                          <h3 style="margin-top:0;text-align:right"><i>Admin</i></h3>                              
                                     </body>
                                     </html>
                                     ');
            $this->email->send();

        }

        if ($type == 'expert') {

            redirect(base_url('admin/experts'));

        } else if ($type == 'client') {

            redirect(base_url('admin/clients'));
        }

    }

    /**
     * @param $from
     * @param $to
     */
    public function Payments($from = 0, $to = 0) {
        // get all history

        if (! $from && ! $to) {
            $chatHistory = $this->model('ChatHistory')->all();
            $payments = $this->model('Payment')->all();
            $invoices = $this::model('Invoice')->all();
            $users = $this::model('User')->all();
            $balances = $this::model('UserBalances')->all();
        } else {
            $from = new DateTime("@$from");
            $to = new DateTime("@$to");

//            echo "From = " . $from->format('Y-m-d') . "<br />To = " . $to->format('Y-m-d');

            $chatHistory = $this->model('ChatHistory')->all();
            $payments = $this->model('Payment')->all();
            $invoices = $this::model('Invoice')->all();
            $users = $this::model('User')->all();
            $balances = $this::model('UserBalances')->all();
        }

        $stats = [
            'client_spent' => 0,
            'expert_earning' => 0,
            'expert_withdraw' => 0,
            'commission' => 0,
        ];

        // statistics per user
        $clients = [];
        $experts = [];
        $usernames = [];
        foreach ($users as $user) {
            $usernames[$user->id] = $user->screen_name;

            if ($user->type == 'client') {
                if (! isset($clients[$user->id])) {
                    $clients[$user->id] = [
                        'chat'      => 0,
                        'message'   => 0,
                        'invoice'   => 0,
                        'total'     => 0,
                        'total_buy' => 0,
                        'balance'   => 0,
                    ];
                }
            } else if ($user->type == 'expert') {
                if (! isset($experts[$user->id])) {
                    $experts[$user->id] = [
                        'chat'      => 0,
                        'message'   => 0,
                        'invoice'   => 0,
                        'withdraw'  => 0,
                        'total'     => 0,
                        'commission'=> 0,
                        'balance'   => 0,
                    ];
                }
            }
        }

        $withdrawals = [];
        foreach ($payments as $payment) {
            if (in_array($payment->payment_type, ['chat', 'message', 'invoice'])) {
                $stats['client_spent'] += $payment->amount;
                $stats['expert_earning'] += $payment->amount / 2;
                $stats['commission'] += $payment->amount / 2;
            } else {
                // withdraw
                $stats['expert_withdraw'] += $payment->amount;
                $withdrawals[] = $payment;
            }

            if ($payment->payment_type != 'withdraw') {
                $clients[$payment->client_id][$payment->payment_type] += $payment->amount;
                $experts[$payment->expert_id][$payment->payment_type] += $payment->amount;

                $clients[$payment->client_id]['total'] += $payment->amount;
                $experts[$payment->expert_id]['total'] += $payment->amount;
            } else {
                $experts[$payment->expert_id][$payment->payment_type] += $payment->amount;
            }
        }

        foreach ($balances as $balance) {
            if (in_array($balance->user_id, array_keys($clients))) {
                if ($balance->amount > 0) {
                    $clients[$balance->user_id]['total_buy'] += $balance->amount;
                }
                $clients[$balance->user_id]['balance'] += $balance->amount;
            } else if (in_array($balance->user_id, array_keys($experts))) {
                $experts[$balance->user_id]['balance'] += $balance->amount;
            }
        }

        $this->_setData([
            'stats'         => $stats,
            'chats'         => $chatHistory,
            'payments'      => $payments,
            'invoices'      => $invoices,
            'withdrawals'   => $withdrawals,
            'usernames'     => $usernames,
            'clients'       => $clients,
            'experts'       => $experts,
        ]);

        $this->load->view('admin/payments/index',$this->_getData());
    }

    /**
     * load withdrawals
     */
    public function Withdrawals()
    {
        $users = $this::model('User')->all();
        $usernames = [];
        foreach ($users as $user) {
            $usernames[$user->id] = $user->screen_name;
        }

        $all_withdrawals = $this::model('Withdrawal')->all();

        $withdrawals = [
            'pending' => [],
            'approved' => [],
            'rejected' => [],
        ];
        foreach ($all_withdrawals as $withdrawal) {
            $withdrawals[$withdrawal->status][] = $withdrawal;
        }

        $this->_setData([
            'usernames'     => $usernames,
            'withdrawals'   => $withdrawals,
        ]);

        $this->load->view('admin/payments/withdrawals', $this->_getData());
    }

    /**
     * approve or reject withdrawal
     * @param $action
     * @param $id
     */
    public function WithdrawalAction($action, $id)
    {
        $status = ($action == 'approve') ? 'approved' : 'rejected';

        $withdrawal = $this::model('Withdrawal')->oneWhere([ 'id' => $id ]);

        $comment = '';
        if ($status == 'rejected') {
            $comment = $this->input->post('reason');
        }

        $this::model('Withdrawal')->update($id, [
            'status' => $status,
            'comment' => $comment,
        ]);

        $this::model('Payment')->save([
            'amount' => $withdrawal->amount,
            'client_id' => 0,
            'expert_id' => $withdrawal->user_id,
//            'trx_id' => $trx_id,
            'currency_code' => 'USD',
            'type' => 'top_up',
            'payment_type' => 'withdraw',
        ]);

        $this->sendWithdrawalEmail($id, $status);

        echo $this->json([], 'success', 'Successfully ' . $status . ' the withdrawal request');
    }

    /**
     * send withdrawal notification email to expert
     * @param $withdrawal_id
     * @param $status
     */
    public function sendWithdrawalEmail($withdrawal_id, $status)
    {
        $withdrawal = $this::model('Withdrawal')->oneWhere(['id' => $withdrawal_id]);
        $expert = $this::model('User')->oneWhere(['id' => $withdrawal->user_id]);

        $message = '<h4>Hi, ' . $expert->screen_name . '</h4>';
        if ($status == 'approved') {
            $subject = 'Your withdrawal request has successfully been approved';
            $message .= '<p>Your withdrawal request of $' . $withdrawal->amount . ' submitted on ' . $withdrawal->request_date . ' has successfully been approved.</p>';
            $message .= '<p>It\'ll be sent to the following requested paypal address : ' . $withdrawal->email . '</p>';
        } else if ($status == 'rejected') {
            $subject = 'Your withdrawal request has been rejected';
            $message .= '<p>Your withdrawal request of $' . $withdrawal->amount . ' submitted on ' . $withdrawal->request_date . ' has been rejected.</p>';
        }

        $this->load->library('email');
        $this->email->clear();

        $this->email->to($expert->email);
        $this->email->from('admin@psychics.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    /**
     * @param $type
     * @param $id
     */
    public function PaymentView($type, $id)
    {
        $users = $this::model('User')->all();
        $usernames = [];
        foreach ($users as $user) {
            $usernames[$user->id] = $user->screen_name;
        }

        $data = [];

        if ($type == 'client') {
            $data['title'] = 'Client Details - ' . $usernames[$id];
            $data['headers'] = [
                'Date',
                'Description',
                'Amount',
            ];

            $payments = $this->model('Payment')->allWhere([ 'client_id' => $id ]);
            $data['payments'] = [];
            foreach ($payments as $payment) {
                $description = 'Payment to ' . $usernames[$payment->expert_id] . ' for ' . $payment->payment_type;

                $payment_data = [
                    $payment->date,
                    $description,
                    '$' . $payment->amount,
                ];

                $data['payments'][] = $payment_data;
            }
        } else if ($type == 'expert') {
            $data['title'] = 'Expert Details - ' . $usernames[$id];
            $data['headers'] = [
                'Date',
                'Description',
                'Amount',
            ];

            $payments = $this->model('Payment')->allWhere([ 'expert_id' => $id ]);
            $data['payments'] = [];
            foreach ($payments as $payment) {
                $description = 'Payment from ' . $usernames[$payment->client_id] . ' for ' . $payment->payment_type;

                $payment_data = [
                    $payment->date,
                    $description,
                    '$' . $payment->amount,
                ];

                $data['payments'][] = $payment_data;
            }
        } else if ($type == 'withdrawal') {
            $data['title'] = 'Withdrawal Details - Expert: ' . $usernames[$id];
            $data['headers'] = [
                'Date',
                'Description',
                'Amount',
            ];

            $payments = $this->model('Payment')->allWhere([ 'expert_id' => $id, 'payment_type' => 'withdraw' ]);
            $data['payments'] = [];
            foreach ($payments as $payment) {
                $description = 'Withdrawal';

                $payment_data = [
                    $payment->date,
                    $description,
                    '$' . $payment->amount,
                ];

                $data['payments'][] = $payment_data;
            }
        } else {
            $data['title'] = 'Payment';
            $data['headers'] = [
                ''
            ];
            $data['data'] = [
                'There is no data to display'
            ];
        }

        $this->load->view('admin/payments/view', $data);
    }

    /**
     * @param $id
     */
    public function PaymentsProcessOne($id){
        $this->data = $this::model('Payment')->getListPaymentsInProcess($id);

        $this->load->view('admin/payments/processOne',$this->data);
    }

    /**
     * 
     */
    public function PaymentsSend(){

        $price = $this->input->post('amount');

        /**
         *
         */
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AQZn5lIcuL6iDQawKYVfl82g6144imE908e6aD1uW0lg_ev1KhJQRhqTlghAHB5Asv0oNMAKZQFenFu8',
                'EBMoPs77v1UrvY_BQiPjYo8GXGyzl5fMEsXuhqCsSO-jyZhvdskte_gJM78GX2Q8f7x8NwGTWuRZ391m'
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        // Set redirect urls
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('http://127.0.0.1/aleembit/admin/confirm')
            ->setCancelUrl('http://localhost:3000/cancel.php');
//        $redirectUrls->setReturnUrl('http://localhost:3000/process.php')
//            ->setCancelUrl('http://localhost:3000/cancel.php');

        // Set payment amount
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($price);

        // Set transaction object
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Payment description");

        // Create the full payment object
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        try {
            $payment->create($apiContext);
            
            // Get PayPal redirect URL and redirect user
            $approvalUrl = $payment->getApprovalLink();

            return redirect($approvalUrl);

            // REDIRECT USER TO $approvalUrl
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
        } catch (Exception $ex) {
            die($ex);
        }


    }

    public function PaymentsConfirm(){
        /**
         *
         */
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AQZn5lIcuL6iDQawKYVfl82g6144imE908e6aD1uW0lg_ev1KhJQRhqTlghAHB5Asv0oNMAKZQFenFu8',
                'EBMoPs77v1UrvY_BQiPjYo8GXGyzl5fMEsXuhqCsSO-jyZhvdskte_gJM78GX2Q8f7x8NwGTWuRZ391m'
            )
        );

        // Get payment object by passing paymentId
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $payerId = $_GET['PayerID'];

        // Execute payment with payer id
        $execution = new \PayPal\Api\PaymentExecution();
        $execution->setPayerId($payerId);
        echo  '<pre>';


        try {
            // Execute payment

//            $result = $payment->execute($execution, $apiContext);
//
//
//            $this::model('UserBalances')->updateBalance($payment->transactions[0]->amount->total);
//
//            return redirect('dashboard');

        } catch (PayPal\Exception\PayPalConnectionException $ex) {

            print_r($ex->getCode());
            echo '<hr />';
            echo $ex->getData();
            echo '<hr />';
            print_r($ex);

        } catch (Exception $ex) {
            print_r($ex);
        }

    }

    public function configuration() {
        if ($this->input->post('pp_email')) {
            $data = array (
                'pp_email' => $this->input->post('pp_email'),
                'pp_sandbox' => $this->input->post('pp_sandbox'),
            );

            $this::model('configuration')->update(1, $data); // ID should always be 1 because there's only one configuration setting in database
        }

        $data['config'] = $this::model('configuration')->getAll();

        $this->load->view('admin/configurationView', $data);
    }

    /**
     * @param $type
     * @param int $user_id
     */
    public function ReadingHistory($type, $user_id = 0)
    {
        $users = $this::model('User')->all();
        $usernames = [];
        $usertypes = [];
        foreach ($users as $user) {
            $usernames[$user->id] = $user->screen_name;

            $usertypes[$user->type][] = $user;
        }

        if ($type == 'chat') {
            // get chat history
            $chat_path =  FCPATH . 'chat-messages/';
            $chats = scandir($chat_path);
            unset($chats[0], $chats[1]);

            $chat_history = [];
            foreach ($chats as $chat) {
                preg_match("/from(\d+)_to(\d+)/", $chat, $output_array);
                if ($user_id && !in_array($user_id, $output_array)) continue;

                $client_id = $output_array[1];
                $expert_id = $output_array[2];

                $file = $chat_path . $chat;

                if (file_exists($file)) {
                    $chat_history[] = [
                        'client_id' => $client_id,
                        'expert_id' => $expert_id,
                    ];
                }

            }

            $this->_setData([
                'chats'     => $chat_history,
                'type'      => 'chat',
                'usernames' => $usernames,
                'usertypes' => $usertypes,
                'user_id'   => $user_id,
            ]);
        } else if ($type == 'message') {
            if ($user_id) {
                $messages = $this::model('Message')->getUserInbox($user_id);
            } else {
                $messages = $this::model('Message')->all();
            }

            $this->_setData([
                'messages'  => $messages,
                'type'      => 'message',
                'usernames' => $usernames,
                'usertypes' => $usertypes,
                'user_id'   => $user_id,
            ]);

        }

        $this->load->view('admin/reading-history/list', $this->_getData());

    }

    /**
     * handle ajax requests
     * @param $action
     */
    public function HandleAjax($action)
    {
        $users = $this::model('User')->all();
        $usernames = [];
        foreach ($users as $user) {
            $usernames[$user->id] = $user->screen_name;
        }

        if ($action == 'messages') {
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $subject = $this->input->post('subject');

            $messages = $this::model('Message')->allWhere([ 'from_user_id' => $from, 'to_user_id' => $to, 'subject' => $subject ]);

            $this->_setData([
                'messages'  => $messages,
                'usernames' => $usernames,
            ]);

            $this->load->view('admin/ajax/messages', $this->_getData());
        } else if ($action == 'chats') {
            $client_id = $this->input->post('client');
            $expert_id = $this->input->post('expert');

            $chat_path =  FCPATH . 'chat-messages/';
            $file = $chat_path . 'from' . $client_id . '_to' . $expert_id . '.json';

            if (file_exists($file)) {
                $jsondata = file_get_contents($file);
            }

            $chats = json_decode($jsondata, true);

            $data = [
                'chats'     => $chats,
                'usernames' => $usernames,
            ];

            if ($this->input->post('start')) {
                $data['start'] = $this->input->post('start');
                $data['end'] = $this->input->post('end');
            }

            $this->load->view('admin/ajax/chats', $data);
        } else if ($action == 'save_expert_order') {
            $orders = $this->input->post('order');

            foreach ($orders as $expert_id => $order) {
                $this::model('ExpertsInfo')->update($expert_id, [ 'expert_order' => $order ]);
            }

            echo json_encode([ 'status' => 'success' ]);
            exit;
        }
    }
}


