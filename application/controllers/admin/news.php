<?php
class news extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}
	public function index()
	{//var_dump($_POST['checkbox']);die;
		if (isset($_POST['delselect'])){//echo 'fdsf';die;
			$checkbox=$_POST['checkbox'];
			
			for($i=0;$i<sizeof($checkbox);$i++ ){
				$this->news_model->del('id',$checkbox[$i]);
			}
			redirect(base_url().'admin/news', 'location');
		} else{
			$data['news']=$this->news_model->get('*','news');
			$this->load->view('admin/news/manage-news.phtml',$data);
		}
	}
	public function add()
	{
		if(!isset($_POST['title'])){
		
			$this->load->view('admin/news/add-news.phtml');
		} else{
			$dataAdd = array(
				'title' => $_POST['title'],
					'content' => $_POST['content']
			);
			if ($this->news_model->insert($dataAdd))
			{
				$this->session->set_flashdata('sessionSuccessAdd', 1);
			}
			//After Success redirect admin import sim
			redirect(base_url().'admin/news', 'location');
		}
	}
	public function edit($num)
	{

			$data['news'] = $this->news_model->get('*','news','','id',$num);
			$this->load->view('admin/news/add-news.phtml',$data);
			if (isset($_POST['title'])){
				$dataEdit =array(
					'title' => $_POST['title'],
						'content' => $_POST['content']
				);
				if ($this->news_model->update($dataEdit,'id='.$num))
				{
					$this->session->set_flashdata('sessionSuccessEdit', 1);
				}
				redirect(base_url().'admin/news', 'location');
			} else{
				//$this->load->view('admin/news/add-news.phtml',$data);				
			}		
	}
	public function del($num)
	{
		if (isset($num)){
			if ($this->news_model->del('id',$num))
			{
				$this->session->set_flashdata('sessionSuccessEdit', 1);
			}
			redirect(base_url().'admin/news', 'location');
		} else{ 
			
			redirect(base_url().'admin/news', 'location');
		}
	}


}