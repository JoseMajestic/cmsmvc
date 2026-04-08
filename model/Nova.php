<?php

namespace App\Model;

/**
 * Class Nova
 * 
 * Esta clase representa o obxecto Nova e as súas propiedades
 * O método constructor inicializa o obxecto cos datos dados
 * 
 */

class Nova
{

    // propiedades do obxecto
    public $id;
    public $titulo;
    public $slug;
    public $extracto;
    public $texto;
    public $activo;
    public $home;
    public $datap;
    public $autor;
    public $imaxe;


    public function __construct($datat = null)
    {
        $this->id = ($datat) ? $datat->id : null;
        $this->titulo = ($datat) ? $datat->titulo : null;
        $this->slug = ($datat) ? $datat->slug : null;
        $this->extracto = ($datat) ? $datat->extracto : null;
        $this->texto = ($datat) ? $datat->texto : null;
        $this->activo = ($datat) ? $datat->activo : null;
        $this->home = ($datat) ? $datat->home : null;
        $this->datap = ($datat) ? $datat->datap : null;
        $this->autor = ($datat) ? $datat->autor : null;
        $this->imaxe = ($datat) ? $datat->imaxe : null;
    }
}
