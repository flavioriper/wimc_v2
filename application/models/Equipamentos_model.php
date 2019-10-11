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
     * GET
     */
    public function getEquipamentos($id = null) {
        $this->db->join('status_equipamento se', 'se.id = e.status', 'left');
        $this->db->join('status_localizacao sl', 'sl.id = e.localizacao', 'left');
        $this->db->join('equipamento_modelos em', 'em.id = e.modelo', 'left');
        if ($id == null) {
            $this->db->select('e.*, se.descricao as status, sl.descricao as localizacao, em.nome as modelo');
            return $this->db->get('equipamentos e')->result();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('equipamentos e')->row();
        }
    }

    public function getLocalizacoes($id = null) {
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

    /**
     * DELETE
     */
    public function deleteEquipamento($id) {
        $this->db->where('id', $id);
        return $this->db->delete('equipamentos');
    }
}