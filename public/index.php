<?php

namespace App;

require '../vendor/autoload.php';

// iniciar sesión para podr pasar variables entre páxinas
session_start();

// incluir controladores
use App\Controller\AppController;
use App\Controller\NovaController;
use App\Controller\UsuarioController;


/*
* asignar as rutas dos cartafoles public e home á sesión
* as rutas son necesarias tanto para resolver vistas e
* tamén poden enlazar imaxes e arquivos css, js,...
*/

$_SESSION['public'] = '/public/';
$_SESSION['home'] = '/public/';


// definir e chamar á función que autocargará a clases cando se instancien 
spl_autoload_register('App\autoload');

function autoload($clase, $dir = null)
{
    //cartafol raís do proxecto
    if (is_null($dir)) {
        $dirname = str_replace('\public', '', dirname(__FILE__));
        $dir = realpath($dirname);
    }

    foreach (scandir($dir) as $file) {
        /* se é un cartafol (e non é do sistema '.') acceder e buscar a clase detro del...*/
        if (is_dir($dir . "/" . $file) and substr($file, 0, 1) !== '.') {
            autoload($clase, $dir . "/" . $file);
        }

        /* se é un arquivo e o seu nome coincide co da clase... */ 
        else if (is_file($dir . "/" . $file) and $file == substr(strrchr($clase, "\\"), 1) . ".php") {
            require($dir . "/" . $file);
        }
    }
}

// para que cada ruta invoque o(s) controlador(es) necesario(s)
function controller($nombre = null)
{
    switch ($nombre) {
        default:
            return new AppController;
        case "novas":
            return new NovaController;
        case "usuarios":
            return new UsuarioController; 
    }
}

// rutas da aplicación

// $ruta = str_replace($_SESSION['home'], '', $_SERVER['REQUEST_URI']);
$ruta = str_replace((string)($_SESSION['home'] ?? ''), '', (string)($_SERVER['REQUEST_URI'] ?? ''));

switch ($ruta) {

    // rutas do frontend
    case "":
    case "/":
        controller()->index();
        break;
    case "acercade":
        controller()->acercade();
        break;
    case "contacto":
        controller()->contacto();
        break;
    case "novas":
        controller()->novas();
        break;
    case(strpos($ruta, "nova/") === 0) :
        controller()->nova(str_replace("nova/", "", $ruta));
        break;


// rutas do backend
case "admin":
case "admin/entrar":
    controller("usuarios")->entrar();
    break;
case "admin/salir":
    controller("usuarios")->salir();
    break;

// admin usuarios
case "admin/usuarios":
    controller("usuarios")->index();
    break;
case "admin/usuarios/crear":
    controller("usuarios")->crear();
    break;
case (strpos($ruta, "admin/usuarios/editar/") === 0):
    controller("usuarios")->editar(str_replace("admin/usuarios/editar/", "", $ruta));
    break;
case (strpos($ruta, "admin/usuarios/activar/") === 0):
    controller("usuarios")->activar(str_replace("admin/usuarios/activar/", "", $ruta));
    break;
case (strpos($ruta, "admin/usuarios/borrar/") === 0):
    controller("usuarios")->borrar(str_replace("admin/usuarios/borrar/", "", $ruta));
    break;

// admin novas
case "admin/novas":
    controller("novas")->index();
    break;
case "admin/novas/crear":
    controller("novas")->crear();
    break;   
case (strpos($ruta, "admin/novas/editar/") === 0):
    controller("novas")->editar(str_replace("admin/novas/editar/", "", $ruta));
    break;
case (strpos($ruta, "admin/novas/activar/") === 0):
    controller("novas")->activar(str_replace("admin/novas/activar/", "", $ruta));
    break;
case (strpos($ruta, "admin/novas/home/") === 0):
    controller("novas")->home(str_replace("admin/novas/home/", "", $ruta));
    break;
case (strpos($ruta, "admin/novas/borrar/") === 0):
    controller("novas")->borrar(str_replace("admin/novas/borrar/", "", $ruta));
    break;
case (strpos($ruta, "admin/") === 0):
    controller("usuarios")->entrar();
    break;

// resto de rutas
default:
    controller()->erros();
}
