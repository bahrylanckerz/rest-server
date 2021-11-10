<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Persons extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Persons_model');
	}

	public function index_get()
	{
		$id 		= $this->get('id');
		if($id === null){
			$data = $this->Persons_model->get();
			if($data){
				$this->response([
					'status'	=> true,
					'data'		=> $data
				], REST_Controller::HTTP_OK);
			}else{
				$this->response([
					'status'	=> false,
					'message'	=> 'Tidak ada data yang ditampilkan'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			$data = $this->Persons_model->get($id);
			if($data){
				$this->response([
					'status'	=> true,
					'data'		=> $data
				], REST_Controller::HTTP_OK);
			}else{
				$this->response([
					'status'	=> false,
					'message'	=> 'ID tidak ditemukan'
				], REST_Controller::HTTP_NOT_FOUND);
			}
		}
	}

	public function index_post()
	{
		$data = [
			'firstName'	=> $this->post('firstName'),
			'lastName'	=> $this->post('lastName'),
			'gender'	=> $this->post('gender'),
			'address'	=> $this->post('address'),
			'dob'		=> $this->post('dob')
		];
		$insert = $this->Persons_model->insert($data);
		if($insert > 0){
			$this->response([
				'status'	=> true,
				'message'	=> 'Sukses! Data telah ditambahkan',
				'data'		=> $data
			], REST_Controller::HTTP_CREATED);
		}else{
			$this->response([
				'status'	=> false,
				'message'	=> 'Gagal! Tidak ada data yang ditambahkan'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$data = [
			'firstName'	=> $this->put('firstName'),
			'lastName'	=> $this->put('lastName'),
			'gender'	=> $this->put('gender'),
			'address'	=> $this->put('address'),
			'dob'		=> $this->put('dob')
		];
		$id = $this->put('id');
		if($id !== null){
			$update = $this->Persons_model->update($data,$id);
			if($update > 0){
				$this->response([
					'status'	=> true,
					'id'		=> $id,
					'message'	=> 'Sukses! Data telah diubah'
				], REST_Controller::HTTP_OK);
			}else{
				$this->response([
					'status'	=> false,
					'message'	=> 'Gagal! Tidak ada data yang diubah'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			$this->response([
				'status'	=> false,
				'message'	=> 'Gagal! Silahkan masukkan ID yang akan diubah'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');
		if($id !== null){
			$delete = $this->Persons_model->delete($id);
			if($delete > 0){
				$this->response([
					'status'	=> true,
					'id'		=> $id,
					'message'	=> 'Sukses! Data telah dihapus'
				], REST_Controller::HTTP_OK);
			}else{
				$this->response([
					'status'	=> false,
					'message'	=> 'Gagal! Tidak ada data yang dihapus'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			$this->response([
				'status'	=> false,
				'message'	=> 'Gagal! Silahkan masukkan ID yang akan dihapus'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

}

/* End of file Persons.php */
/* Location: ./application/controllers/api/Persons.php */