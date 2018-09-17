<?php

include_once ("clasePresenta.php");// incluyo las clases a ser usadas
$action='index';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view= new stdClass(); // creo una clase standard para contener la vista, donde la cual tendrá atributos que yo defina
$view->disableLayout=false;// creo la variable disableLayout, marca si usa o no el layout , si no lo usa imprime directamente el template

// para no utilizar un framework y simplificar las cosas uso este switch, la idea
// es que puedan apreciar facilmente cuales son las operaciones que se realizan
switch ($action)
{
    case 'index':
        $view->presentas=Presenta::getPresenta(); // tree todos los eventos
        $view->contentTemplate="tablaPresenta.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; // no usa el layout
        $view->presentas=Presenta::getPresenta();
        $view->contentTemplate="tablaPresenta.php"; // seteo el template que se va a mostrar
        break;
    case 'savePresenta':
        // limpio todos los valores antes de guardarlos
        // por las dudas que venga algo raro
		$dni=intval($_POST['dni']);
        $id=intval($_POST['id']);
		$idVieja=intval($_POST['idVieja']);
        $presenta=new Presenta($dni,$idVieja);
		$presenta->setDniAux($dni);
        $presenta->setIdAux($id);
		$presenta->setIdVieja($idVieja);
        $presenta->save();
		die;
        break;
    case 'newPresenta':
        $view->presenta=new Presenta();
        $view->label='Nuevo Presenta';
        $view->disableLayout=true;
        $view->contentTemplate="ventanaPresenta.php"; // seteo el template que se va a mostrar
        break;
    case 'editPresenta':
		$editDni=intval($_POST['dni']);
		$editId=intval($_POST['id']);
        $view->label='Editar Presenta';
        $view->presenta=new Presenta($editDni,$editId);
        $view->disableLayout=true;
        $view->contentTemplate="ventanaPresenta.php"; // seteo el template que se va a mostrar
        break;
    case 'deletePresenta':
          $dni=intval($_POST['dni']);
		  $id=intval($_POST['id']);
		  $presenta=new Presenta($dni,$id);
		  $presenta->eliminar();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('layoutPresenta.php');} // el layout incluye el template adentro
