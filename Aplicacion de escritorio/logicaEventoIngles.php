<?php

include_once ("claseEventoIngles.php");// incluyo las clases a ser usadas
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
        $view->eventos=Evento::getEventos(); // tree todos los eventos
        $view->contentTemplate="tablaEventos.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; // no usa el layout
        $view->eventos=Evento::getEventos();
        $view->contentTemplate="tablaEventos.php"; // seteo el template que se va a mostrar
        break;
    case 'saveEvento':
        // limpio todos los valores antes de guardarlos
        // por las dudas que venga algo raro
		$id=intval($_POST['id']);
        $nombre=cleanString($_POST['nombre']);
        $lugar=cleanString($_POST['lugar']);
        $fecha=cleanString($_POST['fecha']);
        $horainicio=cleanString($_POST['horainicio']);
		$horafin=cleanString($_POST['horafin']);
		$detalle=cleanString($_POST['detalle']);
		$nombre_foro=cleanString($_POST['nombre_foro']);
        $evento=new Evento($id);
		$evento->setIdAux($id);
        $evento->setNombre($nombre);
        $evento->setLugar($lugar);
        $evento->setFecha($fecha);
        $evento->setHoraInicio($horainicio);
		$evento->setHoraFin($horafin);
		$evento->setDetalle($detalle);
		$evento->setNombreForo($nombre_foro);
        $evento->save();
		die;
        break;
    case 'newEvento':
        $view->evento=new Evento();
        $view->label='Nuevo Evento';
        $view->disableLayout=true;
        $view->contentTemplate="ventanaEventoIngles.php"; // seteo el template que se va a mostrar
        break;
    case 'editEvento':
		$editId=intval($_POST['id']);
        $view->label='Editar Evento';
        $view->evento=new Evento($editId);
        $view->disableLayout=true;
        $view->contentTemplate="ventanaEventoIngles.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteEvento':
          $id=intval($_POST['id']);
        $evento=new Evento($id);
        $evento->eliminar();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('layoutEventosIngles.php');} // el layout incluye el template adentro
