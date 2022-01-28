<?php
    session_start();
    if(!isset($_SESSION['usuarioWorkanda']))
    {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <title>DashBoard Workanda</title>
</head>
<body>

    

    <div id="crearUsuario" class="form">

    <button class="logout" onClick="cerrarSesion()">Cerrar Sesion de : <?php echo $_SESSION['usuarioWorkanda'];?></button>

        Nombre Usuario<input id="nombre" type="text">    
        Password      <input id="password" type="text">  
        Direccion     <input id="direccion" type="text"> 

        <button id="btnEnviar" onClick="createUser()">
            Guardar
        </button>

        <div id="div-update" class="hide">
            <button id="btnModificar" onClick="updateUser()">
                Modificar
            </button>
            <button id="btnCancelar" onClick="cancelUpdate()">
                Cancelar
            </button>
        </div>
        
    </div>

<hr>

    <div id="cargarLista"></div>

</body>
</html>




<script>
var data_array ;
var updateID ; 
const api_url = 'App/Controller/UserController.php';

window.onload = function() {
    sendData(api_url,"READ",null);
};

function cerrarSesion(){
    window.location.href = '/workanda/cerrarSesion.php';
}

function deleteUser(id){
    let confirmacion = confirm("DESEA ELIMINAR EL USUARIO ID: " + id);
    if (confirmacion) {
        sendData(api_url,"DELETE",{id:id});
    }    
}

async function updateUser() {
    let nombreUsuario = document.getElementById("nombre").value;
    let password = document.getElementById("password").value;
    let direccion = document.getElementById("direccion").value;

    data = {
        id : updateID ,
        nombreUsuario : nombreUsuario ,
        password : password ,
        direccion : direccion 
    }

    response = await sendData(api_url,"UPDATE",data);

    if(response)
    {   
        alert("Se ha modificado correctamente");
        cancelUpdate();
    }else
    {
        alert("Se ha producido un error");
    }
}

function updateUserPrepare(id){

    data = data_array.filter(arr => arr.id == id);

    updateID = id;

    document.getElementById("nombre").value    = data[0].nombreUsuario;
    //document.getElementById("password").value  = data[0].password;
    document.getElementById("direccion").value = data[0].direccion;

    
    document.getElementById("btnEnviar").classList.add("hide");
    document.getElementById("div-update").classList.remove("hide");
    
}

function cancelUpdate(){
    updateID = null;
    cleanFields();
    document.getElementById("div-update").classList.add("hide");
    document.getElementById("btnEnviar").classList.remove("hide");

}

function cleanFields(){
    document.getElementById("nombre").value    = "";
    document.getElementById("password").value  = "";
    document.getElementById("direccion").value = "";
}

async function createUser(){
    let nombreUsuario = document.getElementById("nombre").value;
    let password = document.getElementById("password").value;
    let direccion = document.getElementById("direccion").value;

    data = {
        nombreUsuario : nombreUsuario ,
        password : password ,
        direccion : direccion 
    }

    response = await sendData(api_url,"CREATE",data);
    
    if(response)
    {   
        alert("Se ha creado correctamente");
        cancelUpdate();
    }else
    {
        alert("Se ha producido un error");
    }
}

async function sendData(url,type,data) {
    
    const response = await fetch(url,
            {
                method:"POST" , 
                body : JSON.stringify({type:type , data:data})
            }
        );

        resp = await response.json();
    
    switch(type){
        case "READ":
            data_array = resp;
            show(data_array);
        break;

        default :    
            sendData(api_url,"READ",null);
            return resp;
        break;
    }

}

function show(data) {
    let tab = 
        `<table class="table-fill">
        <tr>
          <th class="text-left">ID</th>
          <th class="text-left">UserName</th>
          <th class="text-left">Password</th>
          <th class="text-left">Direccion</th>
          <th class="text-left">Eliminar</th>
          <th class="text-left">Modificar</th>
         </tr>`;
    
    
    for (let r of data) {
        tab += `<tr> 
        <td class="text-left">${r.id} </td>
        <td class="text-left">${r.nombreUsuario}</td>
        <td class="text-left">${r.password}</td> 
        <td class="text-left">${r.direccion}</td>   
        <td class="text-left"><button type="button" class="delete" onClick="deleteUser(${r.id})"> Eliminar </button></td>
        <td class="text-left"><button type="button" class="update" onClick="updateUserPrepare(${r.id})" > Modificar </button></td>         
        </tr>`;
    }

    tab+= `</table>`;
    
    document.getElementById("cargarLista").innerHTML = tab;
}


</script>