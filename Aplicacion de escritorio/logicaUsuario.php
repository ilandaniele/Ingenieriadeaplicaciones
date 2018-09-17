<?php

include_once ("claseUsuario.php");// incluyo las clases a ser usadas
$action='index';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view= new stdClass(); 
$view->disableLayout=false;

switch ($action)
{
    case 'index':
        $view->usuarios=Usuario::getUsuarios(); // 
        $view->contentTemplate="tablaUsuarios.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; // no usa el layout
        $view->usuarios=Usuario::getUsuarios();
        $view->contentTemplate="tablaUsuarios.php"; // seteo el template que se va a mostrar
        break;
    case 'saveUsuario':
        // limpio todos los valores antes de guardarlos
        // por las dudas que venga algo raro
		$dni=intval($_POST['dni']);
        $username=cleanString($_POST['username']);
        $password=cleanString($_POST['contra']);
        $nombre_usuario=cleanString($_POST['nombre_usuario']);
        $apellido=cleanString($_POST['apellido']);
		$es_admin=intval($_POST['es_admin']);
        $usuario=new Usuario($dni);
		$usuario->setDniAux($dni);
        $usuario->setUsername($username);
        $usuario->setPassword($password);
        $usuario->setNombre_usuario($nombre_usuario);
        $usuario->setApellido($apellido);
		$usuario->setEs_admin($es_admin);
        $usuario->save();
		die;
        break;
    case 'newUsuario':
        $view->usuario=new Usuario();
        $view->label='Nuevo Usuario';
        $view->disableLayout=true;
        $view->contentTemplate="ventanaUsuario.php"; // seteo el template que se va a mostrar
        break;
    case 'editUsuario':
		$editDni=intval($_POST['dni']);
        $view->label='Editar Usuario';
        $view->usuario=new Usuario($editDni);
        $view->disableLayout=true;
        $view->contentTemplate="ventanaUsuario.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteUsuario':
          $dni=intval($_POST['dni']);
        $usuario=new Usuario($dni);
        $usuario->eliminar();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('layoutUsuarios.php');} // el layout incluye el template adentro
