<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamentos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('equipamentos_model');
    }

	public function listar() {
		$data['localPath'] = 'equipamentos/listar/';

		$data['equipamentos'] = $this->equipamentos_model->getEquipamentos();
		
		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	public function adicionar() {
		$data['localPath'] = 'equipamentos/adicionar/';

		$data['modelos'] = $this->equipamentos_model->getModelos();
		$data['localizacoes'] = $this->equipamentos_model->getLocalizacoes(null, 2);

		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	public function gerenciar($id) {
		$data['localPath'] = 'equipamentos/gerenciar/';

		$data['modelos'] = $this->equipamentos_model->getModelos();
		$data['localizacoes'] = $this->equipamentos_model->getLocalizacoes();
		$data['status'] = $this->equipamentos_model->getStatus();
		$data['equipamento'] = $this->equipamentos_model->getEquipamentos($id);
		$data['equipamento']->atualizacao_firmware = date('Y-m-d',strtotime($data['equipamento']->atualizacao_firmware));

		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}
	/**
	 * Ações
	 */
	public function add() {
		if ($this->input->post('equipamento')) {
			$equipamento = json_decode($this->input->post('equipamento'));
			$equipamento = array(
				'tipo_equipamento' => $equipamento->tipo_equipamento,
				'numero_serie' => $equipamento->numero_serie,
				'fabricante' => $equipamento->fabricante,
				'imei_sincard' => $equipamento->imei_sincard,
				'atualizacao_firmware' => $equipamento->atualizacao_firmware,
				'localizacao' => $equipamento->localizacao,
				'observacoes' => $equipamento->observacoes,
				'status' => 1
			);
			if ($this->equipamentos_model->checkNumeroSerie($equipamento['numero_serie'])) {
				echo 'erro-505';
				exit;
			}
			$resposta = $this->equipamentos_model->addEquipamento($equipamento);
			if (!$resposta) {
				echo 'erro-500';
			} else {
				echo $resposta;
			}
		}
	}

	public function update() {
		if ($this->input->post('equipamento')) {
			$equipamento = json_decode($this->input->post('equipamento'));
			$id = $equipamento->id;
			$equipamentoAntigo = $this->equipamentos_model->getEquipamentos($id);
			$equipamentoNovo = array(
				'tipo_equipamento' => $equipamento->tipo_equipamento,
				'numero_serie' => $equipamento->numero_serie,
				'fabricante' => $equipamento->fabricante,
				'imei_sincard' => $equipamento->imei_sincard,
				'atualizacao_firmware' => $equipamento->atualizacao_firmware,
				'localizacao' => $equipamento->localizacao,
				'observacoes' => $equipamento->observacoes,
				'status' => $equipamento->status
			);
			if ($equipamentoAntigo->numero_serie != $equipamentoNovo['numero_serie'] && $this->equipamentos_model->checkNumeroSerie($equipamentoNovo['numero_serie'])) {
				echo 'erro-505';
				exit;
			}
			if ($this->equipamentos_model->updateEquipamento($id, $equipamentoNovo)) {
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
