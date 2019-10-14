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

    /**
     * READ
     */
    public function getEquipamentos($id = null) {
        $this->db->join('status_equipamento se', 'se.id = e.status', 'left');
        $this->db->join('status_localizacao sl', 'sl.id = e.localizacao', 'left');
        $this->db->join('equipamento_modelos em', 'em.id = e.tipo_equipamento', 'left');
        $this->db->select('e.*, se.descricao as status, sl.descricao as localizacao, em.nome as modelo, sl.tipo as tipo_localizacao, sl.id as id_localizacao');
        if ($id == null) {
            return $this->db->get('equipamentos e')->result();
        } else {
            $this->db->where('e.id', $id);
            return $this->db->get('equipamentos e')->row();
        }
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

    /**
     * DELETE
     */
    public function deleteEquipamento($id) {
        $this->db->where('id', $id);
        return $this->db->delete('equipamentos');
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