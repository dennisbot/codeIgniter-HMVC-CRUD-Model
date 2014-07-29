$(document).ready(function() {
    $.validator.messages.required = 'Este campo es requerido';
    $.validator.messages.email = 'Ingrese una dirección de email válida';
    $('#form-tcliente').validate(
            {
              "rules":{
                "Nombres":{
                  "required":true
                },
                "Direccion":[
                  
                ],
                "RUC":{
                  "required":true
                }
              }
            }
        );//end of validate
    }//end of function
);//end of ready
