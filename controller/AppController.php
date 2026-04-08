<?php

namespace App\Controller;

use App\Model\Nova;
use App\Helper\ViewHelper;
use App\Helper\DbHelper;

/*
* AppController
*
* Esta clase representa o controlador da aplicación
* Manexa a lóxica e o funcionamento de rutas e accións
*
*/

class AppController
{
    public $db;
    public $view;

    public function __construct()
    {
        // conexión coa BBDD
        $dbHelper = new DbHelper();
        $this->db = $dbHelper->db;

        // uso das vistas
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    public function index(){
        // consulta á bbdd
        $rowset = $this->db->query("SELECT * FROM novas WHERE activo=1 AND home=1 ORDER BY datap DESC");

        // asignar os resultados da consulta a un array
        // que se pasara ás instancias do modelo
        $novas = array();
        while($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($novas, new Nova($row));
        }


        // chamar a vista
        $this->view->vista("app", "index", $novas);
    }
    
    public function acercade(){
        // chamar a vista
        $this->view->vista("app", "acercade");
    }
    
    public function contacto(){
        // chamar a vista
        $this->view->vista("app", "contacto");
    }

    public function novas() {
        // consulta á bbdd
        $rowset = $this->db->query("SELECT * FROM novas WHERE activo=1 ORDER BY datap DESC");

        // asignar resultados a un array de instancias do modelo
        $novas = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)) {
            array_push($novas, new Nova($row));
        }
        // chamar á vista
        $this->view->vista('app', 'novas', $novas);
    }

    public function nova($slug) {
        // consulta á bbdd
        $rowset = $this->db->query("SELECT * FROM novas WHERE activo=1 AND slug='$slug' LIMIT 1");

        // asignamos o resultado a unha instancia do modelo
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $nova = new Nova($row);

        $this->view->vista("app", "nova", $nova);
    }

    public function erros(){
        // chamar a vista
        $this->view->vista("app", "404");
    }
    
}
