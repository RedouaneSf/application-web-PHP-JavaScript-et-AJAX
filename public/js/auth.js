$(document).ready(function(){
    $('#register-btn').click(function(){
       
       $(".register-box").show();
       $(".login-box").hide();
    });
    $('#login-btn').click(function(){
       
        $(".register-box").hide();
        $(".login-box").show();
     });
     
     $('#login-frm').validate();
     $('#register-frm').validate({
        rules:{
            cpassword:{
                equalTo:"#password",
            }
        }
     });
     //submit register form without page refresh
     $("#register").click(function(e){
        if(document.getElementById('register-frm').checkValidity()){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "authRepos.php?action=register",
                data: $("#register-frm").serialize(),
                success: function (response) {
                    $("#alert").show();
                    $("#result").html(response);
                }
            });
        }
        return true;
     });

     //submit login form without page refresh
     $("#login").click(function(e){
        if(document.getElementById('login-frm').checkValidity()){
            e.preventDefault();
            var email= $('#lemail').val();
            var password= $('#lpassword').val();
            $.ajax({
                type: "POST",
                url: "authRepos.php?action=login",
                data: {
                    'checking_login': true,
                    'email': email,
                    'password': password,
                },
                success: function (response) {
                    $("#alert").show();
                    $("#result").html(response);
                }
            });
            
        }
        return true;
     });
});