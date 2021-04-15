<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function index(){

    if($this->session->userdata('token') == ''){
      return redirect(base_url('dashboard/login'));
    }
     $this->load->view('layout/header');
     $this->load->view('layout/sidebar');
     $this->load->view('layout/navbar');
     $this->load->view('dashboard');
     $this->load->view('layout/footer');
  }
  public function login (){
    if($this->session->userdata('token')){
      return redirect(base_url('dashboard'));
    }
    return $this->load->view('login');
  }

  public function prosesLogin(){
    $url = base_url('/api/auth/login');

		$username = $this->input->post('username');
		$password = $this->input->post('password');

    $data = array(
            'username'      => $username,
            'password' => $password 
    );

    $data_string = json_encode($data);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string))
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

    // Send the request
    $result = curl_exec($curl);

    // Free up the resources $curl is using
    curl_close($curl);

    $cekLogin = json_decode($result,true);

    if(isset($cekLogin['status'])){
      echo ("<script LANGUAGE='JavaScript'>
          window.alert('Invalid Login');
          window.location.href='".base_url('dashboard/login')."';
          </script>");
      return;
    }

    $this->session->set_userdata('token', $cekLogin['token']);
    $this->session->set_userdata('username', $username);
    return redirect(base_url('dashboard'));
  }

  public function logout(){
    if($this->session->userdata('token')){
      session_destroy();
    }
    return redirect(base_url('dashboard/login'));
  }
  public function user(){

    if($this->session->userdata('token') == ''){
      return redirect(base_url('dashboard/login'));
    }
     $this->load->view('layout/header');
     $this->load->view('layout/sidebar');
     $this->load->view('layout/navbar');
     $this->load->view('user');
     $this->load->view('layout/footer');
  }
}
