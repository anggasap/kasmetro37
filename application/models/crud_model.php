<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class crud_model extends CI_Model {
     
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
     
    public function create()
    {
		  $pass=$this->input->post('password',true);
		  $passx=md5($pass);
       	  return $this->db->insert('passwd',array(
            'USERNAME'=>$this->input->post('username',true),
			'PASSWORD'=>$passx,
            'USERGROUP'=>$this->input->post('usergroup',true),
			'LIMIT_TARIK'=>$this->input->post('limit_tarik',true),
			'LIMIT_KASUMUM'=>$this->input->post('limit_kasumum',true),
			'LIMIT_SETOR'=>$this->input->post('limit_setor',true),
			'STATUS_USER'=>$this->input->post('status_user',true),
			'NAMA_KOMPUTER'=>$this->input->post('nama_komputer',true),
			'TGL_PASSWORD'=>$this->input->post('tgl_password',true),
			'OUTLET'=>$this->input->post('outlet',true)
        ));
    }
     
    public function update($id)
    {
        $this->db->where('USERID', $id);
        return $this->db->update('passwd',array(
            'USERNAME'=>$this->input->post('username',true),
            'PASSWORD'=>$this->input->post('password',true),
            'USERGROUP'=>$this->input->post('usergroup',true),
			'LIMIT_TARIK'=>$this->input->post('limit_tarik',true),
			'LIMIT_KASUMUM'=>$this->input->post('limit_kasumum',true),
			'LIMIT_SETOR'=>$this->input->post('limit_setor',true),
			'STATUS_USER'=>$this->input->post('status_user',true),
			'NAMA_KOMPUTER'=>$this->input->post('nama_komputer',true),
			'TGL_PASSWORD'=>$this->input->post('tgl_password',true),
			'OUTLET'=>$this->input->post('outlet',true)
        ));
    }
     
     public function delete($id)
    {
        return $this->db->delete('passwd', array('userid' => $id)); 
    }
     
    public function getJson()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'userid';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;
        
        $result = array();
        $result['total'] = $this->db->get('passwd')->num_rows();
        $row = array();
		
		
		$this->db->limit($rows,$offset);
        $this->db->order_by($sort,$order);
        $criteria = $this->db->get('passwd');
        
        foreach($criteria->result_array() as $data)
        {   
            $row[] = array(
                'userid'=>$data['USERID'],
				'username'=>$data['USERNAME'],
                'password'=>$data['PASSWORD'],
                'usergroup'=>$data['USERGROUP'],
                'limit_tarik'=>$data['LIMIT_TARIK'],
				'limit_kasumum'=>$data['LIMIT_KASUMUM'],
				'limit_setor'=>$data['LIMIT_SETOR'],
				'status_user'=>$data['STATUS_USER'],
				'nama_komputer'=>$data['NAMA_KOMPUTER'],
				'tgl_password'=>$data['TGL_PASSWORD'],
				'outlet'=>$data['OUTLET']
            );
        }
        $result=array_merge($result,array('rows'=>$row));
        return json_encode($result);
    }
	
	
}
 
/* End of file crud_model.php */
/* Location: ./application/controllers/crud_model.php */