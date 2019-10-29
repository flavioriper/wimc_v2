<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipamentos_model extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * CREATE
     */
    public function addEquipamento($equipamento) {
        if ($this->db->insert('equipamentos', $equipamento)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function addEquipamentosEnvios($envio, $fase) {
        $this->updateEquipamento($envio['equipamento_id'], array('status' => $fase, 'localizacao' => 5));
        return $this->db->insert('embarcador_envio_equipamentos', $envio);
    }

    /**
     * READ
     */
    public function getEquipamentos($id = null, $status = null) {
        $this->db->join('status_equipamento se', 'se.id = e.status', 'left');
        $this->db->join('status_localizacao sl', 'sl.id = e.localizacao', 'left');
        $this->db->join('equipamento_modelos em', 'em.id = e.tipo_equipamento', 'left');
        $this->db->order_by('em.nome', 'asc');
        if ($status != null) {
            $this->db->where('e.status', $status);
        }
        $this->db->select('e.*, se.descricao as status, e.status as status_id, sl.descricao as localizacao, em.nome as modelo, sl.tipo as tipo_localizacao, sl.id as id_localizacao');
        if ($id == null) {
            return $this->db->get('equipamentos e')->result();
        } else {
            $this->db->where('e.id', $id);
            return $this->db->get('equipamentos e')->row();
        }
    }

    public function getEquipamentosByEnvio($id) {
        $this->db->join('equipamentos e', 'e.id = eve.equipamento_id', 'left');
        $this->db->join('equipamento_modelos em', 'em.id = e.tipo_equipamento', 'left');
        $this->db->where('eve.envio_id', $id);
        $this->db->select('e.*, em.nome as modelo');
        return $this->db->get('embarcador_envio_equipamentos eve')->result();
    }

    public function getEquipamentosByProcesso($id, $dto = false) {
        $this->db->join('equipamentos e', 'e.id = eve.equipamento_id', 'left');
        $this->db->join('equipamento_modelos em', 'em.id = e.tipo_equipamento', 'left');
        $this->db->join('embarcador_envio ev', 'ev.id = eve.envio_id', 'left');
        $this->db->where('eve.processo_id', $id);
        if ($dto) {
            $this->db->select('e.id, e.numero_serie, eve.envio_id');
        } else {
            $this->db->select('e.*, em.nome as modelo, eve.envio_id');
        }
        return $this->db->get('embarcador_envio_equipamentos eve')->result();
    }

    public function getEquipamentosByEmbarcador($embarcador) {
        $this->db->join('equipamentos e', 'e.id = eve.equipamento_id', 'left');
        $this->db->join('equipamento_modelos em', 'em.id = e.tipo_equipamento', 'left');
        $this->db->join('embarcador_envio ev', 'ev.id = eve.envio_id', 'left');
        $this->db->where('ev.embarcador_id', $embarcador);
        $this->db->where('eve.processo_id', 0);
        $this->db->where('e.status', 2);
        $this->db->select('e.*, em.nome as modelo, eve.envio_id');
        return $this->db->get('embarcador_envio_equipamentos eve')->result();
    }

    public function getLocalizacoes($id = null, $tipo = null) {
        if ($tipo != null) {
            $this->db->where('tipo', $tipo);
        }
        if ($id == null) {
            return $this->db->get('status_localizacao sl')->result();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('status_localizacao sl')->row();
        }
    }

    public function getStatus($id = null) {
        if ($id == null) {
            return $this->db->get('status_equipamento se')->result();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('status_equipamento se')->row();
        }
    }

    public function getModelos() {
        return $this->db->get('equipamento_modelos')->result();
    }

    /**
     * UPDATE
     */
    public function updateEquipamento($id, $equipamento) {
        $this->db->where('id', $id);
        return $this->db->update('equipamentos', $equipamento);
    }

    public function addEquipamentoProcesso($envio, $equipamento, $processo) {
        $this->db->where('envio_id', $envio);
        $this->db->where('equipamento_id', $equipamento);
        if ($this->db->update('embarcador_envio_equipamentos', array('processo_id' => $processo))) {
            $this->updateEquipamento($equipamento, array('status' => 5, 'localizacao' => 6));
        };
    }

    public function removeEquipamentoProcesso($envio, $equipamento, $processo) {
        $this->db->where('envio_id', $envio);
        $this->db->where('equipamento_id', $equipamento);
        $this->db->where('processo_id', $processo);
        if ($this->db->update('embarcador_envio_equipamentos', array('processo_id' => 0))) {
            $this->updateEquipamento($equipamento, array('status' => 2, 'localizacao' => 5));
        };
    }

    /**
     * DELETE
     */
    public function deleteEquipamento($id) {
        $this->db->where('id', $id);
        return $this->db->delete('equipamentos');
    }

    public function deleteEquipamentosEnvios($equipamento, $envio) {
        $this->updateEquipamento($equipamento, array('status' => 1, 'localizacao' => 0));
        $this->db->where('envio_id', $envio);
        $this->db->where('equipamento_id', $equipamento);
        return $this->db->delete('embarcador_envio_equipamentos');
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