<body>
    <style>
      body, html {
        height: 100%;
      }
      .bg {
        background-color:;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      h3{
        color:#8f4372;
      }
      .col-md-5{
        background: rgba(250, 249, 249, 0.7);
        padding:20px;
        border-radius:10px;
      }
    </style>
    <div class="bg">
      <div class="container py-5">
        <div class="col-md-5" py-5>
          <h3>Регистрация на сайте</h3>
          <form onsubmit="sendForm(this); return false;">
            <div class="form-group">
              <input name="name" type="text" class="form-control" placeholder="Ваше имя">
            </div>
            <div class="form-group">
              <input name="lastname" type="text" class="form-control" placeholder="Ваша фамилия">
            </div>
            <div class="form-group">
              <input name="email" type="text" class="form-control" placeholder="Ваш e-mail">
              <p id="info" style="color:red;"></p>
            </div>      
            <div class="form-group">
              <input name="pass" type="password" class="form-control" placeholder="Ваш пароль">
            </div>
            <div>
              <input type="submit" class="form-control btn btn-primary" value="Зарегистрироваться">
            </div>
          </form>          
        </div>
      </div>
    </div>
    
    <script>
      async function sendForm(form){
        let formData = new FormData(form);
        let response = await fetch("addUser",{
          method: "POST",
          body: formData
        });
        let result = await response.text();
        if(result == "success"){
          console.log("Зарегистрирован");
          location.href="auth";
        }else if(result=="exist"){
          info.innerText = `Такой пользователь уже есть!`;
        }else{
          console.log("");
        }
      }
    </script>
