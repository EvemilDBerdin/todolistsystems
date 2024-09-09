<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{
	public function __construct()
	{
		date_default_timezone_set("Asia/Manila"); 
		$data['where'] = array(
            'duedate' => date('Y-m-d')
        );
        $data['set'] = array(
            'status' => 'incomplete'
        );
        update('tbl_todo', $data['set'], $data['where']);
	} 

	public $assets_ = array( 
		'login' => array(
			'css' => array(),
			'js' => array(),
		), 
		'Home' => array(
			'css' => array(),
			'js' => array('home.js'),
		), 
		'officer' => array(
			'css' => array(),
			'js' => array('officer.js'),
		),  
	);

	public function page($page, $data = array())
	{
		$data['__assets__'] = $this->assets_;
		$this->load->view('includes/head', $data);
		$this->load->view('includes/aside', $data); 
		$this->load->view($page, $data);
		$this->load->view('includes/footer', $data);
	}
}
