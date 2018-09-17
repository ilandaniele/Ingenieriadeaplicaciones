<?php

include_once ("claseAsiste.php");// incluyo las clases a ser usadas
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
        $view->asistes=Asiste::getAsistes(); // tree todos los eventos
        $view->contentTemplate="tablaAsiste.php"; // seteo el template que se va a mostrar
        break;
    case 'refreshGrid':
        $view->disableLayout=true; // no usa el layout
        $view->asistes=Asiste::getAsistes();
        $view->contentTemplate="tablaAsiste.php"; // seteo el template que se va a mostrar
        break;
    case 'saveAsiste':
        // limpio todos los valores antes de guardarlos
        // por las dudas que venga algo raro
		$dni=intval($_POST['dni']);
        $id=intval($_POST['id']);
		$idVieja=intval($_POST['idVieja']);
        $asiste=new Asiste($dni,$idVieja);
		$asiste->setDniAux($dni);
        $asiste->setIdAux($id);
		$asiste->setIdVieja($idVieja);
        $asiste->save();
		die;
        break;
    case 'newAsiste':
        $view->asiste=new Asiste();
        $view->label='Nuevo Asiste';
        $view->disableLayout=true;
        $view->contentTemplate="ventanaAsiste.php"; // seteo el template que se va a mostrar
        break;
    case 'editAsiste':
		$editDni=intval($_POST['dni']);
		$editId=intval($_POST['id']);
        $view->label='Editar Asiste';
        $view->asiste=new Asiste($editDni,$editId);
        $view->disableLayout=true;
        $view->contentTemplate="ventanaAsiste.php"; // seteo el template que se va a mostrar
        break;
    case 'deleteAsiste':
          $dni=intval($_POST['dni']);
		  $id=intval($_POST['id']);
		  $asiste=new Asiste($dni,$id);
		  $asiste->eliminar();
        die; // no quiero mostrar nada cuando borra , solo devuelve el control.
        break;
    default :
}

// si esta deshabilitado el layout solo imprime el template
if ($view->disableLayout==true)
{include_once ($view->contentTemplate);}
else
{include_once ('layoutAsiste.php');} // el layout incluye el template adentro
