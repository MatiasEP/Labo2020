window.onload=inicio();


function inicio()
{
    const box_titulo = document.getElementById("titulo");
    
    box_titulo.addEventListener("input", function(event)
    {
        if(box_titulo.validity.valid)
        {
            box_titulo.setCustomValidity("El valor que esta ingresando, no corresponde a texto");

        }
        else
        {
            box_titulo.setCustomValidity("");            
        }
        
    })
    
    console.log(box_titulo);
    console.log(box_titulo.validity.valid);
}