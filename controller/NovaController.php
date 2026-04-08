<?php

namespace App\Controller;

use App\Helper\DbHelper;
use App\Helper\ViewHelper;
use App\Model\Nova;


/**
 * NovaController
 * 
 */

class NovaController
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

    // listar total noticias
    public function index()
    {
        // permisos
        $this->view->permisos('novas');

        // consulta á bbdd
        $rowset = $this->db->query("SELECT * FROM novas ORDER BY datap DESC");

        // asignar resultados a un array de instancias do modelo
        $novas = [];
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)) {
            array_push($novas, new Nova($row));
        }

        $this->view->vista('admin', 'novas/index', $novas);
    }

    // metodo para activar ou non unha noticia
    public function activar($id)
    {
        // permisos
        $this->view->permisos('novas');

        // consulta á bbdd para obter unha nova
        $rowset = $this->db->query("SELECT * FROM novas WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $nova = new Nova($row);

        if ($nova->activo == 1) {
            // desactivar nova
            $consulta = $this->db->exec("UPDATE novas SET activo=0 WHERE id='$id'");

            // emitir mensaxe e redireccionar 
            ($consulta > 0) ? // comprobación da consulta para ver que non houbo erros
                $this->view->redireccionConMensaxe('admin/novas', 'green', "A nova <strong>$nova->titulo</strong> desactivouse exitosamente.") : $this->view->redireccionConMensaxe('admin/novas', 'red', 'Houbo un erro ao gardar na base de datos.');
        } else {
            // activar nova
            $consulta = $this->db->exec("UPDATE novas SET activo=1 WHERE id='$id'");

            // emitir mensaxe e redireccionar 
            ($consulta > 0) ? $this->view->redireccionConMensaxe('admin/novas', 'green', "A nova <strong>$nova->titulo</strong> activouse exitosamente.") : $this->view->redireccionConMensaxe('admin/novas', 'red', 'Houbo un erro ao gardar na base de datos.');
        }
    }

    // metodo para mostrar no home
    public function home($id)
    {
        // permisos
        $this->view->permisos('novas');

        // consulta á bbdd para obter unha nova
        $rowset = $this->db->query("SELECT * FROM novas WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $nova = new Nova($row);

        if ($nova->home == 1) {
            // quitar a nova do home
            $consulta = $this->db->exec("UPDATE novas SET home=0 WHERE id='$id'");

            // emitir mensaxe e redireccionar 
            ($consulta > 0) ? // comprobación da consulta para ver que non houbo erros
                $this->view->redireccionConMensaxe('admin/novas', 'green', "A nova <strong>$nova->titulo</strong> xa non se mostrará noo home.") : $this->view->redireccionConMensaxe('admin/novas', 'red', 'Houbo un erro ao gardar na base de datos.');
        } else {
            // mostrar nova no home
            $consulta = $this->db->exec("UPDATE novas SET home=1 WHERE id='$id'");

            // emitir mensaxe e redireccionar 
            ($consulta > 0) ? $this->view->redireccionConMensaxe('admin/novas', 'green', "A nova <strong>$nova->titulo</strong> agora mostrarase no home.") : $this->view->redireccionConMensaxe('admin/novas', 'red', 'Houbo un erro ao gardar na base de datos.');
        }
    }

    // crear nova
    public function crear()
    {
        // permisos
        $this->view->permisos('novas');

        // crear unha instancia de Nova
        $nova = new Nova();

        // chamada á vista de edición
        $this->view->vista('admin', 'novas/editar', $nova);
    }

    // eliminar nova
    public function borrar($id)
    {
        // permisos
        $this->view->permisos('novas');

        // obter a nova dende a bbdd
        $rowset = $this->db->query("SELECT * FROM novas WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $nova = new Nova($row);

        $consulta = $this->db->exec("DELETE FROM novas WHERE id='$id'");

        // eliminar a imaxe asociada
        $arquivo = $_SESSION['public'] . 'img/' . $nova->imaxe;
        $texto_imaxe = '';
        if (is_file($arquivo)) {
            unlink($arquivo);
            $texto_imaxe = " e borrouse a imaxe asociada";
        }

        // emitir mensaxe e redireccionar 
        ($consulta > 0) ? $this->view->redireccionConMensaxe('admin/novas', 'green', "A nova <strong>$nova->titulo</strong> foi eliminada correctamente $texto_imaxe.") : $this->view->redireccionConMensaxe('admin/novas', 'red', 'Houbo un erro ao borrar a nova da base de datos.');
    }

    // editar nova
    public function editar($id)
    {
        // permisos
        $this->view->permisos('novas');

        // se se preme o botón gardar...
        if (isset($_POST['gardar'])) {
            // recuperar os datos do formulario de edición
            $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $extracto = filter_input(INPUT_POST, 'extracto', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $autor = filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $datap = filter_input(INPUT_POST, 'datap', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // dar formato á data para gardar en SQL
            $datap = \DateTime::createFromFormat('d-m-Y', $datap)->format('Y-m-d H:i:s');

            // xerar slug (url amigable)
            $slug = $this->view->getSlug($titulo);

            // xestionar a imaxe
            $imaxe_recibida = $_FILES['imaxe'];
            $imaxe = ($_FILES['imaxe']['name']) ? $_FILES['imaxe']['name'] : '';
            //$imaxe_subida = ($_FILES['imaxe']['name']) ? '/var/www/html' . $_SESSION['public'] . 'img/' . $_FILES['imaxe']['name'] : '';
            
            $img_folder = dirname(__DIR__, 1) . '/public/img/';
            
            // crear o cartafol img se non existe
            if (!is_dir($img_folder)) {
                mkdir($img_folder, 0755, true);
            }
            
            $imaxe_subida = ($_FILES['imaxe']['name']) ? $img_folder . $_FILES['imaxe']['name'] : '';
            
            $texto_img = ''; // text para a mensaxe

            if ($id == 'nuevo') {
                // crear unha nova nova
                $consulta = $this->db->exec("INSERT INTO novas 
                (titulo, extracto, autor, datap, texto, slug, imaxe) VALUES 
                ('$titulo', '$extracto', '$autor', '$datap', '$texto', '$slug', '$imaxe')");

                // subir imaxe
                if ($imaxe) {
                    if (is_uploaded_file($imaxe_recibida['tmp_name']) && move_uploaded_file($imaxe_recibida['tmp_name'], $imaxe_subida)) {
                        $texto_img = ' A imaxe subíuse correctamente';
                    } else {
                        $texto_img = ' Houbo un problema ao subir a imaxe';
                    }
                }

                // emitir mensaxe e redireccionar 
                ($consulta > 0) ? $this->view->redireccionConMensaxe('admin/novas', 'green', "A nova <strong>$titulo</strong> creouse correctamente.") : $this->view->redireccionConMensaxe('admin/novas', 'red', 'Houbo un erro ao gardar a nova na base de datos.');
            } else {
                // actualizar unha nova
                $this->db->exec("UPDATE novas SET
                titulo='$titulo', extracto='$extracto', autor='$autor', datap='$datap', texto='$texto', slug='$slug' WHERE id='$id'");

                // subir e/ou actualizar imaxe
                if ($imaxe) {
                    if (is_uploaded_file($imaxe_recibida['tmp_name']) && move_uploaded_file($imaxe_recibida['tmp_name'], $imaxe_subida)) {
                        $texto_img = ' A imaxe subíuse correctamente';
                        $this->db->exec("UPDATE novas SET imaxe='$imaxe' WHERE id='$id'");
                    } else {
                        $texto_img = ' Houbo un problema ao subir a imaxe';
                    }
                }

                // emitir mensaxe e redireccionar 
                $this->view->redireccionConMensaxe('admin/novas', 'green', "A nova <strong>$titulo</strong> aactualizouse correctamente." . $texto_img);
            }
        }
        // se non se obten unha nova amósase a pantalla de edición
        else {
            // obter nova
            $rowset = $this->db->query("SELECT * FROM novas WHERE id='$id' LIMIT 1");
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $nova = new Nova($row);

            // chamara a vista de edición
            $this->view->vista('admin', 'novas/editar', $nova);
        }
    }
}
