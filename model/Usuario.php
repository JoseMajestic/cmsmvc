<?php

namespace App\Model;

/**
 * Class Usuario
 * 
 * Esta clase representa o obxecto Usuario e as súas propiedades
 * O método constructor inicializa o obxecto cos datos dados
 * 
 */

class Usuario
{

    public $id, $usuario, $contrasinal, $data_acceso, $activo, $usuarios, $novas;

    public function __construct($datat = null)
    {
        $this->id = ($datat) ? $datat->id : null;
        $this->usuario = ($datat) ? $datat->usuario : null;
        $this->contrasinal = ($datat) ? $datat->contrasinal : null;
        $this->data_acceso = ($datat) ? $datat->data_acceso : null;
        $this->activo = ($datat) ? $datat->activo : null;
        $this->usuarios = ($datat) ? $datat->usuarios : null;
        $this->novas = ($datat) ? $datat->novas : null;
    }
}
