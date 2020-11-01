<body>
    <style>
      body, html {
        height: 100%;
      }
      .bg {
        
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      h3{
        color:#22858a;
        font-family: 'Ubuntu', sans-serif;
      }
      .col-md-5{
        background: rgba(250, 249, 249, 0.75);
        padding:20px;
        border-radius:10px;
      }
    </style>
    <div class="bg">
      <div class="container py-5">
        <div class="col-md-5">
          <h3>Вход на сайт</h3>
          <form action = "php/auth_obr.php" method="POST" onsubmit="sendForm(this); return false;">
            <div class="form-group">
              <input name="email" type="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
              <input name="pass" type="password" class="form-control" name="password" placeholder="Пароль">
              <p id="info" style="color:red"></p>
            </div>
            <div>
              <input type="submit" class="btn btn-primary" value="Войти">
            </div>
          </form>          
        </div>
      </div>
    </div>
    
    <script>
      async function sendForm(form){
        info.innerHTML='';
        let formData = new FormData (form);
        let response = await fetch("authUser",{
          method: "POST",
          body: formData
        });
        let result = await response.text();
        if (result=="success"){
          location.href = "index";
        }else{
          info.innerHTML=`Логин или пароль введён неверно`;   
        }
      }
    </script>