$(document).ready(function()
{

    //al precionar ENTER se envia el form
    $("#password").on("keypress",()=>{
        if (event.keyCode === 13) 
        { 
            $("#login").click();
        } 
    });
    
    //  AJAX
    $(document).on("click", "#login", function(){
        if($("#username").val().trim()=="")
        {
            Lobibox.notify('warning',{
                sound: false,
                delayIndicator :false,
                position:"top right",
                title:"Campos vacíos",
                msg: "Debe llenar el campo usuario"
            });
        }
        else if($("#password").val()=="")
        {
            Lobibox.notify('warning',{
                sound: false,
                delayIndicator :false,
                position:"top right",
                title:"Campos vacíos",
                msg: "Debe llenar el campo contraseña"
            });
        }
        else
        {
            var info = JSON.stringify($("#formLogin :input").serializeArray());
            $.ajax({
                type:"POST",
                dataType:"JSON",
                data: {
                    info:info
                },
                url:"Login/iniciarSesion"
            }).done(function(data)
            {
                if(data.datos){
                    $(".btn-login").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    setTimeout(function(){                      
                        window.location.href="dashboard";
                    },800);
                }
                else{
                    $(".btn-login").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    setTimeout(function(){                      
                        Lobibox.notify('error',{
                            sound: false,
                            delayIndicator :false,
                            position:"top right",
                            title:"Usuario no valido",
                            msg: "Usuario o contraseña incorrecta"
                        });
                        $(".btn-login").html('Iniciar sesión');
                    },800);
                    $("#formLogin :input[type=password]").val("");
                    
                }
            })
        }
    });

});
