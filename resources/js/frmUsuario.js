$(document).ready(function(){

    //Select2 en campos requeridos
    $("#rol,#roles").select2({
        width:"100%",
        placeholder:".::Seleccione::.",
        theme:"bootstrap"
    });
    
    //se limpia uno por uno para no tener conflicto con el value del radio button
      $("#frmModificar").on('hidden.bs.modal', function () {
        $('#FormularioModificar #image').attr('src','');
        $('#FormularioModificar :input[type=text]').val('');
        $('#FormularioModificar :input[type=email]').val('');
        $('#FormularioModificar :input[type=password]').val('');
        $('#FormularioModificar #roles').val('').trigger('change');
        $('#FormularioModificar input[name=genero]').prop('checked', false);
        $('#FormularioModificar :input[type=file]').val('');
      })


    //DataTables AJAX y botones
    var table = $("#tablaUsuarios").DataTable({
        language: 
        {
            url: "../resources/src/js/Spanish.json"
        },
        ajax:
        {
            type:"POST",
            dataType:"JSON",
            url:"user/llenarTabla"
        },
        dom: 'Bfrtip',
        buttons:[
            {
                extend:'pageLength',
                text:'<i class="fas fa-table"></i> Numero de filas',
                titleAttr:'Numero de filas a mostrar',
                className:'btn btn-light'
            },
            {
                extend:'excelHtml5',
                text:'<i class="far fa-file-excel"></i> EXCEL',
                titleAttr:'Exportar a excel',
                filename: "reporteUsuario",
                exportOptions:{
                    columns:[0,1,2,4,5,6,7]
                },
                className:'btn btn-light'
            },
            {
                extend:'print',
                text:'<i class="fas fa-print"></i> IMPRIM.',
                titleAttr:'Imprimir',
                exportOptions:{
                    columns:[3,1,2,4,5,6,7],
                    stripHtml: false,
                },
                className:'btn btn-light'
            }
        ]
    });

    var table_deleted = $("#tablaUsuariosDel").DataTable({
        language: 
        {
            url: "../resources/src/js/Spanish.json"
        },
        ajax:
        {
            type:"POST",
            dataType:"JSON",
            url:"user/llenarTablaDel"
        },
        dom: 'Bfrtip',
        buttons:[
            {
                extend:'pageLength',
                text:'<i class="fas fa-table"></i> Numero de filas',
                titleAttr:'Numero de filas a mostrar',
                className:'btn btn-light'
            },
        ]
    });

    //comprobando peso de imagen y vista previa
    $('#image').attr('src','../resources/multimedia/recursos/noImage.jpg');
    $(document).on("change","#bloqueFormulario #foto",function()
    {
        if($("#bloqueFormulario #foto").val()!='')
        {
            var size = this.files.size;
            var megaBites = (size/1024)/1024;
            var type = this.files[0].type;
                
            if(type=="image/jpeg" || type=="image/png")
            {
                if(megaBites>=1)
                {
                    Lobibox.notify('error',{
                        sound:false,
                        delayIndicator :false,
                        position:"top right",
                        title:"Imagen demasiado grande",
                        msg: "La imagen excede la capacidad de subida"
                    });
                    $('#bloqueFormulario :input[type=file]').val('');
                    $('#image').attr('src','../resources/multimedia/recursos/noImage.jpg');
                    $("#loadImage").waitMe({
                        effect: 'ios',
                        bg:"#fff",
                        color:"grey",
                        text: 'Cargando imagen...'
                        });
                    setTimeout(()=>{
                        $('#loadImage').waitMe('hide');
                    },800);
                }
                else{
                    preview(this);
                }
            }
            else{
                Lobibox.notify('error',{
                    sound:false,
                    delayIndicator :false,
                    position:"top right",
                    title:"Error al cargar archivo",
                    msg: "El archivo no es una imagen"
                });
                $('#bloqueFormulario :input[type=file]').val('');
                $('#image').attr('src','../resources/multimedia/recursos/noImage.jpg');
                $("#loadImage").waitMe({
                    effect: 'ios',
                    bg:"#fff",
                    color:"grey",
                    text: 'Cargando imagen...'
                    });
                setTimeout(()=>{
                    $('#loadImage').waitMe('hide');
                },800);
            }
        }else{
            $('#image').attr('src','../resources/multimedia/recursos/noImage.jpg');
            $("#loadImage").waitMe({
                effect: 'ios',
                bg:"#fff",
                color:"grey",
                text: 'Cargando imagen...'
                });
            setTimeout(()=>{
                $('#loadImage').waitMe('hide');
            },800);
        }
    });

    $(document).on("change","#FormularioModificar :input[type=file]",function()
    {
        if($("#FormularioModificar #FormularioModificar").val()!='')
        {
            var size = this.files.size;
            var megaBites = (size/1024)/1024;
            var type = this.files[0].type;
                
            if(type=="image/jpeg" || type=="image/png")
            {
                if(megaBites>=1)
                {
                    Lobibox.notify('error',{
                        sound:false,
                        delayIndicator :false,
                        position:"top right",
                        title:"Imagen demasiado grande",
                        msg: "La imagen excede la capacidad de subida"
                    });
                    $('#FormularioModificar :input[type=file]').val('');
                    $('#image2').attr('src','../resources/multimedia/recursos/noImage.jpg');
                    $("#loadImage2").waitMe({
                        effect: 'ios',
                        bg:"#fff",
                        color:"grey",
                        text: 'Cargando imagen...'
                        });
                    setTimeout(()=>{
                        $('#loadImage2').waitMe('hide');
                    },800);
                }
                else{
                    preview2(this);
                }
            }
            else{
                Lobibox.notify('error',{
                    sound:false,
                    delayIndicator :false,
                    position:"top right",
                    title:"Error al cargar archivo",
                    msg: "El archivo no es una imagen"
                });
                $('#FormularioModificar :input[type=file]').val('');
                $('#image2').attr('src','../resources/multimedia/recursos/noImage.jpg');
                $("#loadImage2").waitMe({
                    effect: 'ios',
                    bg:"#fff",
                    color:"grey",
                    text: 'Cargando imagen...'
                    });
                setTimeout(()=>{
                    $('#loadImage2').waitMe('hide');
                },800);
            }
        }else{
            $('#image2').attr('src','../resources/multimedia/recursos/noImage.jpg');
            $("#loadImage2").waitMe({
                effect: 'ios',
                bg:"#fff",
                color:"grey",
                text: 'Cargando imagen...'
                });
            setTimeout(()=>{
                $('#loadImage2').waitMe('hide');
            },800);
        }
    });
    //FUNCION DE VISTA PREVIA DE IMAGEN
    function preview(img){
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $("#image").attr("src",e.target.result);
            $("#loadImage").waitMe({
                effect: 'ios',
                bg:"#fff",
                color:"grey",
                text: 'Cargando imagen...'
                });
            setTimeout(()=>{
                $('#loadImage').waitMe('hide');
            },800);
        };
        reader.readAsDataURL(img.files[0]);
    }

    function preview2(img){
        var reader = new FileReader();
        reader.onload = function (e) 
        {
            $("#image2").attr("src",e.target.result);
            $("#loadImage2").waitMe({
                effect: 'ios',
                bg:"#fff",
                color:"grey",
                text: 'Cargando imagen...'
                });
            setTimeout(()=>{
                $('#loadImage2').waitMe('hide');
            },800);
        };
        reader.readAsDataURL(img.files[0]);
    }


    //validacion de campos
    $("#alert").hide();
    $("#alert2").hide();
    $("#alert3").hide();
    var requiredUser=false;
    var requiredEmail=false;
    var requiredPass=false;

    $(document).on('change','#email',function(){
        var email = $("#email").val();
        //comprobando email
        var patronEmail = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if(!patronEmail.test(email) && email!="")
        {
            $("#alert").html("Su email no es un formato correcto");
            $("#alert").show();
            requiredEmail=false;
        }
        else{
            $("#alert").hide();
            requiredEmail=true;
        }
    });

    $(document).on('change','#username',function(){
          //comprobando usuario
          var user = $("#username").val();
          if(user!="")
          {
              $.ajax({
                  type:"POST",
                  dataType:"JSON",
                  data: {
                      user:user
                  },
                  url:"user/usuarioExistente"
              }).done(function(data){
                  if(data.datos==true)
                  {
                    $("#alert2").html("Este usuario no esta disponible");
                    $("#alert2").show();
                    requiredUser=false;
                  }
                  else
                  {
                    $("#alert2").hide();
                    requiredUser=true;
                  }
              })
          }
          else{
              $("#alert2").hide();
          }
    });



    $(document).on('change','#password',function(){
        var pass = $("#password");
        
        if(pass.val()!="")
            {
                var patron = /[\^$.*+?=!:|\\/()\[\]{}]/;
                if(!patron.test(pass.val()) || pass.val().length<8)
                {
                    $("#alert3").html("Su contrasenia debe contener al menos 8 digitos y debe contener caracteres especiales");
                    $("#alert3").show();
                    requiredPass=false;
                }else
                {
                    $("#alert3").hide();
                    requiredPass=true;
                }
            }
            else{
                $("#alert3").hide();
            }
    });

    //  AJAX INSERTAR DATOS
    $(document).on("click", "#enviarData", function(){        

        if($("#bloqueFormulario #nombres").val()=="")
        {
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo nombres"
            });
        }
        else if($("#bloqueFormulario #apellidos").val()=="")
        {
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo apellidos"
            });

        }
        else if($("#bloqueFormulario #email").val()=="")
        {
            
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo email"
            });

        }
        else if($("#bloqueFormulario #username").val()=="")
        {
            
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo usuario"
            });

        }
        else if($("#bloqueFormulario #password").val()=="")
        {
            
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo contraseña"
            });

        }
        else if($("#bloqueFormulario #rol").val()=="")
        {
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo rol"
            });

        }
        else if (!$("input[name=genero]").is(":checked")) 
        {
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Verifique sus datos",
                msg:"Debe llenar el campo genero"
            });	
        }
        else if(requiredEmail==false || requiredUser==false || requiredPass==false)
        {
            Lobibox.notify('warning',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: "Hay algunos errores",
                msg:"Verifique sus datos"
            });
        }
        else{
            var info = JSON.stringify($("#bloqueFormulario :input").serializeArray());
            var fd = new FormData();
            if($('#foto')[0].files[0]!=null){
                var foto = $('#foto')[0].files[0];
                fd.append('foto',foto);
            }            
            fd.append('info',info);
            $.ajax({
                type:"POST",
                dataType:"JSON",
                data: fd,
                contentType: false,
                processData: false,
                url:"user/insertar"
    
            }).done(function(data){
                $("#frmInsertar").modal('hide');
                Lobibox.notify('success',{
                    sound:false,
                    delayIndicator :false,
                    position:"top right",
                    title: data.mensaje,
                    msg:"Tabla actualizada"
                });
                table.ajax.reload(null,false);
                limpiarForm();
            }).fail(()=>{
                alert("SERVERSIDE ERROR");
            })
        }
    });



    //Aqui llenamos el modal con datos
    $(document).on("click",".btnEditar",function(){
        var id = $(this).attr("id");
        $.ajax({
            type:'POST',
            dataType:"JSON",
            data:{
                    id:id,
                },
            url:"user/obtener"
        }).done(function(data){
            if(data.datos){
                $("#frmModificar").modal();
                $("#FormularioModificar #id").val(data.datos.idUser);
                $("#FormularioModificar #nombres").val(data.datos.nombre);
                $("#FormularioModificar #apellidos").val(data.datos.apellido);
                $("#FormularioModificar #email").val(data.datos.email);
                $("#FormularioModificar #username").val(data.datos.username);
                $("#FormularioModificar #password").val('');
                $("#FormularioModificar #roles").val(data.datos.rol).trigger('change');
                if(data.datos.image!=false)
                {
                    $("#image2").attr("src",data.datos.image);
                }
                else{
                    if(data.datos.genero=="Masculino")
                    {
                        $("#image2").attr("src","../resources/multimedia/recursos/noPhotoMan.jpg");
                    }
                    else{
                        $("#image2").attr("src","../resources/multimedia/recursos/noPhotoGirl.png");
                    }
                }
                $("#FormularioModificar input[name=genero][value="+data.datos.genero+"]").prop("checked",true);
            }
            
        })
    });


    //  AJAX MODIFICAR DATOS
    $(document).on("click", "#modificarData", function(){
        var info = JSON.stringify($("#FormularioModificar :input").serializeArray());
        
        var fd = new FormData();
        var foto = $('#fotos')[0].files[0];
        fd.append('foto',foto);
        fd.append('info',info);

            $.ajax({
                type:"POST",
                dataType:"JSON",
                data: fd,
                contentType: false,
                processData: false,
                url:"user/modificar"
            }).done(function(data){
                if(data.datos){
                    $("#frmModificar").modal('hide');
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
    });
    

    //AJAX ELIMINADO LOGICO DE DATOS
    $(document).on("click",".btnEliminar",function(){
        
        var id = $(this).attr("id");

        Swal.fire({
            title: 'Seguro que desea eliminar este usuario?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'darkgray',
            confirmButtonText: 'Eliminar'
          }).then((result) => {
            if (result.value) {
              eliminar(id);
            }
          })

    });
function eliminar(id){
    $.ajax({
        type:'POST',
        dataType:"JSON",
        data:{id:id},
        url:"user/eliminar"
    }).done(function(data){
        if(data.datos){
            Lobibox.notify('success',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: data.mensaje,
                msg:"Tabla actualizada"
            });
            table.ajax.reload( null,false);
			table_deleted.ajax.reload( null,false);
        }
    })
}

	//AJAX HABILITADO LOGICO DE DATOS
    $(document).on("click",".btnHabilitar",function(){
        
        var id = $(this).attr("id");

        Swal.fire({
            title: 'Seguro que desea habilitar este usuario?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'red',
            cancelButtonColor: 'darkgray',
            confirmButtonText: 'Habilitar'
          }).then((result) => {
            if (result.value) {
              habilitar(id);
            }
          })

    });
function habilitar(id){
    $.ajax({
        type:'POST',
        dataType:"JSON",
        data:{id:id},
        url:"user/habilitar"
    }).done(function(data){
        if(data.datos){
            Lobibox.notify('success',{
                sound:false,
                delayIndicator :false,
                position:"top right",
                title: data.mensaje,
                msg:"Tabla actualizada"
            });
            table.ajax.reload( null,false);
			table_deleted.ajax.reload( null,false);
        }
    })
}


//BOTON PARA VER INFORMACION
$(document).on("click",".btnInfo",function(){
    var id = $(this).attr("id");
    $.ajax({
        type:'POST',
        dataType:"JSON",
        data:{id:id},
        url:"user/obtener"
    }).done(function(data){
        if(data.datos){
            $("#frmInfo").modal();
            $("#frmInfo #nombres").html(data.datos.nombre);
            $("#frmInfo #apellidos").html(data.datos.apellido);
            $("#frmInfo #cargo").html(data.datos.rolNombre);
            $("#frmInfo #email").html(data.datos.email);
            $("#frmInfo #genero").html(data.datos.genero);
            $("#frmInfo #username").html(data.datos.username);
            if(data.datos.image!=false)
            {
                $("#frmInfo #foto").attr("src",data.datos.image);
            }
            else{
                if(data.datos.genero=="Masculino")
                {
                    $("#frmInfo #foto").attr("src","../resources/multimedia/recursos/noPhotoMan.jpg");
                }
                else{
                    $("#frmInfo #foto").attr("src","../resources/multimedia/recursos/noPhotoGirl.png");
                }                
            }
        }
        
    })
});

});

 //FUNCION PARA LIMPIAR EL FORMULARIO DE INSTAR
 //se limpia uno por uno para no tener conflicto con el value del radio button
 function limpiarForm(){
    $('#image').attr('src','../resources/multimedia/recursos/noImage.jpg');
    $("#loadImage").waitMe({
                        effect: 'ios',
                        bg:"#fff",
                        color:"grey",
                        text: 'Cargando imagen...'
                        });
                    setTimeout(()=>{
                        $('#loadImage').waitMe('hide');
                    },800);
    $('#bloqueFormulario :input[type=text]').val('');
    $('#bloqueFormulario :input[type=email]').val('');
    $('#bloqueFormulario :input[type=password]').val('');
    $('#bloqueFormulario :input[type=file]').val('');
    $('#bloqueFormulario #rol').val('').trigger('change');
    $('input[name=genero]').prop('checked', false);
    $("#alert").hide();
    $("#alert2").hide();
    $("#alert3").hide();
}
