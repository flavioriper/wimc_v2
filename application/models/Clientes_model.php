<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * CREATE
     */
    public function addCliente($cliente) {
        if ($this->db->insert('clientes', $cliente)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * READ
     */
    public function getClientes($id = null) {
        if ($id == null) {
            return $this->db->get('clientes c')->result();
        } else {
            $this->db->where('c.id', $id);
            return $this->db->get('clientes c')->row();
        }
    }

    /**
     * UPDATE
     */
    public function updateCliente($id, $cliente) {
        $this->db->where('id', $id);
        return $this->db->update('clientes', $cliente);
    }

    /**
     * DELETE
     */
    public function deleteCliente($id) {
        $this->db->where('id', $id);
        return $this->db->delete('clientes');
    }

    /**
     * Functions
     */
}