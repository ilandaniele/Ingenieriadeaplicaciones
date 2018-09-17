
$(document).ready(function(){ //cuando el html fue cargado iniciar

    //añado la posibilidad de editar al presionar sobre edit
    $(document).on('click','.edit',function(){
        
        var codigo=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.codigo=codigo;
        params.action="editForo";
        $('#popupbox').load('logicaForoIngles.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })

    })

    $(document).on('click','.delete',function(){
        //obtengo el id que guardamos en data-id
        var codigo=$(this).attr('data-id');
        //preparo los parametros
        params={};
        params.codigo=codigo;
        params.action="deleteForo";
		
        $('#popupbox').load('logicaForoIngles.php', params,function(){
            $('#content').load('logicaForoIngles.php',{action:"refreshGrid"});
        })

    })

    $(document).on('click','#nuevoForo',function(){
        params={};
        params.action="newForo";
		
        $('#popupbox').load('logicaForoIngles.php', params,function(){
            $('#block').show();
            $('#popupbox').show();
        })
    })


    $(document).on('submit','#foro',function(){ //cambio agregado, cuando en el document haya un submit en algun elemento con identificador 'evento'
        var params={};							//hago la funcion especificada debajo. 
        params.action='saveForo';
		params.codigo=$('#codigo').val();
        params.nombre=$('#nombre').val();
        params.detalle=$('#detalle').val();
        params.cod_postal=$('#cod_postal').val();
        $.post('logicaForoIngles.php',params,function(){
            $('#block').hide();
            $('#popupbox').hide();
            $('#content').load('logicaForoIngles.php',{action:"refreshGrid"});
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
