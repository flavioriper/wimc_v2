<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Embarcadores_model extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * CREATE
     */
    public function addEnvio($envio) {
        if ($this->db->insert('embarcador_envio', $envio)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * READ
     */
    public function getEnvios($id = null) {
        $this->db->join('clientes c', 'c.id = ev.embarcador_id', 'left');
        $this->db->select('ev.*, c.nome');
        if ($id == null) {
            $envios = $this->db->get('embarcador_envio ev')->result();
            for($i = 0; $i < count($envios); $i++) {
                $envios[$i]->equipamentos = $this->getEquipamentos($envios[$i]->id);
            }
            return $envios;
        } else {
            $this->db->where('ev.id', $id);
            $envios = $this->db->get('embarcador_envio ev')->row();
            $envios->equipamentos = $this->getEquipamentos($envios->id);
            return $envios;
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

    public function getEquipamentos($envio) {
        $this->db->where('envio_id', $envio);
        $this->db->join('equipamentos e', 'e.id = eve.equipamento_id', 'left');
        $this->db->select('e.id, e.numero_serie');
        return $this->db->get('embarcador_envio_equipamentos eve')->result();
    }

    /**
     * UPDATE
     */
    public function updateEnvio($id, $envio) {
        $this->db->where('id', $id);
        return $this->db->update('embarcador_envio', $envio);
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