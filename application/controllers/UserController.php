<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

  public function index (){

    $getUser = json_decode(file_get_contents(site_url('/api/main/users/')),true);
    $data['result'] = $getUser['data'];

    return $this->load->view('user',$data);
  }

}
