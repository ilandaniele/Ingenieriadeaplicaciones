
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $(document).on('click','.edit',function(){
        
		//this = es el elemento sobre el que se hizo click en este caso el link
        //obtengo el id que guardamos en data-id
        var cod_postal=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.cod_postal=cod_postal;
        params.action="editCiudad";
        $('#popupbox').load('logicaCiudadIngles.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })

    })

    $(document).on('click','.delete',function(){
        //obtengo el id que guardamos en data-id
        var cod_postal=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.cod_postal=cod_postal;
        params.action="deleteCiudad";
		
        $('#popupbox').load('logicaCiudadIngles.php', params,function(){
            $('#content').load('logicaCiudadIngles.php',{action:"refreshGrid"});
        })

    })

    $(document).on('click','#nuevoCiudad',function(){
        params={};
        params.action="newCiudad";
		
        $('#popupbox').load('logicaCiudadIngles.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })


    $(document).on('submit','#ciudad',function(){ //cambio agregado, cuando en el document haya un submit en algun elemento con identificador 'evento'
        var params={};							//hago la funcion especificada debajo. 
        params.action='saveCiudad';
		params.cod_postal=$('#cod_postal').val();
        params.nombre=$('#nombre').val();
        params.inf_turistica=$('#inf_turistica').val();
        $.post('logicaCiudadIngles.php',params,function(){
            $('#block').hide();
            $('#popupbox').hide();
            $('#content').load('logicaCiudadIngles.php',{action:"refreshGrid"});
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
