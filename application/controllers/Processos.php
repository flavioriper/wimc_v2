<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processos extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('embarcadores_model');
		$this->load->model('equipamentos_model');
		$this->load->model('processos_model');
		$this->load->model('clientes_model');
    }

	public function listar() {
		$data['localPath'] = 'processos/listar/';

		$data['processos'] = $this->processos_model->getProcessos();
		
		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	public function adicionar() {
		$data['localPath'] = 'processos/adicionar/';

		$data['embarcadores'] = $this->embarcadores_model->getEmbarcadores();
		$data['clientes'] = $this->clientes_model->getClientes();

		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}

	public function gerenciar($id, $fase = null) {

		$data['processo'] = $this->processos_model->getProcessos($id);
		$data['equipamentos'] = $this->equipamentos_model->getEquipamentosByEmbarcador($data['processo']->embarcador_id);
		$data['equipamentos_escolhidos'] = $this->equipamentos_model->getEquipamentosByProcesso($id);
		$data['processo_status'] = $this->processos_model->getStatusByProcesso($id);
		$data['processo_eventos'] = $this->processos_model->getEventosByProcesso($id);
		$data['processo_eventos4'] = $this->processos_model->getEventosByProcesso($id, 4);
		$data['espelhamento'] = $this->processos_model->getEspelhamentoByProcesso($id);
		$data['ultimo_retorno'] = $this->processos_model->getUltimoRetorno($id);
		if ($fase == null || $fase > $data['processo']->fase) {
			$data['fase'] = $data['processo']->fase;
		} else {
			$data['fase'] = $fase;
		}
		$data['localPath'] = 'processos/gerenciar/fase_'.$data['fase'].'/';
		$data['embarcadores'] = $this->embarcadores_model->getEmbarcadores();

		$this->load->view('template/header', $data);
		$this->load->view($data['localPath'].'html');
		$this->load->view('template/footer');
	}
	/**
	 * Ações
	 */
	public function add() {
		if ($this->input->post('processo')) {
			$processo = json_decode($this->input->post('processo'));
			$processo = array(
				'fase' => 1,
				'embarcador_id' => $processo->embarcador,
				'cliente_id' => $processo->cliente
			);
			$resposta = $this->processos_model->addProcesso($processo);
			if (!$resposta) {
				echo 'erro-500';
			} else {
				echo $resposta;
			}
		}
	}

	public function update() {
		// Fase 1
		if ($this->input->post('processo1')) {
			$processo = json_decode($this->input->post('processo1'));
			$id = $processo->id;
			$processoAntigo = $this->processos_model->getProcessos($id);
			$processoNovo = array(
				'data_uso' => ($processo->data_uso != '') ? $processo->data_uso : null,
				'cidade_origem' => $processo->cidade_origem,
				'pais_origem' => $processo->pais_origem,
				'cidade_destino' => $processo->cidade_destino,
				'pais_destino' => $processo->pais_destino,
				'endereco_inicial' => $processo->endereco_inicial,
				'endereco_final' => $processo->endereco_final,
				'tipo' => $processo->tipo,
				'porto_saida' => $processo->porto_saida,
				'porto_destino' => $processo->porto_destino,
				'observacao_viagem' => $processo->observacao_viagem,
				'porto_transbordo' => json_encode($processo->porto_transbordo)
			);
			if ($processoAntigo->fase == 5) {
				exit;
			}
			if ($processoNovo['tipo'] == 'terrestre') {
				$processoNovo['transportador'] = $processo->transportador;
				$processoNovo['placa'] = $processo->placa;
				$processoNovo['terrestre_conhecimento'] = $processo->conhecimento;
				$processoNovo['terrestre_motorista'] = $processo->terrestre_motorista;
			}
			if ($processoNovo['tipo'] == 'aereoce') {
				$processoNovo['transportador'] = $processo->transportador;
				$processoNovo['awb'] = $processo->awb;
				$processoNovo['companhias_aereas'] = $processo->companhias_aereas;
				$processoNovo['aereo_voos'] = $processo->aereo_voos;
			}
			if ($processoNovo['tipo'] == 'maritmo') {
				$processoNovo['transportador'] = $processo->transportador;
				$processoNovo['container'] = $processo->container;
				$processoNovo['navio'] = $processo->navio;
				$processoNovo['maritmo_booking'] = $processo->booking;
			}
			if ($processoNovo['tipo'] == 'see-air') {
				$processoNovo['transportador'] = $processo->transportador;
				$processoNovo['terrestre_conhecimento'] = $processo->conhecimento;
				$processoNovo['awb'] = $processo->awb;
				$processoNovo['companhias_aereas'] = $processo->companhias_aereas;
				$processoNovo['aereo_voos'] = $processo->aereo_voos;
				$processoNovo['container'] = $processo->container;
				$processoNovo['navio'] = $processo->navio;
			}
			if ($processoAntigo->fase == 1) {
				$checkFase = true;
				$processoCheck = $processoNovo;
				unset($processoCheck['observacao_viagem']);
				foreach($processoCheck as $value) {
					if ($value == '') {
						$checkFase = false;
					}
				}
				if ($checkFase) {
					$processoNovo['fase'] = 2;
				}
			}
			if (json_encode($processo->equipamentos) != json_encode($processoAntigo->equipamentos)) {
				$listaEquipamentos = object_to_array($processo->equipamentos, 'id');
				foreach($processoAntigo->equipamentos as $equipamento) {
					if (!in_array($equipamento->id, $listaEquipamentos)) {
						$this->equipamentos_model->removeEquipamentoProcesso($equipamento->envio_id, $equipamento->id, $processoAntigo->id);
					}
				}
				$listaEquipamentos = object_to_array($processoAntigo->equipamentos, 'id');
				foreach($processo->equipamentos as $equipamento) {
					if (!in_array($equipamento->id, $listaEquipamentos)) {
						$this->equipamentos_model->addEquipamentoProcesso($equipamento->envio_id, $equipamento->id, $processo->id);
					}
				}
			}
			if ($this->processos_model->updateProcesso($id, $processoNovo)) {
				if (isset($checkFase) && $checkFase) {
					echo 'sucesso-201';
				} else {
					echo 'sucesso-200';
				}
			}
		}

		if ($this->input->post('processo2')) {
			$processo = json_decode($this->input->post('processo2'));
			$id = $processo->id;
			$processoAntigo = $this->processos_model->getProcessos($id);
			$finalizarProcesso = false;
			$processoNovo = array(
				'porto_saida' => $processo->porto_saida,
				'porto_destino' => $processo->porto_destino,
				'navio' => $processo->navio,
				'container' => $processo->container,
				'data_chegada' => $processo->data_chegada,
				'fase_espelhamento' => $processo->espelhamento
			);

			if ($processoAntigo->fase == 5) {
				exit;
			}

			$espelhamento = $this->processos_model->getEspelhamentoByProcesso($id);

			if ($processoNovo['fase_espelhamento'] == 1 && !isset($espelhamento->id)) {
				$this->processos_model->addEspelhamento(array('processo_id' => $id));
			}

			$statusAntigo = $this->processos_model->getStatusByProcesso($id);
			$statusNovos = $processo->status;

			if ($statusAntigo != $statusNovos) {
				date_default_timezone_set('America/Sao_Paulo');
				$listaStatus = object_to_array($statusNovos, 'id');
				foreach($statusAntigo as $status) {
					if (!in_array($status->id, $listaStatus)) {
						$this->processos_model->deleteStatusProcesso($status->id);
					}
				}
				$listaStatus = object_to_array($statusAntigo, 'id');
				$statusNovos = array_reverse($statusNovos);
				foreach($statusNovos as $status) {
					if ($status->id == 0) {
						$statusDto = array(
							'status_id' => $status->status_id,
							'processo_id' => $processo->id,
							'data_registro' => date('Y-m-d H:i:s')
						);
						$this->processos_model->addStatusProcesso($statusDto);
						if ($status->status_id == 6 && !in_array($status->id, $listaStatus)) {
							foreach($processoAntigo->equipamentos as $equipamento) {
								$this->equipamentos_model->updateEquipamento($equipamento->id, array('status' => 9, 'localizacao' => 7));
							}
						}
						if ($status->status_id == 4 && !in_array($status->id, $listaStatus)) {
							if ($processoAntigo->localizacao == 0 || $processoAntigo->status_final == 0) {
								foreach($processoAntigo->equipamentos as $equipamento) {
									$this->equipamentos_model->updateEquipamento($equipamento->id, array('status' => 4, 'localizacao' => 0));
								}
							}
							$finalizarProcesso = true;
						}
					}
				}
			}

			$eventosAntigo = $this->processos_model->getEventosByProcesso($id);
			$eventosNovos = $processo->eventos;

			if ($eventosAntigo != $eventosNovos) {
				date_default_timezone_set('America/Sao_Paulo');
				$listaEventos = object_to_array($eventosNovos, 'id');
				foreach($eventosAntigo as $evento) {
					if (!in_array($evento->id, $listaEventos)) {
						$this->processos_model->deleteEventoProcesso($evento->id);
					}
				}
				$listaEventos = object_to_array($eventosAntigo, 'id');
				$eventosNovos = array_reverse($eventosNovos);
				foreach($eventosNovos as $evento) {
					if ($evento->id == 0) {
						$eventoDto = array(
							'processo_id' => $processo->id,
							'evento' => $evento->evento,
							'data_registro' => date('Y-m-d H:i:s')
						);
						$this->processos_model->addEventoProcesso($eventoDto);
					}
				}
			}

			if ($processoAntigo->fase == 2 || $processoAntigo->fase == 3) {
				$checkFase = false;
				foreach($statusNovos as $status) {
					if ($status->status_id == 5) {
						$checkFase = true;
					}
				}
				if ($checkFase && !$finalizarProcesso) {
					$processoNovo['fase'] = 4;
				}
			}

			if ($finalizarProcesso) {
				$processoNovo['fase'] = 5;
			}

			if ($this->processos_model->updateProcesso($id, $processoNovo)) {
				if (isset($checkFase) && $checkFase) {
					echo 'sucesso-201';
				} else {
					echo 'sucesso-200';
				}
			}
		}

		if ($this->input->post('processo3')) {
			$processo = json_decode($this->input->post('processo3'));
			$espelhamento = $processo->espelhamento_id;
			$id = $processo->id;
			$processoAntigo = $this->processos_model->getProcessos($id);
			$processoNovo = array(
				'gerenciador' => $processo->gerenciador,
				'login_rastreador' => $processo->login_rastreador,
				'senha_rastreador' => $processo->senha_rastreador,
				'motorista_nome' => $processo->motorista_nome,
				'motorista_documento' => $processo->motorista_documento,
				'motorista_caminhao' => $processo->motorista_caminhao,
				'escolta' => $processo->escolta,
				'transportadora' => $processo->transportadora,
				'alteracao_frequencia' => $processo->alteracao_frequencia
			);

			if ($processoAntigo->fase == 5) {
				exit;
			}

			if ($this->processos_model->updateEspelhamento($espelhamento, $processoNovo)) {
				echo 'sucesso-200';
			}
		}

		if ($this->input->post('processo4')) {
			$processo = json_decode($this->input->post('processo4'));
			$id = $processo->id;
			$processoAntigo = $this->processos_model->getProcessos($id);
			$processoNovo = array(
				'solicitacao_coleta' => $processo->solicitacao_coleta,
				'data_retirada' => $processo->data_retirada,
				'operador_logistico' => $processo->operador_logistico,
				'data_chegada' => $processo->data_chegada,
				'numero_remessa' => $processo->numero_remessa,
				'condicoes_equipamento' => $processo->condicoes_equipamento,
				'status_final' => $processo->status_final,
				'localizacao' => $processo->localizacao_final
			);

			if ($processoAntigo->fase == 5) {
				exit;
			}

			if ($processoAntigo->localizacao != $processo->localizacao_final) {
				foreach($processoAntigo->equipamentos as $equipamento) {
					$this->equipamentos_model->updateEquipamento($equipamento->id, array('localizacao' => $processo->localizacao_final));
				}
			}

			if ($processoAntigo->status_final != $processo->status_final) {
				foreach($processoAntigo->equipamentos as $equipamento) {
					$this->equipamentos_model->updateEquipamento($equipamento->id, array('status' => 4));
				}
			}

			$eventosAntigo = $this->processos_model->getEventosByProcesso($id, 4);
			$eventosNovos = $processo->eventos;

			if ($eventosAntigo != $eventosNovos) {
				date_default_timezone_set('America/Sao_Paulo');
				$listaEventos = object_to_array($eventosNovos, 'id');
				foreach($eventosAntigo as $evento) {
					if (!in_array($evento->id, $listaEventos)) {
						$this->processos_model->deleteEventoProcesso($evento->id, 4);
					}
				}
				$listaEventos = object_to_array($eventosAntigo, 'id');
				$eventosNovos = array_reverse($eventosNovos);
				foreach($eventosNovos as $evento) {
					if ($evento->id == 0) {
						$eventoDto = array(
							'processo_id' => $processo->id,
							'evento' => $evento->evento,
							'data_registro' => date('Y-m-d H:i:s')
						);
						$this->processos_model->addEventoProcesso($eventoDto, 4);
					}
				}
			}

			if ($this->processos_model->updateProcesso($id, $processoNovo)) {
				echo 'sucesso-200';
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
