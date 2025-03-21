$(document).ready(function(){
  function showModal(message) {
    $('#notificationModal .modal-body').text(message);
    $('#notificationModal').modal('show');
}

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
          if(response.role === 'admin'){
            window.location.href = 'admin.php';
          } else {
            window.location.href = 'index.php';
          }
        } else {
          showModal(response.error);
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        console.error('Error: ' + textStatus, errorThrown);
      }
    });
  });
});