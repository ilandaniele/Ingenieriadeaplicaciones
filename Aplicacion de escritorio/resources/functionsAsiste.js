
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $(document).on('click','.edit',function(){
        
		//this = es el elemento sobre el que se hizo click en este caso el link
        //obtengo el id que guardamos en data-id
        var id=$(this).attr('data-id');
		var dni=$(this).attr('data-dni');
        //preparo los parametros
        params={};
        params.dni=dni;
		params.id=id;
        params.action="editAsiste";
        $('#popupbox').load('logicaAsiste.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })

    })

    $(document).on('click','.delete',function(){
        //obtengo el id que guardamos en data-id
		var id=$(this).attr('data-id');
		var dni=$(this).attr('data-dni');
        //preparo los parametros
        params={};
        params.dni=dni;
		params.id=id;
        params.action="deleteAsiste";
		
        $('#popupbox').load('logicaAsiste.php', params,function(){
            $('#content').load('logicaAsiste.php',{action:"refreshGrid"});
        })

    })

    $(document).on('click','#nuevoAsiste',function(){
        params={};
        params.action="newAsiste";
		
        $('#popupbox').load('logicaAsiste.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })


    $(document).on('submit','#asiste',function(){ 
        var params={};							//hago la funcion especificada debajo. 
        params.action='saveAsiste';
		params.dni=$('#dni').val();
        params.id=$('#id').val();
        params.idVieja=$('#idVieja').val();
        
        $.post('logicaAsiste.php',params,function(){
            $('#block').hide();
            $('#popupbox').hide();
            $('#content').load('logicaAsiste.php',{action:"refreshGrid"});
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
