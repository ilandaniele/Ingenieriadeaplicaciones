<?php

include_once ("claseCiudad.php");// incluyo las clases a ser usadas
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
        $view->ciudad=Ciudad::getCiudad(); // tree todos los eventos
        $view->contentTemplate="tablaCiudad.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; // no usa el layout
        $view->ciudad=Ciudad::getCiudad();
        $view->contentTemplate="tablaCiudad.php"; // seteo el template que se va a mostrar
        break;
    case 'saveCiudad':
        // limpio todos los valores antes de guardarlos
        // por las dudas que venga algo raro
		$cod_postal=intval($_POST['cod_postal']);
        $nombre=cleanString($_POST['nombre']);
        $inf_turistica=cleanString($_POST['inf_turistica']);
        
        $ciudad=new Ciudad($cod_postal);
		$ciudad->setCodigoPostalAux($cod_postal);
        $ciudad->setNombre($nombre);
        $ciudad->setInformacionTuristica($inf_turistica);
        $ciudad->save();
		die;
        break;
    case 'newCiudad':
        $view->ciudad=new Ciudad();
        $view->label='Nueva Ciudad';
        $view->disableLayout=true;
        $view->contentTemplate="ventanaCiudad.php"; // seteo el template que se va a mostrar
        break;
    case 'editCiudad':
		$Editcod_postal=intval($_POST['cod_postal']);
        $view->label='Editar Ciudad';
        $view->ciudad=new Ciudad($Editcod_postal);
        $view->disableLayout=true;
        $view->contentTemplate="ventanaCiudad.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteCiudad':
        $cod_postal=intval($_POST['cod_postal']);
        $ciudad=new Ciudad($cod_postal);
        $ciudad->eliminar();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('layoutCiudad.php');} // el layout incluye el template adentro
