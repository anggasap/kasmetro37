<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multileveldata extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_multileveldata');
		$this->load->helper('my_helper');
	}
	public function multi_dropdown()
	{
		$data['multilevel'] = $this->m_multileveldata->get_data();
		$this->load->view('multilevel/multilevel_dropdown',$data);
	}
	public function multi_tree()
	{
		$data['multilevel'] = $this->m_multileveldata->get_data();
		$this->load->view('multilevel/multilevel_tree',$data);
	}
	public function multi_combo()
	{
		// dapatkan data child dari id=12 (Propinsi)
		$data['multilevel'] = array(''=>'- pilih -') + $this->m_multileveldata->get_child(12);
		$this->load->view('multilevel/multilevel_combo',$data);
	}
	public function show_child()
	{
		$id = $this->uri->segment(3);
		$combo_level = $this->uri->segment(4);
		$childs = $this->m_multileveldata->get_child($id);
		if(count($childs) > 0)
		{
			$combo_level ++;
			$childs = array(''=>'- pilih -') + $childs;
			echo form_dropdown('tempat_tinggal[]',$childs,'','onchange="show_extra_combo(this,'.$combo_level.')"');
		}
		else
		{
			echo "";
		}
	}
}