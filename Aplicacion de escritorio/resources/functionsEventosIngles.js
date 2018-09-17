
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
        $('#popupbox').load('logicaEventoIngles.php', params,function(){
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
		
        $('#popupbox').load('logicaEventoIngles.php', params,function(){
            $('#content').load('logicaEventoIngles.php',{action:"refreshGrid"});
        })

    })

    $(document).on('click','#nuevoEvento',function(){
        params={};
        params.action="newEvento";
		
        $('#popupbox').load('logicaEventoIngles.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })


    $(document).on('submit','#evento',function(){ //cambio agregado, cuando en el document haya un submit en algun elemento con identificador 'evento'
        var params={};							//hago la funcion especificada debajo. 
        params.action='saveEvento';
		params.id=$('#id').val();
        params.nombre=$('#nombre').val();
        params.lugar=$('#lugar').val();
        params.fecha=$('#fecha').val();
        params.horainicio=$('#horainicio').val();
		params.horafin=$('#horafin').val();
		params.detalle=$('#detalle').val();
		params.nombre_foro=$('#nombre_foro').val();
        $.post('logicaEventoIngles.php',params,function(){
            $('#block').hide();
            $('#popupbox').hide();
            $('#content').load('logicaEventoIngles.php',{action:"refreshGrid"});
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
