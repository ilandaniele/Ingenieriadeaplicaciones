<?php

include_once ("claseExpositorIngles.php");// incluyo las clases a ser usadas
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
        $view->expositores=Expositor::getExpositores(); // tree todos los eventos
        $view->contentTemplate="tablaExpositores.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; // no usa el layout
        $view->expositores=Expositor::getExpositores();
        $view->contentTemplate="tablaExpositores.php"; // seteo el template que se va a mostrar
        break;
    case 'saveExpositor':
        // limpio todos los valores antes de guardarlos
        // por las dudas que venga algo raro
		$dni=intval($_POST['dni']);
        $institucion=cleanString($_POST['institucion']);
        $cargo=cleanString($_POST['cargo']);
        $biografia=cleanString($_POST['biografia']);
       
        $expositor=new Expositor($dni);
		$expositor->setDniAux($dni);
        $expositor->setInstitucion($institucion);
        $expositor->setCargo($cargo);
        $expositor->setBiografia($biografia);
        $expositor->save();
		die;
        break;
    case 'newExpositor':
        $view->expositor=new Expositor();
        $view->label='Nuevo Expositor';
        $view->disableLayout=true;
        $view->contentTemplate="ventanaExpositorIngles.php"; // seteo el template que se va a mostrar
        break;
    case 'editExpositor':
		$editDni=intval($_POST['dni']);
        $view->label='Editar Expositor';
        $view->expositor=new Expositor($editDni);
        $view->disableLayout=true;
        $view->contentTemplate="ventanaExpositorIngles.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteExpositor':
          $dni=intval($_POST['dni']);
        $expositor=new Expositor($dni);
        $expositor->eliminar();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('layoutExpositoresIngles.php');} // el layout incluye el template adentro
