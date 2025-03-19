$(document).ready(function(){
    $('.login-form').submit(function(e){
      e.preventDefault();
      let username = $('#login-username').val();
      let password = $('#login-password').val();
      
      $.ajax({
        url: 'login(back).php',
        type: 'POST',
        data: { "login-username": username, "login-password": password },
        dataType: 'json',
        success: function(response){
          if(response.success){
            window.location.href = 'index.php';
          } else {
            alert(response.error);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          console.error('Error: ' + textStatus, errorThrown);
        }
      });
    });
  });
  