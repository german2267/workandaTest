
<?php   

session_start();

if(isset($_SESSION['usuarioWorkanda'])){
    header('Location: dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Document</title>
</head>
<body>

<div class="login-page">
  <div class="form">
    <h1>Test Tecnico!!!</h1>
    <form class="login-form">
      <input type="text" placeholder="username" id="usuario" value="user"/>
      <input type="password" placeholder="password" id = "pass" value="1234"/>
      <button type="button" onClick="LoginUser()">Login</button>
    </form>
  </div>
</div>
    

</body>
</html>

<script>
    const api_url = 'App/Controller/UserController.php';

    async function LoginUser(){
        let nombreUsuario = document.getElementById("usuario").value;
        let password = document.getElementById("pass").value;

        data = {
            nombreUsuario : nombreUsuario,
            password : password
        }

      login = await sendData(api_url,"LOGIN",data);
        
      console.log(login);
          
      if(login){
          window.location.href = "/workanda/dashboard.php";
      }else
      {
          alert("Usuario o contraseña no validos!")
      }

    }

    async function sendData(url,type,data) {
        
        const response = await fetch(url,
            {
                method:"POST" , 
                body : JSON.stringify({type:type , data:data})
            }
            );
        
        data = await response.json();
        return data;
    }


</script>