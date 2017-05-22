<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientController extends GlobalAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * clientView method
     * @functionality getting Clients and loading view
     * @return array
     */
    public function clientView()
    {

        $data['result'] = $this::model('user')->allWhere([
            'type' => 'client',
            'status' => 1

        ]);

        $this->load->view('admin/clientView', $data);
    }

    /**
     * editClientView method
     * @param $id
     * @functionality by client  id getting his info
     * @return array
     */
    public function editClientView($id = false)
    {

        $data['result'] = $this::model('user')->getUsersInfo([
                'users.id' => $id
            ]
        );

        $this->load->view('admin/editClientView', $data);
    }

    /**
     * showClientView method
     * @param $id
     * @functionality by client  id getting his info
     * @return array
     */
    public function showClientView($id = false)
    {
        $result = $this::model('user')->getUsersInfo(['users.id' => $id]);
        $clients = $this->model('ClientsInfo')->oneWhere(['user_id' => $id]);
        $messages = $this->model('Message')->order('id', 'DESC')->whereOr($id);
        $total = $this->model('Payment')->allWhere(['client_id' => $id]);
        $users = $this->model('user')->all();
        $this->_setData([
            'result' => $result,
            'clients' => $clients,
            'messages' => $messages,
            'users' => $users,
            'total' => $total
        ]);

        $this->load->view('admin/showClientView', $this->_getData());
    }

    /**
     * notActiveClientView method
     * @functionality getting clients whose not active
     * @return array
     */
    public function notActiveClientView()
    {

        $config['base_url'] = base_url('admin/clients/notActive');
        $config['total_rows'] = $this::model('user')->numRows(['type' => 'client', 'status' => '2']);
        $config['per_page'] = 50;

        $data['result'] = $this::model('user')->allWhere(
            [
                'type' => 'client',
                'status' => 2
            ],
            $config['per_page'],
            $this->uri->segment(3)

        );

        $this->load->view('admin/notActiveClientView', $data);
    }
}