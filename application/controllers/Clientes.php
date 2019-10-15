<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('clientes_model');
    }

	public function listar() {
		$data['localPath'] = 'clientes/listar/';

		$data['clientes'] = $this->clientes_model->getClientes();
		
		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	public function adicionar() {
		$data['localPath'] = 'clientes/adicionar/';

		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	public function gerenciar($id) {
		$data['localPath'] = 'clientes/gerenciar/';

		$data['cliente'] = $this->clientes_model->getClientes($id);
		$data['cliente']->data_inserido = date('Y-m-d', strtotime($data['cliente']->data_inserido));

		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	/**
	 * Ações
	 */
	public function add() {
		if ($this->input->post('cliente')) {
			$cliente = json_decode($this->input->post('cliente'));
			$cliente = array(
				'nome' => $cliente->nome,
				'cnpj' => $cliente->cnpj,
				'rua' => $cliente->rua,
				'bairro' => $cliente->bairro,
				'cidade' => $cliente->cidade,
				'uf' => $cliente->uf,
				'contato' => json_encode($cliente->contato),
				'obs' => $cliente->obs,
				'prospect' => $cliente->prospect,
				'data_inserido' => $cliente->data_inserido,
				'pais' => $cliente->pais,
				'starcom' => json_encode($cliente->starcom),
				'cep' => $cliente->cep,
				'nickname' => $cliente->nickname,
				'embarcador' => $cliente->embarcador
			);
			$resposta = $this->clientes_model->addCliente($cliente);
			if (!$resposta) {
				echo 'erro-500';
			} else {
				echo $resposta;
			}
		}
	}

	public function update() {
		if ($this->input->post('cliente')) {
			$cliente = json_decode($this->input->post('cliente'));
			$id = $cliente->id;
			$cliente = array(
				'nome' => $cliente->nome,
				'cnpj' => $cliente->cnpj,
				'rua' => $cliente->rua,
				'bairro' => $cliente->bairro,
				'cidade' => $cliente->cidade,
				'uf' => $cliente->uf,
				'contato' => json_encode($cliente->contato),
				'obs' => $cliente->obs,
				'prospect' => $cliente->prospect,
				'data_inserido' => $cliente->data_inserido,
				'pais' => $cliente->pais,
				'starcom' => json_encode($cliente->starcom),
				'cep' => $cliente->cep,
				'nickname' => $cliente->nickname,
				'embarcador' => $cliente->embarcador
			);
			if ($this->clientes_model->updateCliente($id, $cliente)) {
				echo '200';
			}
		}
	}

	public function excluir() {
		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			if (!$this->clientes_model->deleteCliente($id)) {
				echo 'erro-500';
			}
		} else {
			echo 'erro-500';
		}
	}
}
