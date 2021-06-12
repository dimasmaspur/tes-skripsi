<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends BD_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->auth();
        $this->load->model('Crud');
    }
	
	public function test_post()
	{
       
        $theCredential = $this->user_data;
        $this->response($theCredential, 200); // OK (200) being the HTTP response code
        
	}

    public function users_get()
    {

        $id = $this->get('id');


        if ($id === NULL)
        {
            $getUser = $this->Crud->readData('id,nama,username,alamat,no_telp,role','m_user')->result();
            if ($getUser)
            {
                // Set the response and exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get user',
                    'data'=> $getUser
                ];
                $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No users were found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        if($id){
            $where = [
                'id'=> $id
            ];
            $getUserById = $this->Crud->readData('id,nama,username,alamat,no_telp,role','m_user',$where)->result();

            if($getUserById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get user',
                    'data'=> $getUserById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get User or id Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }

    public function users_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','m_user',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "nama"      => $this->put('nama'),
                    "username"  => $this->put('username'),
                    "password"  => sha1($this->put('password')),
                    "alamat"    => $this->put('alamat'),
                    "no_telp"   => $this->put('no_telp'),
                    "role"      => $this->put('role')
                ];

                $updateData = $this->Crud->updateData('m_user',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit user',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit user',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete user or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }


    public function users_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','m_user',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('m_user',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete user',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete user or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }
    public function  menu_post(){
        $nama = $this->post('nama');
        $harga = $this->post('harga');
        $kategori = $this->post('kategori');
        $image = $this->post('image');
        $dataArray = [
            "nama"=>$nama,
            "harga"=>$harga,
            "kategori"=>$kategori,
            "image"=>$image
        ];

        $createUser = $this->Crud->createData('menu',$dataArray);
                
        if($createUser){
            $output = [
                'status' => 200,
                'error' => false,
                'message' => 'Success create menu',
                'data'=> $dataArray
            ];
            $this->set_response($output, REST_Controller::HTTP_OK); 
        }else{
            $output = [
                'status' => 400,
                'error' => false,
                'message' =>'Failed create menu',
                'data'=> []
            ];
            $this->set_response($output, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function menu_get()
    {

        $id = $this->get('id');


        if ($id === NULL)
        {
            $getUser = $this->Crud->readData('id,nama,harga,kategori,image','menu')->result();
            if ($getUser)
            {
                // Set the response and exit
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get menu',
                    'data'=> $getUser
                ];
                $this->response($output, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'No users were found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        if($id){
            $where = [
                'id'=> $id
            ];
            $getUserById = $this->Crud->readData('id,nama,harga,kategori,image','menu',$where)->result();

            if($getUserById){
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success get menu',
                    'data'=> $getUserById
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed get menu or id Not found',
                    'data'=> []
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
    public function menu_put(){

        $id = (int) $this->get('id');
        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','menu',$where)->num_rows();

            if($cekId > 0){
                $data = [
                    "nama"      => $this->put('nama'),
                    "harga"  => $this->put('harga'),
                    "kategori"  => $this->put('kategori'),
                    "image"  => $this->put('image')
                ];

                $updateData = $this->Crud->updateData('menu',$data,$where);
                if($updateData){
                    $output = [
                        'status' => 200,
                        'error' => false,
                        'message' => 'Success edit menu',
                    ];
                    $this->response($output, REST_Controller::HTTP_OK);
                }else{
                    $output = [
                        'status' => 400,
                        'error' => false,
                        'message' => 'Failed edit menu',
                    ];
                    $this->response($output, REST_Controller::HTTP_BAD_REQUEST); 
                }
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete menu or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }

    }
    public function menu_delete()
    {

        $id = (int) $this->get('id');

        if($id){
            $where = [
                'id'=> $id
            ];
            $cekId = $this->Crud->readData('id','menu',$where)->num_rows();

            if($cekId > 0){
                
                $this->Crud->deleteData('menu',$where);
                $output = [
                    'status' => 200,
                    'error' => false,
                    'message' => 'Success delete menu',
                ];
                $this->response($output, REST_Controller::HTTP_OK);
            }else{
                $output = [
                    'status' => 404,
                    'error' => false,
                    'message' => 'Failed delete menu or id not found',
                ];
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); 
            }
        }
    }
}
