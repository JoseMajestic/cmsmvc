<?php

namespace App\Controller;

use App\Helper\DbHelper;
use App\Helper\ViewHelper;
use App\Model\Usuario;
use DateTime;

/**
 * UsuarioController
 * 
 */

class UsuarioController
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

    public function admin()
    {
        // comprobar permisos
        $this->view->permisos();

        // chamar a vista
        $this->view->vista('admin', 'index');
    }

    public function entrar()
    {
        // se o usuario está previamente identificado
        if (isset($_SESSION['usuario'])) {
            $this->admin();
        } elseif (isset($_POST['acceder'])) {
            // se recuperan os datos do formulario de login
            $campo_usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $campo_contrasinal = filter_input(INPUT_POST, 'contrasinal', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

            // buscar ao usuario na bbdd
            $rowset = $this->db->query("SELECT * FROM usuarios WHERE usuario='$campo_usuario' AND activo=1 LIMIT 1");

            // asignar resultado a instancia da clase Usuario
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $usuario = new Usuario($row);

            //se existe o usuario
            if ($usuario) {
                // comprobar contrasinal
                if (password_verify($campo_contrasinal, $usuario->contrasinal)) {
                    // asignar o usuario e os permisos de sesión
                    $_SESSION['usuario'] = $usuario->usuario;
                    $_SESSION['usuarios'] = $usuario->usuarios;
                    $_SESSION['novas'] = $usuario->novas;

                    // gardar data de ultimo acceso
                    $agora = new \DateTime('now', new \DateTimeZone('Europe/Madrid'));
                    $fecha = $agora->format('Y-m-d H:i:s');
                    $this->db->exec("UPDATE usuarios SET data_acceso='$fecha' WHERE usuario='$campo_usuario'");

                    // emitir mensaxe de benvida e redireccionar
                    $this->view->redireccionConMensaxe('admin', 'green', 'Benvida ao taboleiro de administración.');
                } else {
                    // emitir mensaxe de erro e redireccionar
                    $this->view->redireccionConMensaxe('admin', 'red', 'Contrasinal incorrecto.');
                }
            } else {
                // emitir mensaxe e redireccionar
                $this->view->redireccionConMensaxe('admin', 'red', 'Non existe ningún usuario con ese nome.');
            }
        }
        //redirecion á páxina de acceso
        else {
            // emitir mensaxe e redireccionar
            $this->view->vista('admin', 'usuarios/entrar');
        }
    }


    public function salir()
    {
        // borrar sesión do usuario
        unset($_SESSION['usuario']);

        // emitir mensaxe e redireccionar
        $this->view->redireccionConMensaxe('admin', 'green', 'Desconectáchete con éxito.');
    }


    // listado de usuarios
    public function index(){
        // permisos
        $this->view->permisos('usuarios');

        // consultar usuarios na bbdd
        $rowset = $this->db->query('SELECT * FROM usuarios ORDER BY usuario ASC');

        // asignar resultados a un array de instancias do modelo
        $usuarios = [];
        while($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($usuarios, new Usuario($row));
        }

        $this->view->vista('admin', 'usuarios/index', $usuarios);
    }


    // para activar e desactivar usuario(S)
    public function activar($id){
         // permisos
        $this->view->permisos('usuarios');

        // consultar usuario na bbdd
        $rowset = $this->db->query("SELECT * FROM usuarios WHERE id='$id' LIMIT 1");
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $usuario = new Usuario($row);

        if ($usuario->activo == 1) {
            $consulta = $this->db->exec("UPDATE usuarios SET activo=0 WHERE id='$id'");

            // emitir mensaxe e redireccionar
            ($consulta > 0) ? 
            $this->view->redireccionConMensaxe('admin/usuarios', 'green', "O usuario <strong>$usuario->usuario</strong> desactivouse correctamente.") 
            : $this->view->redireccionConMensaxe('admin/usuarios', 'red',"Houbo un erro ao gardar na base de datos.");
        } else {
            $consulta = $this->db->exec("UPDATE usuarios SET activo=1 WHERE id='$id'");

            // emitir mensaxe e redireccionar
            ($consulta > 0) ? 
            $this->view->redireccionConMensaxe('admin/usuarios', 'green', "O usuario <strong>$usuario->usuario</strong> activouse correctamente.")
            : $this->view->redireccionConMensaxe('admin/usuarios', 'red',"Houbo un erro ao gardar na base de datos");
        }
    }
    

    // para borrar usuario(S)
    public function borrar($id){
        // permisos
        $this->view->permisos('usuarios');

        // consultar usuario na bbdd
        $consulta = $this->db->exec("DELETE * FROM usuarios WHERE id='$id'");

            // emitir mensaxe e redireccionar
            ($consulta > 0) ? 
            $this->view->redireccionConMensaxe('admin/usuarios', 'green', "O usuario foi eliminado correctamente.")
            : $this->view->redireccionConMensaxe('admin/usuarios', 'red',"Houbo un erro ao consultar a base de datos");
        
    }


    // para crear usuario(S)
    public function crear(){
        // permisos
        $this->view->permisos('usuarios');

        // crear nova instancia de usuario baleira
        $usuario = new Usuario();

        // chamar á xanela de edición
        $this->view->vista('admin', 'usuarios/editar', $usuario);
    }

    

    // para editar usuario(S)
    public function editar($id){
        // permisos
        $this->view->permisos('usuarios');
        
        // se se preme o botón de gardar
        if (isset($_POST['gardar'])){
            // recuperar os datos do formulario
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $contrasinal = filter_input(INPUT_POST, 'contrasinal', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $usuarios = (filter_input(INPUT_POST, 'usuarios', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES) == 'on') ? 1 : 0;
            $novas = (filter_input(INPUT_POST, 'novas', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES) == 'on') ? 1 : 0;
            $cambiar_contrasinal = (filter_input(INPUT_POST, 'cambiar_contrasinal', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES) == 'on') ? 1 : 0;

            // encriptar o contrasinal
            $contrasinal_encriptada = ($contrasinal) ? password_hash($contrasinal, PASSWORD_BCRYPT, ['cost' => 12]) : '';

            if($id == 'nuevo'){
                // crear novo usuario
                $this->db->exec("INSERT INTO usuarios (usuario, contrasinal, novas, usuarios) VALUES ('$usuario', '$contrasinal_encriptada', $novas, $usuarios)");

                // emitir mensaxe e redireccionar
                $this->view->redireccionConMensaxe('admin/usuarios', 'green', "O usuario <strong>$usuario</strong> creouse correctamente.");
            }
            else {
                // actualizar o usuario
                ($cambiar_contrasinal) ?
                $this->db->exec("UPDATE usuarios SET usuario='$usuario', contrasinal='$contrasinal_encriptada', novas=$novas, usuarios=$usuarios WHERE id='$id'") :
                $this->db->exec("UPDATE usuarios SET usuario='$usuario', novas=$novas, usuarios=$usuarios WHERE id='$id'");

                // emitir mensaxe e redireccionar
                $this->view->redireccionConMensaxe('admin/usuarios', 'green', "O usuario <strong>$usuario</strong> actualizouse correctamente.");
            }

        // se non, obter usuario e mostro a xanela de edición
        } else {
            // obter usuario
            // consultar usuarios na bbdd
            $rowset = $this->db->query("SELECT * FROM usuarios WHERE id='$id' LIMIT 1");
            $row = $rowset->fetch(\PDO::FETCH_OBJ);
            $usuario = new Usuario($row);

            // camar a vista de edición
            $this->view->vista('admin', 'usuarios/editar', $usuario);
        }
    }
}
