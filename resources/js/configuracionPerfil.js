$(document).ready(function(){
    //Cambiamos el title de la pagina
    $(document).prop("title","Config. cuenta");
    loadData();
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
                      user:user,
                      key:"usuarioExistente"
                  },
                  url:"../controllers/signInController.php"
              }).done(function(data){
                  if(data.status==true)
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



    $(document).on('change','#cPassword',function(){
        var pass = $("#password");
        var pass2 = $("#cPassword");
        if(pass.val()!="" && pass2.val()!="")
            {
                if(pass.val() != pass2.val())
                {
                    $("#alert3").html("La contraseña no coincide");
                    $("#alert3").show();
                    requiredPass=false;
                }
                else{
                    $("#alert3").hide();
                    requiredPass=true;
                    var patron = /[\^$.*+?=!:|\\/()\[\]{}]/;
                    if(!patron.test(pass2.val()) || pass2.val().length<8)
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
            }
            else{
                $("#alert3").hide();
            }
    });


    //Aqui llenamos el modal con datos
    function loadData(){
        var id = $("#id").val();
        
        $.ajax({
            type:'POST',
            dataType:"JSON",
            data:{
                    id:id,
                    key:"obtener"
                },
            url:"../controllers/configuracionController.php"
        }).done(function(data){
            if(data.datos){
                $("#FormularioModificar #id").val(data.datos.idUser);
                $("#FormularioModificar #nombres").val(data.datos.nombre);
                $("#FormularioModificar #apellidos").val(data.datos.apellido);
                $("#FormularioModificar #email").val(data.datos.email);
                $("#FormularioModificar #username").val(data.datos.username);
                $("#FormularioModificar #password").val('');
                $("#FormularioModificar #cPassword").val('');
                if(data.datos.image!=false)
                {
                    $("#FormularioModificar #image").attr("src",data.datos.image);
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
                $("#FormularioModificar input[name=genero][value="+data.datos.genero+"]").prop("checked",true);
            }
            
        })
    };


    //  AJAX MODIFICAR DATOS
    $(document).on("click", "#modificarData", function(){
        var info = JSON.stringify($("#FormularioModificar :input").serializeArray());
        
        var fd = new FormData();
        if($('#foto')[0].files[0]!=null){
                var foto = $('#foto')[0].files[0];
                fd.append('foto',foto);
            }
        fd.append('info',info);
        fd.append('key',"modificar");

            $.ajax({
                type:"POST",
                dataType:"JSON",
                data: fd,
                contentType: false,
                processData: false,
                url:"../controllers/configuracionController.php"
    
            }).done(function(data){
    
                if(data.datos){
                    $("#frmModificar").modal('hide');
                    Lobibox.notify('success',{
                        size : 'mini',
                        rounded : true,
                        sound:false,
                        delayIndicator :false,
                        msg: data.mensaje+String.fromCodePoint(0x1f60e)
                    });
                    setTimeout(function(){
                        window.location.href="dashboard.php";
                    },2000)                    
                }
            })
    });
    

    //AJAX ELIMINADO LOGICO DE DATOS
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
            background:"rgba(31,39,66,1)",
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
        data:{
                id:id,
                key:"eliminar"
            },
        url:"../controllers/usuarioController.php"
    }).done(function(data){
        if(data.datos){
            Lobibox.notify('success',{
                size : 'mini',
                rounded : true,
                sound:false,
                delayIndicator :false,
                msg: data.mensaje+String.fromCodePoint(0x1f62b)
            });
            table.ajax.reload( null,false);
        }
    })
}


//BOTON PARA VER INFORMACION
$(document).on("click",".btnInfo",function(){
    var id = $(this).attr("id");
    $.ajax({
        type:'POST',
        dataType:"JSON",
        data:{
                id:id,
                key:"obtener"
            },
        url:"../controllers/usuarioController.php"
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
    $('#bloqueFormulario #image').attr('src','');
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
