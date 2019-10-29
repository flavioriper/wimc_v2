<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Processos_model extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('equipamentos_model');
    }

    /**
     * CREATE
     */
    public function addProcesso($processo) {
        if ($this->db->insert('processos', $processo)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function addStatusProcesso($status) {
        if ($this->db->insert('processo_status', $status)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function addEventoProcesso($evento, $fase = null) {
        if ($fase == 4) {
            if ($this->db->insert('processo_eventos_fase4', $evento)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        } else {
            if ($this->db->insert('processo_eventos_fase2', $evento)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        }
    }

    public function addEspelhamento($espelhamento) {
        return $this->db->insert('processo_espelhamento', $espelhamento);
    }

    /**
     * READ
     */
    public function getProcessos($id = null) {
        $this->db->select(
            "p.*, DATE_FORMAT(p.data_uso, '%Y-%m-%d') data_uso_f, DATE_FORMAT(p.data_chegada, '%Y-%m-%d') data_chegada_f, c.nome cliente_nome"
        );
        $this->db->join('clientes c', 'c.id = p.cliente_id', 'left');
        if ($id == null) {
            $processos = $this->db->get('processos p')->result();
            for($i = 0; $i < count($processos); $i++) {
                $processos[$i]->equipamentos = $this->equipamentos_model->getEquipamentosByProcesso($processos[$i]->id, true);
            }
            return $processos;
        } else {
            $this->db->where('p.id', $id);
            $processos = $this->db->get('processos p')->row();
            $processos->equipamentos = $this->equipamentos_model->getEquipamentosByProcesso($processos->id, true);
            return $processos;
        }
    }

    public function getEmbarcadores($id = null) {
        $this->db->where('embarcador', 1);
        if ($id == null) {
            return $this->db->get('clientes c')->result();
        } else {
            $this->db->where('ev.id', $id);
            return $this->db->get('clientes c')->row();
        }
    }

    public function getEspelhamentoByProcesso($processo) {
        $this->db->where('processo_id', $processo);
        return $this->db->get('processo_espelhamento')->row();
    }

    public function getStatusByProcesso($id) {
        $this->db->where('processo_id', $id);
        $this->db->join('status_processo_nome spn', 'spn.id = ps.status_id', 'left');
        $this->db->select(
            "ps.id, ps.status_id, spn.nome, DATE_FORMAT(ps.data_registro, '%d-%m-%Y %H:%i') data"
        );
        $this->db->order_by('ps.id', 'DESC');
        return $this->db->get('processo_status ps')->result();
    }

    public function getEventosByProcesso($id, $fase = null) {
        $this->db->where('processo_id', $id);
        $this->db->select(
            "id, evento, DATE_FORMAT(data_registro, '%d-%m-%Y %H:%i') data"
        );
        $this->db->order_by('id', 'DESC');
        if ($fase == 4) {
            return $this->db->get('processo_eventos_fase4')->result();
        } else {
            return $this->db->get('processo_eventos_fase2')->result();
        }
    }

    public function getUltimoRetorno($processo) {
        $this->db->where('status_id', 5);
        $this->db->order_by('id', 'asc');
        $this->db->select("id, DATE_FORMAT(data_registro, '%d-%m-%Y %H:%i') data");
        return $this->db->get('processo_status')->row();
    }

    /**
     * UPDATE
     */
    public function updateProcesso($id, $processo) {
        $this->db->where('id', $id);
        return $this->db->update('processos', $processo);
    }

    public function updateEspelhamento($id, $espelhamento) {
        $this->db->where('id', $id);
        return $this->db->update('processo_espelhamento', $espelhamento);
    }

    /**
     * DELETE
     */
    public function deleteEquipamento($id) {
        $this->db->where('id', $id);
        return $this->db->delete('equipamentos');
    }

    public function deleteStatusProcesso($status) {
        $this->db->where('id', $status);
        return $this->db->delete('processo_status');
    }

    public function deleteEventoProcesso($evento, $fase = null) {
        $this->db->where('id', $evento);
        if ($fase == 4) {
            return $this->db->delete('processo_eventos_fase4');
        } else {
            return $this->db->delete('processo_eventos_fase2');
        }
    }

    /**
     * Functions
     */
    public function checkNumeroSerie($numSerie) {
        $this->db->where('numero_serie', $numSerie);
        $resultado = $this->db->get('equipamentos')->row();
        if (isset($resultado->id)) {
            return true;
        } else {
            return false;
        }
    }
}