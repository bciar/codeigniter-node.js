<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class UsersDashboardController
 */
class UserDashboardController extends GlobalDashboardController
{
    /**
     * @var
     */
    public $user_id;
    /**
     * @var
     */
    public $user_type;
    /**
     * @var
     */
    public $logged_in;

    /**
     *
     */
    protected $balance;

    /**
     * UsersDashboardController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->user_id = $this->session->userdata('UserLoggedId');

        $this->user_type = $this->session->userdata('UserType');

        if(!empty($this->session->userdata('balance'))){
            $this->balance = $this->session->userdata('balance');
        }

    }

    /**
     * method dashboard
     */
    public function dashboard()
    {
        $logged_in = $this->session->userdata('isLoggedIn');

        $this->data['user_address'] = $this::model('UserAddress')->oneWhere(['user_id' => $this->user_id]);

        if ($logged_in == 'true') {

            $userType = $this->session->userdata('UserType');
            $userId = $this->session->userdata('UserLoggedId');

            $user = [];
            $contact = [];
            $name = [];

            if ($userType == 'client') {

                $result = $this->getPaymentClient();
                $this->data['account'] = $result;
                $this->data['user_info'] = $this::model('ClientsInfo')->oneWhere(['user_id' => $userId]);

                $this->data['user_email'] = $this::model('user')->selectEmail($userId);

                $message = $this->model('Message')->allWhereOrder(['to_user_id' => $userId], 'id', 'desc');

                foreach ($message as $item) {
                    $contact[] = $this->model('user')->allWhere(['id' => $item->from_user_id]);
                }

                foreach ($contact as $item) {
                    foreach ($item as $ok) {
                        $name[] = $ok->screen_name;
                    }
                }
                $this->data['message'] = $message;
                $this->data['contact'] = array_unique($name);
                
                $this->data['page'] = "client/dashboard";

            } else if ($userType == 'expert') {


                $result = $this->getPaymentExpert();


                $this->data['myClients']= $this->model('ExpertClients')->getMyClients($userId);

                $this->data['account'] = $result;
                $this->data['user_info'] = $this::model('ExpertsInfo')->oneWhere(['expert_id' => $userId]);

                $this->data['block_clients'] = $this::model('Block')->getBlockId($userId);

//                dd($this->data['block_clients']);

                $this->data['feedback'] = $this->model('Feedback')->getExpertFeedback($userId);
                $payment = $this->model('Payment')->order('amount', 'desc')->allWhere(['expert_id' => $userId]);
                $this->data['payment'] = $payment;
                $this->data['user_email'] = $this::model('user')->selectEmail($userId);


                $this->data['page'] = "expert/dashboard";
            }

            $this->load->view('site/layouts/content', $this->data);

        } else {
            redirect(base_url());
        }

    }

    /**
     * method history
     */
    public function readingHistory()
    {
        $logged_in = $this->session->userdata('isLoggedIn');

        if ($logged_in == 'true') {
            $userType = $this->session->userdata('UserType');

            $this->_setData([
                'page'      => $userType . '/reading-history-list',
            ]);

            $this->load->view('site/layouts/content', $this->_getData());
        } else {
            redirect(base_url());
        }
    }

    /**
     * reading history view_more
     */
    public function viewMore()
    {
        $logged_in = $this->session->userdata('isLoggedIn');
        $perpage = 5;

        if ($logged_in == 'true') {
            $userType = $this->session->userdata('UserType');

            $type = $this->input->post('type');
            $from = $this->input->post('from') ? $this->input->post('from') : 0;

            $users = [];
            if ($userType == 'client') {
                $experts_all = $this::model('ExpertsInfo')->all();
                foreach ($experts_all as $expert) {
                    $users[$expert->expert_id] = $expert;
                }
            } else if ($userType == 'expert') {
                $clients_all = $this::model('ClientsInfo')->all();
                foreach ($clients_all as $client) {
                    $users[$client->user_id] = $client;
                }
            }

            $all_items = [];
            if ($type == 'chat_list') {
                // get chat history
                $all_items = $this->model('ChatHistory')->getHistory($this->user_id, $this->user_type);
//                $chat_path =  FCPATH . 'chat-messages/';
//                $chats = scandir($chat_path);
//                unset($chats[0], $chats[1]);
//
//                foreach ($chats as $chat) {
//                    preg_match("/from(\d+)_to(\d+)/", $chat, $output_array);
//                    if (!in_array($this->user_id, $output_array)) continue;
//
//                    $file = $chat_path . $chat;
//
//                    if (file_exists($file)) {
//                        $chats = json_decode(file_get_contents($file), true);
//                        $all_items[] = end($chats);
//                    }
//                }
            } else if ($type == 'message_list') {
                $all_items = $this::model('Message')->getUserInbox($this->user_id);
            }

            $items = array_slice($all_items, $from, $perpage);
            if (count($all_items) <= $from + $perpage) {
                $no_more = true;
            } else {
                $no_more = false;
            }

            $this->_setData([
                'type'      => $type,
                'from'      => $from + $perpage,
                'items'     => $items,
                'users'     => $users,
                'no_more'   => $no_more,
                'my_id'     => $this->user_id,
            ]);

            $this->load->view('site/readinghistory-partial', $this->_getData());

        } else {
            redirect(base_url());
        }
    }

    /**
     * @param $id
     * @param $sub
     */
    public function oneHistory($type, $id, $sub = '')
    {
        $userType = $this->session->userdata('UserType');

        if ($userType == 'client') {
            $user_id = $this->session->userdata('UserLoggedId');
            $experts = $this->model("ExpertsInfo")->allWhere(['expert_id' => $id]);
            $clients = $this->model("ClientsInfo")->allWhere(['user_id' => $user_id]);

            $expert_id = $id;
            $client_id = $user_id;
        } else {
            $user_id = $this->session->userdata('UserLoggedId');
            $experts = $this->model("ExpertsInfo")->allWhere(['expert_id' => $user_id]);
            $clients = $this->model("ClientsInfo")->allWhere(['user_id' => $id]);
//            $messages = $this->model("Message")->allOrder('id');

            $expert_id = $user_id;
            $client_id = $id;
        }

        if ($type == 'message') {
            $subject = base64_decode(urldecode($sub));

            $items = $this->model("Message")->allWhere(['subject' => $subject]);
        } else if ($type == 'chat') {
            $chat_path =  FCPATH . 'chat-messages/';
            $chats = scandir($chat_path);
            unset($chats[0], $chats[1]);

            foreach ($chats as $chat) {
                if ($chat == 'from' . $client_id . '_to' . $expert_id . '.json') {
                    $file = $chat_path . $chat;

                    if (file_exists($file)) {
                        $chats = json_decode(file_get_contents($file), true);
                        foreach ($chats as $chat) {
                            $items[] = $chat;
                        }
                    }
                }
            }
        }

        $this->_setData([
            'type' => $type,
            'expert' => $experts,
            'items' => $items,
            'clients' => $clients,
            'page' => $userType . '/reading-history-show',
        ]);
        $this->load->view('site/layouts/content', $this->_getData());
    }

    /**
     *
     */
    public function messageReply($expert_id){

        $message = $this->input->post('message');
//        $expert_id = $this->input->post('expert_id');
        $subject = $this->input->post('subject');

        $this->model('Message')->save([
            'message' => $message,
            'from_user_id' =>  $this->user_id,
            'to_user_id' => $expert_id,
            'subject' => $subject,
        ]);

//        return $this->back();

        echo $this->json('', 'success', '');
        exit;
    }

    /**
     * method paymentSuccess
     */
    public function paymentSuccess()
    {
        $client_id = $this->session->userdata('UserLoggedId');

        $amount = $this->input->get('amt'); //var_dump($_GET['amt'])."<br>";
        $trx_id = $this->input->get('tx');    //var_dump($_GET['cc'])."<br>";
        $currency_code = $this->input->get('cc');    //var_dump($_GET['tx'])."<br>";

        $this::model('Payment')->save([
            'amount' => $amount,
            'client_id' => $client_id,
            'trx_id' => $trx_id,
            'currency_code' => $currency_code,
            'type' => 'top_up',
            'payment_type' => 'payment',
        ]);
        $this->data['page'] = "payment-success";
        $this->load->view('site/layouts/content', $this->data);
    }

    /**
     * method userSettingsView
     */
    public function userSettingsView()
    {

        $logged_in = $this->session->userdata('isLoggedIn');

        $this->data['user_address'] = $this::model('UserAddress')->oneWhere(['user_id' => $this->user_id]);

        if ($logged_in == 'true') {

            $userType = $this->session->userdata('UserType');
            $userId = $this->session->userdata('UserLoggedId');

            if ($userType == 'client') {

                $this->data['user_info'] = $this::model('ClientsInfo')->oneWhere(['user_id' => $userId]);

            } else if ($userType == 'expert') {

                $this->data['user_info'] = $this::model('ExpertsInfo')->oneWhere(['expert_id' => $userId]);
            }

            $this->data['user_email'] = $this::model('user')->selectEmail($userId);

        }

        
        $this->data['page'] = "user-settings";
        $this->load->view('site/layouts/content', $this->data);
    }

    /**
     * method userMessagesView
     */
    public function userMessagesView()
    {
        $logged_in = $this->session->userdata('isLoggedIn');


        if ($logged_in == 'true') {
            $userType = $this->session->userdata('UserType');
            $userId = $this->session->userdata('UserLoggedId');

            if ($userType == 'client') {

                $this->data['user_info'] = $this::model('ClientsInfo')->oneWhere(['user_id' => $userId]);

            } else if ($userType == 'expert') {

                $this->data['user_info'] = $this::model('ExpertsInfo')->oneWhere(['expert_id' => $userId]);
            }

            $this->data['user_email'] = $this::model('user')->selectEmail($userId);

        }

        $this->data['page'] = "messages";
        $this->load->view('site/layouts/content', $this->data);
    }

    /**
     * method userPersonalSettings
     */
    public function userPersonalSettings()
    {
        $validate = array(
            array('name', 'Name', 'required|min_length[4]|max_length[50]|xss_clean|trim'),
            array('surname', 'Surname', 'required|min_length[4]|max_length[50]|xss_clean|trim'),
            array('birthday', 'Birthday', 'required|min_length[5]|max_length[20]|xss_clean|trim'),
            array('email', 'Email', 'required|min_length[5]|max_length[200]|valid_email|xss_clean|trim'),
            array('paym_email', 'Pyment Email', 'max_length[200]|valid_email|xss_clean|trim'),
            array('country', 'Country ', 'max_length[100]|xss_clean|trim'),
            array('city', 'City ', 'max_length[100]|xss_clean|trim'),
            array('state', 'State/Province ', 'max_length[100]|xss_clean|trim'),
            array('street', 'State/Province ', 'max_length[100]|xss_clean|trim'),
            array('zip', 'Zip code ', 'max_length[100]|numeric|xss_clean|trim'),
            array('phone_number', 'Phone number ', 'max_length[50]|trim'),
        );

        if (!$this->validate($validate)) {

            $this->session->set_flashdata('errors', validation_errors());

            redirect('dashboard/settings');

        } else {

            // Upload Image

            $upload = $this->image_resizing('img');

            $userType = $this->input->post('userType');
            $userId = $this->input->post('userId');
            $data = $this->input->post();

            if ($_FILES['img']['name'] != "") {

                if ($upload) {

                    if ($userType == 'client') {
                        $img_name = $this::model('ClientsInfo')->oneSelectWhere(['image'], ['user_id' => $userId]);
                    } else {
                        $img_name = $this::model('ExpertsInfo')->oneSelectWhere(['image'], ['expert_id' => $userId]);
                    }

                    $mediumPath = FCPATH . './assets/site/site-images/mediumimages/' . $img_name->image;
                    $thumbPath = FCPATH . './assets/site/site-images/thumbimages/' . $img_name->image;
                    $originalPath = FCPATH . './assets/site/site-images/originalimages/' . $img_name->image;

                    if (!empty($img_name->image) && ($img_name->image != 'no_img')) {
                        unlink($mediumPath);
                        unlink($thumbPath);
                        unlink($originalPath);
                    }


                    $data['image'] = $this->upload->file_name;

                } else {
                    $data['image'] = "no_img.png";
                }

            } else {
                $data['image'] = $this->input->post('myimg');
            }


//            if($upload){
//                $img_path=$this::model('ExpertsInfo')->oneSelectWhere('image',['expert_id'=>$userId]);
//                unlink(FCPATH.'./assets/site/site-images/mediumimages/'.$img_path->image);
//                unlink(FCPATH.'./assets/site/site-images/original/'.$img_path->image);
//                unlink(FCPATH.'./assets/site/site-images/thumbimages/'.$img_path->image);
//            }


            $existAddress = $this::model('UserAddress')->oneWhere(['user_id' => $userId]);

            $address = [
                'country' => $data['country'],
                'city' => $data['city'],
                'state' => $data['state'],
                'street' => $data['street'],
                'zip' => $data['zip'],
                'phone_number' => $data['phone_number']
            ];

            if (empty($existAddress)) {
                $address['user_id']=$userId;
                $this::model('UserAddress')->save($address);
            }else{

                $this::model('UserAddress')->updateWhere(['user_id' => $userId],$address);
            }

            if ($userType == 'client') {
                $this::model('ClientsInfo')->updateWhere(['user_id' => $userId], [
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'birthday' => $data['birthday'],
                    'usex' => $data['usex'],
                    'paym_email' => $data['paym_email'],
                    'image' => $data['image'],
                    'update_date' => date("Y-m-d H:i:s")
                ]);

            } else if ($userType == 'expert') {

                if ($upload) {
                    $img_path = $this::model('ExpertsInfo')->oneSelectWhere('image', ['expert_id' => $userId]);
//                unlink(FCPATH.'./assets/site/site-images/mediumimages/'.$img_path->image);
//                unlink(FCPATH.'./assets/site/site-images/original/'.$img_path->image);
//                unlink(FCPATH.'./assets/site/site-images/thumbimages/'.$img_path->image);
                }

                $this::model('ExpertsInfo')->updateWhere(['expert_id' => $userId], [
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'mail_price' => $data['mail_price'],
                    'birthday' => $data['birthday'],
                    'usex' => $data['usex'],
                    'paym_email' => $data['paym_email'],
                    'image' => $data['image'],
                    'update_date' => date("Y-m-d H:i:s")
                ]);

            }

            $this->session->set_flashdata('success', 'Information Successfully Updated');

            redirect('settings');

        }

    }

    /**
     * method userPhoneNumber
     */
    public function userPhoneNumber()
    {
        $number = $this->input->post('number');
        $status = 'error';

        $result = $this::model('UserAddress')->updateWhere(['user_id' => $this->user_id], ['phone_number' => $number]);

        if ($result) {
            $status = 'success';
        }
        echo $this->json('', $status, '');

        exit;
    }

    /**
     *
     */
    public function paymentsView() {

        $chatHistory = $this->model('ChatHistory')->getHistory($this->user_id, $this->user_type);
        $payment = $this->model('Payment')->allWhere(['expert_id' => $this->user_id]);
        $invoices = $this::model('Invoice')->allWhere(['expert_id' => $this->user_id]);
        $users = $this::model('User')->all();

        $total = [
            'chat'      => 0,
            'message'   => 0,
            'invoice'   => 0,
            'withdraw'  => 0,
            'total'     => 0,
            'mine'      => 0,
        ];

        if ($this->user_type == 'client') {
            $experts = array();
            foreach ($users as $user) {
                if ($user->type == 'expert') {
                    $experts[$user->id] = $user;
                }
            }

            $expert_payments = [];
            $messages = [];
            $withdrawals = [];
            foreach ($payment as $item) {
                $total['total'] += $item->amount;

                $total[$item->payment_type] += $item->amount;

                if (! isset($expert_payments[$item->expert_id])) {
                    $expert_payments[$item->expert_id] = [
                        'chat'      => 0,
                        'message'   => 0,
                        'invoice'   => 0,
                        'withdraw'  => 0,
                        'total'     => 0,
                        'commission'=> 0,
                    ];
                }
                if ($item->payment_type != 'withdraw') {
                    $expert_payments[$item->expert_id]['total'] += $item->amount;
                }
                $expert_payments[$item->expert_id]['commission'] += $item->amount / 2;
                $expert_payments[$item->expert_id][$item->payment_type] += $item->amount;

                if ($item->payment_type == 'message') {
                    $messages[] = $item;
                }
            }

            $this->data['total'] = $total;

            $this->data['chatHistory'] = $chatHistory;
            $this->data['payments'] = $payment;
            $this->data['expert_payments'] = $expert_payments;
            $this->data['invoices'] = $invoices;
            $this->data['messages'] = $messages;
            $this->data['withdrawals'] = $withdrawals;
            $this->data['experts'] = $experts;

            $this->data['page']="client/payments";
            $this->load->view('site/layouts/content',$this->data);

        } else if ($this->user_type == 'expert') {
            $clients = array();
            foreach ($users as $user) {
                if ($user->type == 'client') {
                    $clients[$user->id] = $user;
                }
            }

            $client_payments = [];
            $messages = [];
            $withdrawals = [];
            foreach ($payment as $item) {
                $total['total'] += $item->amount;

                $total[$item->payment_type] += $item->amount;

                if ($item->payment_type != 'withdraw') {
                    if (! isset($client_payments[$item->client_id])) {
                        $client_payments[$item->client_id] = [
                            'chat'      => 0,
                            'message'   => 0,
                            'invoice'   => 0,
                            'withdraw'  => 0,
                            'total'     => 0,
                            'commission'=> 0,
                        ];
                    }
                    $client_payments[$item->client_id]['total'] += $item->amount;
                    $client_payments[$item->client_id]['commission'] += $item->amount / 2;
                    $total['mine'] += $item->amount - $item->amount / 2;

                    $client_payments[$item->client_id][$item->payment_type] += $item->amount;
                }

                if ($item->payment_type == 'message') {
                    $messages[] = $item;
                } else if ($item->payment_type == 'withdraw') {
                    $withdrawals[] = $item;
                }
            }

            $this->data['total'] = $total;

            $this->data['chatHistory'] = $chatHistory;
            $this->data['payments'] = $payment;
            $this->data['client_payments'] = $client_payments;
            $this->data['invoices'] = $invoices;
            $this->data['messages'] = $messages;
            $this->data['withdrawals'] = $withdrawals;
            $this->data['clients'] = $clients;

            $this->data['page'] = "expert/payments";

            $this->load->view('site/layouts/content',$this->data);

        }
    }

    /**
     * load messages from ajax
     */
    public function loadMessages()
    {
        $perpage = $this->input->post('perpage');
        $page = $this->input->post('page') ? $this->input->post('page') : 1;
        $search = $this->input->post('search') ? $this->input->post('search') : '';

        $users = [];
        if ($this->user_type == 'client') {
            $experts_all = $this::model('ExpertsInfo')->all();
            foreach ($experts_all as $expert) {
                $users[$expert->expert_id] = $expert;
            }
        } else if ($this->user_type == 'expert') {
            $clients_all = $this::model('ClientsInfo')->all();
            foreach ($clients_all as $client) {
                $users[$client->user_id] = $client;
            }
        }

        $allMessages = $this::model('Message')->getUserInbox($this->user_id, $search);

        $from = $perpage * ($page - 1);
        $messages = array_slice($allMessages, $from, $perpage);

//            echo "<pre>";
//            print_r($allMessages);
//            echo "</pre>";
//            exit;

        $this->_setData([
            'user_type' => $this->user_type,
            'messages' => $messages,
            'message_cnt' => count($allMessages),
            'page' => $page,
            'from' => !count($messages) ? 0 : $from + 1,
            'to' => $from + count($messages),
            'users' => $users,
            'my_id' => $this->user_id,
        ]);

        $this->load->view('site/messages-partial', $this->_getData());
    }

    /**
     * load chat details
     */
    public function loadChatDetails()
    {
        $chat_id = $this->input->post('chat_id');

        $chat = $this->model('ChatHistory')->oneWhere([ 'id' => $chat_id ]);

        $users = [];
        if ($this->user_type == 'client') {
            $experts_all = $this::model('ExpertsInfo')->all();
            foreach ($experts_all as $expert) {
                $users[$expert->expert_id] = $expert;
            }
        } else if ($this->user_type == 'expert') {
            $clients_all = $this::model('ClientsInfo')->all();
            foreach ($clients_all as $client) {
                $users[$client->user_id] = $client;
            }
        }

        $this->_setData([
            'chat'      => $chat,
            'user_type' => $this->user_type,
            'users'     => $users,
        ]);

        $this->load->view('site/chatdetail-partial', $this->_getData());
    }
}
