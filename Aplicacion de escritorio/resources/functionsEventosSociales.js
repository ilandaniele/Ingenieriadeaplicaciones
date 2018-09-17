
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $(document).on('click','.edit',function(){
        
		//this = es el elemento sobre el que se hizo click en este caso el link
        //obtengo el id que guardamos en data-id
        var id=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.id=id;
        params.action="editEvento";
        $('#popupbox').load('logicaEventoSocial.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })

    })

    $(document).on('click','.delete',function(){
        //obtengo el id que guardamos en data-id
        var id=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.id=id;
        params.action="deleteEvento";
		
        $('#popupbox').load('logicaEventoSocial.php', params,function(){
            $('#content').load('logicaEventoSocial.php',{action:"refreshGrid"});
        })

    })

    $(document).on('click','#nuevoEvento',function(){
        params={};
        params.action="newEvento";
		
        $('#popupbox').load('logicaEventoSocial.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })


    $(document).on('submit','#evento',function(){ //cambio agregado, cuando en el document haya un submit en algun elemento con identificador 'evento'
        var params={};							//hago la funcion especificada debajo. 
        params.action='saveEvento';
		params.id=$('#id').val();
        params.nombre=$('#nombre').val();
        params.interes=$('#interes').val();
       
        $.post('logicaEventoSocial.php',params,function(){
            $('#block').hide();
            $('#popupbox').hide();
            $('#content').load('logicaEventoSocial.php',{action:"refreshGrid"});
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
