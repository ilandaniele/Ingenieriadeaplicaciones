
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $(document).on('click','.edit',function(){
        
		//this = es el elemento sobre el que se hizo click en este caso el link
        //obtengo el id que guardamos en data-id
		var dni=$(this).attr('data-dni');
		var id=$(this).attr('data-id');
        //preparo los parametros
        params={};
		params.dni=dni;
		params.id=id;
        params.action="editPresenta";
        $('#popupbox').load('logicaPresentaFrances.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })

    })

    $(document).on('click','.delete',function(){
        //obtengo el id que guardamos en data-id
		var dni=$(this).attr('data-dni');
		var id=$(this).attr('data-id');
        //preparo los parametros
        params={};
		params.dni=dni;
		params.id=id;
        params.action="deletePresenta";
		
        $('#popupbox').load('logicaPresentaFrances.php', params,function(){
            $('#content').load('logicaPresentaFrances.php',{action:"refreshGrid"});
        })

    })

    $(document).on('click','#nuevoPresenta',function(){
        params={};
        params.action="newPresenta";
		
        $('#popupbox').load('logicaPresentaFrances.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })


    $(document).on('submit','#presenta',function(){ 
        var params={};							//hago la funcion especificada debajo. 
        params.action='savePresenta';
		params.dni=$('#dni').val();
		params.id=$('#id').val();
        params.idVieja=$('#idVieja').val();
        
        $.post('logicaPresentaFrances.php',params,function(){
            $('#block').hide();
            $('#popupbox').hide();
            $('#content').load('logicaPresentaFrances.php',{action:"refreshGrid"});
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
