<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExpertController extends GlobalAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * expertView method
     * @functionality getting all active experts
     * @return array
     */
    public function expertView()
    {
        $config['base_url'] = base_url('admin/experts');
        $config['total_rows'] = $this::model('user')->numRows(['type' => 'expert', 'status' => '1']);
        $config['per_page'] = 5;
        $config['use_page_numbers'] = false;
        $config['full_tag_open'] = '<ul class="pagination pagination-centered">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $data['result'] = $this::model('user')->getExpertsInfo(
            [
                'type' => 'expert',
                'status' => 1,
            ],
            $config['per_page'],
            $this->uri->segment(3)
        );

        $this->load->view('admin/expertView', $data);
    }

    /**
     * expertActivationView method
     * @functionality getting experts whose waiting activation by admin
     * @return array
     */
    public function expertActivationView()
    {
        $config['base_url'] = base_url('admin/experts/activation');
        $config['total_rows'] = $this::model('user')->numRows(['type' => 'expert', 'status' => '2']);
        $config['per_page'] = 50;
        $this->paginationStyle();

        $data['result'] = $this::model('user')->getExpertsInfo(
            [
                'type' => 'expert',
                'status' => 2
            ],
            $config['per_page'],
            $this->uri->segment(3)

        );

        $this->load->view('admin/expertActivationView', $data);
    }

    /**
     * editExpertView method
     * @param $id
     * @functionality by one id getting expert all info
     * @return array
     */
    public function editExpertView($id = false)
    {
        $data['result'] = $this::model('user')->getExpertsInfo([
                'users.id' => $id
            ]
        );
        $this->load->view('admin/editExpertView', $data);
    }

    /**
     * method createExpertCategoriesView
     */
    public function createExpertCategoriesView()
    {
        $this->load->view('admin/createExpertCategoriesView');
    }

    /**
     * method createExpertCategories
     */
    public function createExpertCategories()
    {
        $validate = array(
            array('category_name', 'Category Name', 'required|max_length[100]|xss_clean|trim'),
            array('category_slug', 'Category Slug', 'required|max_length[100]|xss_clean|trim'),
        );

        if (!$this->validate($validate)) {

            $this->session->set_flashdata('errors', validation_errors());

            redirect('admin/categories/create');

        } else {

            $data = $this->input->post();

            $file_name = $_FILES['img']['name'];

            $data['cat_image'] = 'no-img';

            if(!empty($file_name)){
                $config['upload_path'] = FCPATH . './assets/site/categories-images';
                $config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
                $config['max_size'] = 10000;
                $config['max_width'] = 3600;
                $config['max_height'] = 1900;
                $config['encrypt_name'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('img'))
                {
                    $this->load->library('image_lib', $config);

                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }

                $data['image'] = $this->upload->file_name;
            }


            $this::model('ExpertCategories')->save([
                'category_name' => $data['category_name'],
                'category_slug' => $data['category_slug'],
                'status'=> $data['status'],
                'cat_image'=>$data['image']
            ]);
            $this->session->set_flashdata('success', 'Information Successfully Created');
            redirect('admin/categories/create');
        }
    }

    /**
     * method allExpertCategories
     */
    public function allExpertCategories()
    {
        $data['result'] = $this::model('ExpertCategories')->all();
        $this->load->view('admin/allExpertCategoriesView', $data);
    }

    /**
     * method editExpertCategoriesView
     * @param bool $id
     */
    public function editExpertCategoriesView($id = false)
    {
        $data['result'] = $this::model('ExpertCategories')->oneById($id);
        $this->load->view('admin/editExpertCategoriesView', $data);
    }

    /**
     * method editExpertCategories
     */
    public function editExpertCategories()
    {
        $validate = array(
            array('category_name', 'Category Name', 'required|max_length[100]|xss_clean|trim'),
            array('category_slug', 'Category Slug', 'required|max_length[100]|xss_clean|trim'),
        );
        if (!$this->validate($validate)) {
            $this->session->set_flashdata('errors', validation_errors());
            $id = $this->input->post('cat_id');

            redirect('admin/categories/edit/' . $id);
        } else {

            $file_name = $_FILES['img']['name'];

            $config['upload_path'] = FCPATH . './assets/site/categories-images';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|JPG|PNG';
            $config['max_size'] = 10000;
            $config['max_width'] = 50;
            $config['max_height'] = 50;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('img'))
            {
                $this->load->library('image_lib', $config);

                $this->image_lib->initialize($config);
                $this->image_lib->resize();

                $data['cat_image'] = $this->upload->file_name;
            }





            $id = $this->input->post('cat_id');
            $data['category_name'] = $this->input->post('category_name');
            $data['category_slug'] = strtolower(str_replace(' ','-', $this->input->post('category_slug')));
            $data['status'] = $this->input->post('status');

            $this::model('ExpertCategories')->update($id, $data);
            $this->session->set_flashdata('success', 'Information Successfully Updated');

            redirect('admin/categories/edit/' . $id);
        }
    }

    /**
     * method deleteExpertCategories
     */
    public function deleteExpertCategories()
    {
        $id = $this->input->post('id');
        $this::model('ExpertCategories')->delete($id);

        echo $this->json([], 'success', '<p>Category Deleted</p>');
    }

    /**
     * method showExpertView
     * @param bool $id
     */
    public function showExpertView($id = false)
    {
        $result = $this::model('user')->oneWhere(['id' => $id]);
        $experts = $this->model('ExpertsInfo')->oneWhere(['expert_id' => $id]);
        $messages = $this->model('Message')->order('id', 'DESC')->whereOr($id);
        $users = $this->model('user')->all();
        $this->_setData([
            'result' => $result,
            'experts' => $experts,
            'messages' => $messages,
            'users' => $users
        ]);

        $this->load->view('admin/showExpertView', $this->_getData());
    }

    /**
     * method expertRanking
     */
    public function expertRanking()
    {
        $config['base_url'] = base_url('admin/expert_ranking');
        $config['total_rows'] = $this::model('user')->numRows(['type' => 'expert', 'status' => '1']);
        $config['per_page'] = 5;
        $config['use_page_numbers'] = false;
        $config['full_tag_open'] = '<ul class="pagination pagination-centered">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['result'] = $this::model('user')->getExpertsInfo(
            [
                'type' => 'expert',
                'status' => 1,
            ],
            $config['per_page'],
            $this->uri->segment(3),
            [
                'field' => 'expert_order',
                'direction' => 'asc',
            ]
        );

        $this->load->view('admin/expertRanking', $data);
    }
}