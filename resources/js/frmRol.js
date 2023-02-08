$(document).ready(function(){

    //llamado a modal para insertar
    $(document).on("click", "#new", function(){
        $("#frmInsertar").modal();
    });

    //limpiar formulario al cerrar modal
    $('#frmInsertar').on('hidden.bs.modal', function () {
        $("#nombre").val("");
    });

      //DataTables AJAX
    var table = $("#tablaRoles").DataTable({
        info:false,
        language: 
        {url: "../resources/src/js/Spanish.json"},
        ajax:
        {
            type:"POST",
            dataType:"JSON",
            url:"rol/llenarTabla"
        },
        dom: 'Bfrtip',
        buttons:[
            {
                extend:'pageLength',
                text:'<i class="fas fa-table"></i> Numero de filas',
                titleAttr:'Numero de filas a mostrar',
                className:'btn-light'
            }
        ]
    });


     //  AJAX INSERTAR DATOS
     $(document).on("click", "#enviarData", function(){        
        if($("#bloqueFormulario #nombre").val()=="")
        {
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo nombre"
            });	
        }
        else{
            var info = JSON.stringify($("#bloqueFormulario :input").serializeArray());
            $.ajax({
                type:"POST",
                dataType:"JSON",
                data: {'info':info},
                url:"rol/insertar"
    
            }).done(function(data){
    
                if(data.datos){
                    $("#frmInsertar").modal('hide');
                    Lobibox.notify('success',{
                        sound:false,
                        delayIndicator :false,
                        position:"top right",
                        title: data.mensaje,
                        msg:"Tabla actualizada"
                    });
                    table.ajax.reload(null,false);
                    $("#bloqueFormulario :input").val('');
                }
            })
        }
    });


    //Aqui llenamos el modal con datos
    $(document).on("click",".btnEditar",function(){
        var id = $(this).attr("id");
        $.ajax({
            type:'POST',
            dataType:"JSON",
            data:{id:id},
            url:"rol/obtener"
        }).done(function(data){
            if(data.datos){
                $("#frmModificar").modal();
                $("#FormularioModificar #id").val(data.datos.idRol);
                $("#FormularioModificar #nombre").val(data.datos.nombreRol);
                
            }
            
        })
    });

    //  AJAX MODIFICAR DATOS
    $(document).on("click", "#modificarData", function(){        
        if($("#FormularioModificar #nombre").val()=="")
        {
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo nombre"
            });	
        }
        else{
            var info = JSON.stringify($("#FormularioModificar :input").serializeArray());
            $.ajax({
                type:"POST",
                dataType:"JSON",
                data: {'info':info},
                url:"rol/modificar"
    
            }).done(function(data){
                if(data){
                    $("#frmModificar").modal('hide');
                    $("#frmInsertar").modal('hide');
                    Lobibox.notify('success',{
                        sound:false,
                        delayIndicator :false,
                        position:"top right",
                        title: data.mensaje,
                        msg:"Tabla actualizada"
                    });
                    table.ajax.reload(null,false);
                    $("#FormularioModificar :input").val('');
                }
            })
        }
    });


    //SWEETALERT PARA CONFIRMAR ELIMINADO
    $(document).on("click",".btnEliminar",function(){
        
        var id = $(this).attr("id");

        Swal.fire({
            title: 'Seguro que desea eliminar?',
            text: "Una vez realizado esta accion no se podra restablecer",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'darkgray',
            confirmButtonText: 'Eliminar',
            background:"rgba(255,255,255,1)",
          }).then((result) => {
            if (result.value) 
            {
            //LLAMAMOS LA FUNCION PARA ELIMINAR
              eliminar(id);
            }
          })

    });
//AJAX ELIMINADO LOGICO DE DATOS
function eliminar(id){
    $.ajax({
        type:'POST',
        dataType:"JSON",
        data:{id:id},
        url:"rol/eliminar"
    }).done(function(data){
        if(data){
            Lobibox.notify('success',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: data.mensaje,
                msg:"Tabla actualizada"
            });
            table.ajax.reload( null,false);
        }
    })
}



});