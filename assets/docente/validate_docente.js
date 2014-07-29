$(document).ready(function() {
    $.validator.messages.required = 'Este campo es requerido';
    $.validator.messages.email = 'Ingrese una dirección de email válida';
    $('#form-docente').validate(
            {
              "rules":{
                "paterno":[
                  
                ],
                "materno":[
                  
                ],
                "nombres":[
                  
                ],
                "dni":[
                  
                ],
                "telefono":[
                  
                ],
                "direccion":[
                  
                ],
                "tipo_docente":[
                  
                ],
                "email":{
                  "email":true
                },
                "sexo":[
                  
                ]
              }
            }
        );//end of validate
    }//end of function
);//end of ready
