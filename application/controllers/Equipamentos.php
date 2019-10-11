<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamentos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('equipamentos_model');
    }

	public function listar() {
		$data['style'] = 'equipamentos/listar/style';
		$data['script'] = 'equipamentos/listar/script';

		$data['equipamentos'] = $this->equipamentos_model->getEquipamentos();
		
		$this->load->view('template/header', $data);
		$this->load->view('equipamentos/listar/html');
		$this->load->view('template/footer');
	}

	/**
	 * Ações
	 */
	public function excluir() {
		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			if (!$this->equipamentos_model->deleteEquipamento($id)) {
				echo '500';
			}
		} else {
			echo '500';
		}
	}
}
