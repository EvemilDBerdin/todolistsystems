<?php

class Login extends MY_Controller
{
    public function index()
    {   
        self::verify();
        $data['title'] = SYSTEMTITLE; 
        $this->load->view('login', $data); 
    }
    public function auth()
    {
        try {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $options['where'] = array(
                'username' => $username,
            );

            $result = getrow('tbl_user', $options, 'row');
            if ($result) {
                if ($result->flag == 0) {
                    $options1 = array(
                        'where' => array(
                            'username' => $username,
                            'password' => $password
                        )
                    );
                    $res = getrow('tbl_user', $options1, 'row');
                    if ($res) {
                        $this->session->set_userdata('userdata', $res);
                        response('200', "success", "You are successfull login.");
                    } else {
                        response('400', "failed", "Incorrect Password"); 
                    }
                } 
                else {
                    response('400', "failed", "Username has beed deleted");
                }
            } else {
                response('400', "error", "Username doesnt exists!");
            }
        } catch (Exception $error) {
            response('400', "error", $error);
        }
    }
    public function register()
    {
        try {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $phonenumber = $this->input->post('phonenumber');
            $email = $this->input->post('email');

            $options['where'] = array(
                'username' => $username,
            );

            $result = getrow('tbl_user', $options, 'row');
            if ($result) {
                response(400, "error", "Username exists!");
            } else {
                $options1 = array(
                    'username' => $username,
                    'password' => md5($password),
                    'phonenumber' => $phonenumber,
                    'email' => $email
                );
                $res = insert('tbl_user', $options1);
                if ($res) {
                    response('200', "success", "You are successfull login.");
                } else {
                    response('400', "failed", "Registration Failed.");
                }
            }
        } catch (Exception $error) {
            response('400', "failed", $error);
        }
    }
    
    

    public function verify(){
        (isset($_SESSION['userdata'])) && (($_SESSION['userdata']->flag == 0) ? redirect(base_url('home')) : redirect(base_url('login')));
    }
}
