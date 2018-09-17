
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $(document).on('click','.edit',function(){
        
		//this = es el elemento sobre el que se hizo click en este caso el link
        //obtengo el id que guardamos en data-id
        var dni=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.dni=dni;
        params.action="editExpositor";
        $('#popupbox').load('logicaExpositorIngles.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })

    })

    $(document).on('click','.delete',function(){
        //obtengo el id que guardamos en data-id
        var dni=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.dni=dni;
        params.action="deleteExpositor";
		
        $('#popupbox').load('logicaExpositorIngles.php', params,function(){
            $('#content').load('logicaExpositorIngles.php',{action:"refreshGrid"});
        })

    })

    $(document).on('click','#nuevoExpositor',function(){
        params={};
        params.action="newExpositor";
		
        $('#popupbox').load('logicaExpositorIngles.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })


    $(document).on('submit','#expositor',function(){ //cambio agregado, cuando en el document haya un submit en algun elemento con identificador 'evento'
        var params={};							//hago la funcion especificada debajo. 
        params.action='saveExpositor';
		params.dni=$('#dni').val();
        params.institucion=$('#institucion').val();
        params.cargo=$('#cargo').val();
        params.biografia=$('#biografia').val();
        
        $.post('logicaExpositorIngles.php',params,function(){
            $('#block').hide();
            $('#popupbox').hide();
            $('#content').load('logicaExpositorIngles.php',{action:"refreshGrid"});
        })
        return false;
    })


    // boton cancelar, uso live en lugar de bind para que tome cualquier boton
    // nuevo que pueda aparecer
     $(document).on('click','#cancel',function(){
        $('#block').hide();
        $('#popupbox').hide();
    })


})

NS={};
