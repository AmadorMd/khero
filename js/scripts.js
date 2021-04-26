let menuOpen = false, wideMenu = $("#wide-menu"), MenuResult;

function MenuOpenClose(menu, isOpen){
    if(!isOpen && menu.hasClass("invisible")){
        menu.toggleClass("invisible", false);
        isOpen = !isOpen;
    }else if(isOpen == true){
        menu.toggleClass("invisible");
        isOpen = !isOpen;
    }
    return isOpen;
}
$("#menu-button").on("click", function(){
    MenuResult = MenuOpenClose(wideMenu, menuOpen);
});
$("#close-menu").on("click", function(){
    MenuOpenClose(wideMenu, MenuResult);
});
$(".nav-link").each(function(){
    $(this).on("click", function(){
        MenuOpenClose(wideMenu, MenuResult);
    })
});
$(document).on('scroll',function () {
    var $nav = $('.navbar');
    $nav.toggleClass('is-scrolling', $(this).scrollTop() > $nav.height());
});
//Envio de form
let formulario = $("#contact-form"), nombre = $("#nombre"), email = $("#email"), nombreEmpresa = $("#nombre_empresa"), numeroEmpleados = $("#numero_empleados"), mensaje = $("#mensaje"); 
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function validateInputs(nombre, email, nombreEmpresa, numeroEmpleados, mensaje){
    let validationStatus = false;
    if(nombre.val() == ""){
        nombre.next("span.error").html("<i class='fas fa-exclamation-circle'></i> Héroe, por favor ingresa tu nombre");
        nombre.addClass("is-invalid");
        
    }else{
        validationStatus = true;
        nombre.next("span.error").html("");
        nombre.removeClass("is-invalid");
    }
    if(email.val() == "" || !IsEmail(email.val())){
        email.next("span.error").html("<i class='fas fa-exclamation-circle'></i> Héroe, el email es incorrecto o el campo está vacío, favor de revisarlo");
        email.addClass("is-invalid");
    }else{
        validationStatus = true;
        email.next("span.error").html("");
        email.removeClass("is-invalid");
    }
    
    // if(mensaje.val().length >= 350 && mensaje.val().length <= ){
    //     console.log("error");
    //     mensaje.next("span.error").html("<i class='fas fa-exclamation-circle'></i> Héroe, el mensaje es demasiado largo, por favor reducelo.")
    // }else{
    //     validationStatus = true;
    //     mensaje.next("span.error").html("");
    //     email.removeClass("is-invalid");
    // }
    return validationStatus;
};

formulario.on("submit", function(e){
    e.preventDefault();
    let validationStatus = validateInputs(nombre, email, nombreEmpresa, numeroEmpleados, mensaje);
    if(validationStatus){
        $.ajax({
            url: "./php/contacto.php",
            method: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            always: function(){
                $(nombre).atrr("disabled", true);
            },
            success: function(response){
                $('#alert-success').removeClass('hidden');
                $('#alert-success').addClass('block').html('<i class="fas fa-check-circle"></i>'+
                    ' Formulario enviado, pronto nos pondremos en contacto.');
                    formulario.find('input[type=text], input[type=tel], textarea, select, input[type=email]').val('');
            }
        });
    }
})