<?php

include_once ("claseForoIngles.php");// incluyo las clases a ser usadas
$action='index';
if(isset($_POST['action']))
{$action=$_POST['action'];}

$view= new stdClass(); 
$view->disableLayout=false;

switch ($action)
{
    case 'index':
        $view->foros=Foro::getForos(); 
        $view->contentTemplate="tablaForos.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; // no usa el layout
        $view->foros=Foro::getForos();
        $view->contentTemplate="tablaForos.php"; // seteo el template que se va a mostrar
        break;
    case 'saveForo':
        // limpio todos los valores antes de guardarlos
        // por las dudas que venga algo raro
		$codigo=intval($_POST['codigo']);
        $nombre=cleanString($_POST['nombre']);
        $detalle=cleanString($_POST['detalle']);
        $cod_postal=intval($_POST['cod_postal']);
        $foro=new Foro($codigo);
		$foro->setCodigoAux($codigo);
        $foro->setNombre($nombre);
        $foro->setDetalle($detalle);
        $foro->setCod_postal($cod_postal);
        $foro->save();
		die;
        break;
    case 'newForo':
        $view->foro=new Foro();
        $view->label='Nuevo Foro';
        $view->disableLayout=true;
        $view->contentTemplate="ventanaForoIngles.php"; // seteo el template que se va a mostrar
        break;
    case 'editForo':
		$editCodigo=intval($_POST['codigo']);
        $view->label='Editar Foro';
        $view->foro=new Foro($editCodigo);
        $view->disableLayout=true;
        $view->contentTemplate="ventanaForoIngles.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteForo':
        $codigo=intval($_POST['codigo']);
        $foro=new Foro($codigo);
        $foro->eliminar();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('layoutForosIngles.php');} // el layout incluye el template adentro
