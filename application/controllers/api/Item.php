<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Item extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Item_model');
	}

	public function index_get()
	{
		$id = $this->get('id');

		if ($id === NULL) {
			$item = $this->Item_model->get_item();
		} else {
			$item = $this->Item_model->get_item($id);
		}

		if ($item) {
			$this->response([
				'status' => true,
				'data'	 => $item
			], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message'	=> 'ID tidak ditemukan'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_post()
	{
		$data = [
			'code'			=> $this->post('code'),
			'name'			=> $this->post('name'),
			'category_id'	=> $this->post('category_id'),
			'unit_id'		=> $this->post('unit_id')
		];

		$insert = $this->Item_model->insert($data);

		if ($insert > 0) {
			$this->response([
				'status' 	=> true,
				'message'	=> 'Data barang berhasil ditambahkan',
				'data'	 	=> $data
			], REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' 	=> false,
				'message'	=> 'Gagal menambahkan data barang'
			], REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function index_put()
	{
		$id = $this->put('id');

		if ($id !== NULL) {
			$data = [
				'code'			=> $this->put('code'),
				'name'			=> $this->put('name'),
				'category_id'	=> $this->put('category_id'),
				'unit_id'		=> $this->put('unit_id'),
				'photo'			=> $this->put('photo')
			];

			$update = $this->Item_model->update($data, $id);

			if ($update > 0) {
				$this->response([
					'status' 	=> true,
					'message'	=> 'Data barang berhasil diperbaharui',
					'data'	 	=> $data
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' 	=> false,
					'message'	=> 'Gagal mengubah data barang'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response([
				'status' 	=> false,
				'message'	=> 'ID tidak ditemukan'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		if ($id !== NULL) {
			$delete = $this->Item_model->delete($id);

			if ($delete > 0) {
				$this->response([
					'status' 	=> true,
					'message'	=> 'Data barang berhasil dihapus'
				], REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' 	=> false,
					'message'	=> 'Gagal menghapus data barang'
				], REST_Controller::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response([
				'status' 	=> false,
				'message'	=> 'ID tidak ditemukan'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

}

/* End of file Item.php */
/* Location: ./application/controllers/api/Item.php */