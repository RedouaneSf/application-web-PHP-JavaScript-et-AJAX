<html>  
<head>  
    <title>Registration Form</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  
</head>
<style>
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 .msg
{
  color: red;
  font-weight: 700;
} 
</style>
<body>  
    <div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Registration Form</h3><br/>
    <div class="box">
      <div class="form-group">
       <label for="name">Enter Your Name</label>
       <input type="text" name="name" id="name" placeholder="Enter Name" required class="form-control"/>
      </div>  
      <div class="form-group">
       <label for="email">Enter Your Email</label>
       <input type="email" name="email" id="email" placeholder="Enter Email" required class="form-control"/>
      </div>
      <div class="form-group">
       <label for="password">Enter Your Password</label>
       <input type="password" name="pwd" id="pwd" placeholder="Enter Password" required class="form-control"/>
      </div>
     
      <div class="form-group">
       <input type="submit" id="register" name="register" value="Submit" class="btn btn-success"/>
       <a href="login.php">Login</a>
       </div>
       <p class="msg"></p>
     </div>
   </div>  
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#register").on("click",function(){
      var name = $("#name").val();
      var email = $("#email").val();
      var password = $("#pwd").val();
      
      if(name=='' || email=='' || password=='')
      {
        $(".msg").html("All fields are required!");
      }
      
      else
      {
        $.ajax({
          url: './authRepos.php',
          method: 'post',
          data: {name: name, emailid: email, pwd: password},
          success: function(data)
          {
            $(".msg").html(data);
          }
        });
      }
    });
  });
</script>
 </body>  
</html>