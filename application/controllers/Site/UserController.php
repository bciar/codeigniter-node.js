<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class UserController
 */
class UserController extends MY_Controller
{

    /**
     * @var
     */
    public $user_id;
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->user_id = $this->session->userdata('UserLoggedId');
    }
    
    /**
     * method register_user
     * @functionality Registering user in db(user)
     * @return JSON
     **/
    public function registerClient(){

        $validate=array(
            array('email','Email','required|min_length[8]|max_length[40]|valid_email|xss_clean|trim'),
            array('password','Password','required|min_length[6]|max_length[30]|xss_clean|trim'),
            array('screen_name','Screen name','required|min_length[5]|max_length[20]|xss_clean|trim'),

        );
        if(!$this->validate($validate))
            echo $this->json([], 'error', validation_errors());
        else {
            $data           = $this->input->post();
            $email_unique   = $this::model('user')->oneWhere(['email'=>$data['email']]);
            if(is_null($email_unique)){
                $data['password']=password_hash($data['password'],PASSWORD_BCRYPT);
                $insert_id = $this::model('user')->save([
                    'email'         => $data['email'],
                    'password'      => $data['password'],
                    'screen_name'   => $data['screen_name'],
                    'type'          => 'client',
                    'created_day'   => date("Y-m-d H:i:s"),
                    'last_visit'    => date("Y-m-d H:i:s"),
                    'status'        => 1

                ]);
                $this::model('user')->saveTwoTables(
                    'clients_info',
                    [
                        'user_id' => $insert_id,
                        'image'   => 'no_img.png'
                    ]
                );

                /* Auto Login  */

                $auto_login=$this->input->post('auto_login');

                if(isset($auto_login)){

                    $email          = $this->input->post('email');
                    $password       = $this->input->post('password');
                    $getUser        = $this::model('user')->oneWhere([
                        'email' => $email,
                        'status'=> 1
                    ]);

                    if (!is_null($getUser) && password_verify($password, $getUser->password)) {

                        $this->session->set_userdata([
                            'isLoggedIn'        => true,
                            'UserLoggedId'      => $getUser->id,
                            'UserType'          => $getUser->type,
                            'UserStatus'        => $getUser->status,
                            'UserScreenName'    => $getUser->screen_name,
                        ]);

                        echo $this->json([], 'success_auto', '<p>Welcome </p>');
                    }
                }else{
                    echo $this->json([],'success','<p>Your are successfully registered</p>');
                }
            }
            else
            {
                echo $this->json([],'error','<p>Mail is registered,Choose another one</p>');
            }
        }
    }

    /**
     * method register_expert
     * @functionality Registering expert in db(user,experts_info)
     * @return JSON
     **/
    public function registerExpert(){

        $validate=array(
            array('expert_email','Email','required|min_length[8]|max_length[40]|valid_email|xss_clean|trim'),
            array('expert_password','Password','required|min_length[6]|max_length[30]|xss_clean|trim'),
            array('expert_screen_name','Screen name','required|min_length[5]|max_length[20]|xss_clean|trim'),
            array('expert_type','Expert Type','required|trim'),
            array('expert_bried_desctiption','Bried Description','required|min_length[5]|max_length[175]|xss_clean|trim'),
            array('expert_services','About My Services','required|min_length[5]|max_length[175]|xss_clean|trim'),
            array('expert_degrees','Degrees','required|min_length[5]|max_length[175]|xss_clean|trim'),
            array('expert_type','Expert Type','required|trim'),
            array('expert_qualifications','Experience & Qualifications','required|min_length[5]|max_length[175]|xss_clean|trim'),
            array('expert_email_price','Email Render','required|numeric|xss_clean|trim'),
        );

        if(!$this->validate($validate))

            echo $this->json([], 'error_e', validation_errors());

        else {

            $data           = $this->input->post();
            $email_unique   = $this::model('user')->oneWhere(['email' => $data['expert_email']]);

            if (is_null($email_unique)) {
                $data['expert_password'] = password_hash($data['expert_password'], PASSWORD_BCRYPT);

                $insert_id=$this::model('user')->save([
                    'email'              => $data['expert_email'],
                    'password'           => $data['expert_password'],
                    'screen_name'        => $data['expert_screen_name'],
                    'type'               => 'expert',
                    'created_day'        => date("Y-m-d H:i:s"),
                    'last_visit'         => date("Y-m-d H:i:s"),
                    'status'             => 2

                ]);

                $this::model('user')->saveTwoTables(

                    'experts_info',

                    [
                        'expert_id'              => $insert_id,
                        'expert_type'            => $data['expert_type'],
                        'bried_description'      => $data['expert_bried_desctiption'],
                        'services'               => $data['expert_services'],
                        'degrees'                => $data['expert_degrees'],
                        'expert_qualifications'  => $data['expert_qualifications'],
                        'mail_price'             => $data['expert_email_price'],
                        'image'                  => 'no_img.png'

                    ]);


                echo $this->json([], 'success_e', '<p>Your details have been sent to Administrator you will be notified soon via email </p>');
                exit;
            }
            else
            {
                echo $this->json([], 'error_e', '<p>Mail is registered,Choose another one</p>');
                exit;
            }
        }
    }

    /**
     * method login
     */
    public function login(){

        $validate=array(
            array('email','Email','required|valid_email|xss_clean|trim'),
            array('password','Password','required|xss_clean|trim'),
        );


//        $url = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=<your_api_key>&ip=".$_SERVER['REMOTE_ADDR']."&format=json"));


        if(!$this->validate($validate))

            echo $this->json([], 'error', validation_errors());

        else {

            $email          = $this->input->post('email');
            $password       = $this->input->post('password');

            $getUser        = $this::model('user')->oneWhere([
                'email' => $email,
                'status'=> 1
            ]);

            if (!is_null($getUser) && password_verify($password, $getUser->password)) {


                
                $this->session->set_userdata([
                    'isLoggedIn'        =>true,
                    'UserLoggedId'      =>$getUser->id,
                    'UserType'          =>$getUser->type,
                    'UserStatus'        =>$getUser->status,
                    'UserScreenName'    =>$getUser->screen_name,
                ]);

                if($getUser->type == 'client'){

                    $balance = $this::model('UserBalances')->getBalance($getUser->id);

                    $balance = (empty($balance->amount))? 0 : $balance->amount;

                    $this->session->set_userdata([
                        'balance'=>$balance
                    ]);

                }elseif($getUser->type == 'expert'){

                    $this->session->set_userdata([
                        'expertRate'=>'5'
                    ]);

                    $balance = $this::model('UserBalances')->getBalance($getUser->id);

                    $balance = (empty($balance->amount))? 0 : $balance->amount;

                    $this->session->set_userdata([
                        'balance'=>$balance
                    ]);

                }


                echo $this->json([], 'success', '<p>Welcome </p>');

            } else {

                echo $this->json([], 'error', '<p>Username or/and Email is Wrong</p>');
            }
        }
    }

    /**
     * method logout
     */
    public function logout(){
        $this->session->set_userdata([
            'isLoggedIn'    =>false,
            'UserLoggedId'  =>null,
            'UserType'      =>null,
            'UserStatus'    =>null,
            'balance'    =>null,
        ]);

        redirect(base_url());
    }
    
    /**
     * method getPaymentClient
     */
    public function getPaymentClient()
    {
        $userId = $this->session->userdata('UserLoggedId');
        $top_up = 0;
        $pay = 0;
        $account = $this::model('Payment')->allWhere(['client_id' => $userId]);
        foreach ($account as $item) {
            if ($item->type == 'top_up') {
                $top_up += $item->amount;
            } elseif ($item->type == 'pay') {
                $pay += $item->amount;
            }
        }
        if ($this->input->post('getPayment')) {
            echo $top_up - $pay;
        } else {
            return $top_up - $pay;
        }
    }

    /**
     * method getPaymentClient
     */
    public function getExpertChatPrice()
    {
        $expert_id = $this->input->post('expert_id');

        $chat_price = $this::model('ExpertsInfo')->oneWhere(['expert_id' => $expert_id]);



        $chat_price = (float)$chat_price->chat_price;

        echo json_encode($chat_price);
    }

    /**
     * method getPaymentExpert
     */
    public function getPaymentExpert()
    {
        $userId = $this->session->userdata('UserLoggedId');
        $result = 0;
        $account = $this::model('Payment')->allWhere(['expert_id' => $userId]);
        foreach ($account as $item) {
            $result += $item->amount;

        }

        return $result;
    }
    
    /**
     * method setPayment
     */
    public function setPayment()
    {
        /*
         * (
    [spent_time] => 0.050
    [expert_rate] => 7.21
    [end_time] => 2017-03-31T23:17:30.883Z
    [amount] => 0.361
    [chat_to] => Array
        (
            [name] => Hrair
            [id] => 15
        )

    [chat_from] => Array
        (
            [name] => Gevor
            [id] => 27
        )
         */
        if ($this->input->post('amount')) {
            $amount = $this->input->post('amount');
            $client = $this->input->post('chat_from');
            $expert = $this->input->post('chat_to');
            $expert_rate = $this->input->post('expert_rate');
            $start_time = $this->input->post('start_time');
            $end_time = $this->input->post('end_time');
            $spent_time = $this->input->post('spent_time');

            if ($amount) {
                // save in chat history
                $pay_expert_amount = floor($amount / 2);

                $this::model('ChatHistory')->save([
                    'client_id'     => $client['id'],
                    'expert_id'     => $expert['id'],
                    'start_time'    => date('Y-m-d H:i:s', strtotime($start_time)),
                    'end_time'      => date('Y-m-d H:i:s', strtotime($end_time)),
                    'spent_time'    => $spent_time,
                    'expert_rate'   => $expert_rate,
                    'total_price'   => $amount,
                    'expert_earning'=> $pay_expert_amount,
                    'is_paid'       => 1,
                    'paid_time'     => date('Y-m-d H:i:s'),
                ]);

                $this::model('Payment')->save([
                    'amount' => $amount,
                    'client_id' => $client['id'],
                    'expert_id' => $expert['id'],
                    'currency_code' => "USD",
                    'type' => 'top_up',
                    'payment_type' => 'chat',
                ]);

                $this->model('UserBalances')->updateBalance(-$amount);

                // also pay expert half amount
                $this->model('UserBalances')->payExpert($expert['id'], $pay_expert_amount);

            }

            echo $amount;
            exit;
        }
    }

    /**
     * 
     */
    public function saveChat()
    {
        $data = $this->input->post();

        $name_1 = 'from'.$data['from'].'_'.'to'.$data['to'].'.json';
        $name_2 = 'from'.$data['to'].'_'.'to'.$data['from'].'.json';

        $path_1= FCPATH.'chat-messages/'.$name_1;
        $path_2= FCPATH.'chat-messages/'.$name_2;

        $pathUrl = $path_1;

        // gets and adds form data into an array
        $formdata = array(
            'to'=> $data['to'],
            'from'=> $data['from'],
            'message'=> $data['message'],
            'date'=> Date('Y-m-d H:i:s'),
        );

        // path and name of the file

        $arr_data = array();        // to store all form data

        // check if the file exists
        if(file_exists($path_2)) {
            $pathUrl = $path_2;
        }

        if(file_exists($path_1) || file_exists($path_2) ) {

            $jsondata = file_get_contents($pathUrl);

            // converts json string into array
            $arr_data = json_decode($jsondata, true);
        }


        $arr_data[] = $formdata;

        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);

        file_put_contents($pathUrl, $jsondata);
    }

    /**
     *
     */
    public function getChat()
    {
        $to = $this->input->post('to');
        
        $from = $this->user_id;

        $path_1 =  FCPATH.'chat-messages/'.'from'.$from.'_'.'to'.$to.'.json';
        $path_2 =  FCPATH.'chat-messages/'.'from'.$to.'_'.'to'.$from.'.json';


        if(file_exists($path_1) ) {

            $jsondata = file_get_contents($path_1);

            // converts json string into array
        }else if(file_exists($path_2)){

            $jsondata = file_get_contents($path_2);

        }

        $arr_data = json_decode($jsondata, true);




        echo $this->json($arr_data, 'success');


    }

    /**
     *
     */
    public function saveMessage()
    {
        $data = $this->input->post();

        $data['from'];
        $data['to'];

        // gets and adds form data into an array
        $formdata = array(
            'to'=> $data['to'],
            'from'=> $data['from'],
            'message'=> $data['message'],
            'date'=> Date('Y-m-d H:i:s'),
        );

        // path and name of the file

        $arr_data = array();        // to store all form data

        // check if the file exists
        if(file_exists($path_2)) {
            $pathUrl = $path_2;
        }

        if(file_exists($path_1) || file_exists($path_2) ) {

            $jsondata = file_get_contents($pathUrl);

            // converts json string into array
            $arr_data = json_decode($jsondata, true);
        }


        $arr_data[] = $formdata;

        $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);

        file_put_contents($pathUrl, $jsondata);
    }

  
}
