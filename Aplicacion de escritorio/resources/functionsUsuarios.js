
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $(document).on('click','.edit',function(){
        
        var dni=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.dni=dni;
        params.action="editUsuario";
        $('#popupbox').load('logicaUsuario.php', params,function(){
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
        params.action="deleteUsuario";
		
        $('#popupbox').load('logicaUsuario.php', params,function(){
            $('#content').load('logicaUsuario.php',{action:"refreshGrid"});
        })

    })

    $(document).on('click','#nuevoUsuario',function(){
        params={};
        params.action="newUsuario";
		
        $('#popupbox').load('logicaUsuario.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })


    $(document).on('submit','#usuario',function(){ //cambio agregado, cuando en el document haya un submit en algun elemento con identificador 'evento'
        var params={};							//hago la funcion especificada debajo. 
        params.action='saveUsuario';
		params.dni=$('#dni').val();
        params.username=$('#username').val();
        params.contra=$('#password').val();
        params.nombre_usuario=$('#nombre_usuario').val();
        params.apellido=$('#apellido').val();
		params.es_admin=$('#es_admin').val();
        $.post('logicaUsuario.php',params,function(){
            $('#block').hide();
            $('#popupbox').hide();
            $('#content').load('logicaUsuario.php',{action:"refreshGrid"});
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
