window.onload = function() {
    if (document.getElementById('arreglo').value != 0) {
        btn_terraza1()
    }
}

function validar() {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    // alert(email);
    // alert(password);

    if (email == "" || password == "") {

        if (email == "" && password != "") {

            //alert ("No se ha especificado ningun Email");

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ningun Email</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('email').style.border = "2px solid red";
            document.getElementById('password').style.border = "2px solid grey";
            document.getElementById('mensaje').style.color = "red";
            return false;

        } else if (email != "" && password == "") {

            //alert ("No se ha especificado ninguna Contraseña");

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ninguna Contraseña</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('password').style.border = "2px solid red";
            document.getElementById('email').style.border = "2px solid grey";
            document.getElementById('mensaje').style.color = "red";
            return false;

        } else {

            //alert ("No se ha especificado ningun valor");

            document.getElementById('mensaje').innerHTML = "<p>No se ha especificado ningun Valor</p>";
            document.getElementById('mensaje').style.color = "red";
            document.getElementById('password').style.border = "2px solid red";
            document.getElementById('email').style.border = "2px solid red";
            document.getElementById('mensaje').style.color = "red";
            return false;
        }
    } else {
        return true;
    }
}

//boton incidencias
function btn_incidencias() {
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        //fin
}

//boton historial
function btn_log() {
    // Get the modal
    var modal = document.getElementById("myModal2");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn2");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[1];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";

    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        //fin
}

//contenedor
function datos_terrazas() {
    let terrazas = "<button class='btn_terrazas' id='btn_terraza1' onclick='return btn_terraza1();'><img class='img_terraza'>Terraza 1</button>";
    document.getElementById('div_botones').innerHTML = terrazas;
}

function btn_mod() {
    // Get the modal
    var modal = document.getElementById("modal_terrazas");

    // Get the button that opens the modal
    var btn = document.getElementsByClassName("btn_modal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close_terrazas")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        //fin
}

function errorini() {
    document.getElementById("errorinicio").innerHTML = ""
}