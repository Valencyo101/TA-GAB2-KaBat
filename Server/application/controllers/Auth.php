<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries\RestController.php');
use RestServer\Libraries\RestController;

class Auth extends RestController {

    public function __construct(){
        parent::__construct();
        $this->load->model('MUmum');
    }

    public function login_post(){
        $request = $this->post();
        $response = null;
        $method = $this->_detect_method();

        try{
            $username = isset($request['username']) ? $request['username'] : '';
            $password = isset($request['password']) ? $request['password'] : '';

            if($username == "" || $password == ""){
                $response = response_error("Username dan password harus diisi");
                $this->set_response($response, RestController::HTTP_BAD_REQUEST);
                return;
            }

            $where = array(
                "username"  => $username
            );

            $user_data = $this->m_common->get('user', $where)->row();

            $response = response_error("Username atau password salah");

            if(isset($user_data)){
                $is_password_valid = verify_password($password, $user_data->password);
                unset($user_data->password);
                if($is_password_valid)
                    $response = response_success();
            }

            if(!$response['success']){
                $this->set_response($response, RestController::HTTP_UNAUTHORIZED);
                return;
            }

            $response = response_success("Login berhasil");
            $this->set_response($response, RestController::HTTP_OK);

        } catch(Exception $ex){

            $response = response_error($ex->getMessage());
            $this->set_response($response, RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

?>