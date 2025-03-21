$(document).ready(function(){
  function showModal(message) {
    $("#notificationModal .modal-body").text(message);
    $("#notificationModal").modal("show");
  }

  $('.add-stock-btn').click(function(){
      let productId = $(this).data('product-id');
      let $input = $(this).siblings('.add-stock-quantity');
      let quantity = parseInt($input.val());
      if (isNaN(quantity) || quantity < 1) {
          showModal("Please enter a valid quantity");
          return;
      }
      $.ajax({
          url: 'update-stock.php',
          type: 'POST',
          dataType: 'json',
          data: { product_id: productId, quantity: quantity },
          success: function(response){
              if(response.success){
                  showModal(response.message);
                  setTimeout(function(){
                      location.reload();
                  }, 2000);
              } else {
                  showModal(response.error);
              }
          },
          error: function(jqXHR, textStatus, errorThrown){
              console.error('Error: ' + textStatus, errorThrown);
              showModal("Error: " + textStatus);
          }
      });
  });
});