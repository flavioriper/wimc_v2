<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Embarcadores extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('embarcadores_model');
		$this->load->model('equipamentos_model');
    }

	public function listar() {
		$data['localPath'] = 'embarcadores/listar/';

		$data['envios'] = $this->embarcadores_model->getEnvios();
		
		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	public function adicionar() {
		$data['localPath'] = 'embarcadores/adicionar/';

		$data['embarcadores'] = $this->embarcadores_model->getEmbarcadores();
		$data['equipamentos'] = $this->equipamentos_model->getEquipamentos(null, 1);

		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	public function gerenciar($id) {
		$data['localPath'] = 'embarcadores/gerenciar/';

		$data['envio'] = $this->embarcadores_model->getEnvios($id);
		$data['embarcadores'] = $this->embarcadores_model->getEmbarcadores();
		$data['equipamentos'] = $this->equipamentos_model->getEquipamentos(null, 1);
		$data['equipamentos_escolhidos'] = $this->equipamentos_model->getEquipamentosByEnvio($id);

		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}
	/**
	 * Ações
	 */
	public function add() {
		if ($this->input->post('envio')) {
			$envio = json_decode($this->input->post('envio'));
			$equipamentos = $envio->equipamentos;
			$envio = array(
				'embarcador_id' => $envio->embarcador,
				'referencia' => $envio->referencia,
				'data_envio' => $envio->dataEnvio,
				'data_entrega' => $envio->dataEntrega,
				'operador' => $envio->operador,
				'remessa' => $envio->remessa
			);
			$resposta = $this->embarcadores_model->addEnvio($envio);
			if (!$resposta) {
				echo 'erro-500';
			} else {
				foreach($equipamentos as $equipamento) {
					$equipamentoDto = array(
						'envio_id' => $resposta, 
						'equipamento_id' => $equipamento->id
					);
					if ($envio['data_entrega'] != '') {
						$this->equipamentos_model->addEquipamentosEnvios($equipamentoDto, 2);
					} else {
						$this->equipamentos_model->addEquipamentosEnvios($equipamentoDto, 3);
					}
				}
				echo $resposta;
			}
		}
	}

	public function update() {
		if ($this->input->post('envio')) {
			$envio = json_decode($this->input->post('envio'));
			$id = $envio->id;
			$envioAntigo = $this->embarcadores_model->getEnvios($id);
			$envioNovo = array(
				'embarcador_id' => $envio->embarcador,
				'referencia' => $envio->referencia,
				'data_envio' => $envio->dataEnvio,
				'data_entrega' => $envio->dataEntrega,
				'operador' => $envio->operador,
				'remessa' => $envio->remessa
			);
			if (json_encode($envio->equipamentos) != json_encode($envioAntigo->equipamentos)) {
				$listaEquipamentos = object_to_array($envio->equipamentos, 'id');
				foreach($envioAntigo->equipamentos as $equipamento) {
					if (!in_array($equipamento->id, $listaEquipamentos)) {
						$this->equipamentos_model->deleteEquipamentosEnvios($equipamento->id, $envio->id);
					}
				}
				$listaEquipamentos = object_to_array($envioAntigo->equipamentos, 'id');
				foreach($envio->equipamentos as $equipamento) {
					if (!in_array($equipamento->id, $listaEquipamentos)) {
						$equipamentoDto = array(
							'envio_id' => $envio->id, 
							'equipamento_id' => $equipamento->id
						);
						if ($envioNovo['data_entrega'] != '') {
							$this->equipamentos_model->addEquipamentosEnvios($equipamentoDto, 2);
						} else {
							$this->equipamentos_model->addEquipamentosEnvios($equipamentoDto, 3);
						}
					}
				}
			} else {
				if ($envioNovo['data_entrega'] != $envioAntigo->data_entrega) {
					foreach($envio->equipamentos as $equipamento) {
						if ($envioNovo['data_entrega'] != '') {
							$this->equipamentos_model->updateEquipamento($equipamento->id, array('status' => 2));
						} else {
							$this->equipamentos_model->updateEquipamento($equipamento->id, array('status' => 3));
						}
					}
				}
			}
			if ($this->embarcadores_model->updateEnvio($id, $envioNovo)) {
				echo '200';
			}
		}
	}

	public function excluir() {
		if ($this->input->post('id')) {
			$id = $this->input->post('id');
			if (!$this->equipamentos_model->deleteEquipamento($id)) {
				echo 'erro-500';
			}
		} else {
			echo 'erro-500';
		}
	}
}
