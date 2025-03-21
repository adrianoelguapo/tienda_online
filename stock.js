$(document).ready(function(){
    $('.add-stock-btn').click(function(){
      let productId = $(this).data('product-id');
      let $input = $(this).siblings('.add-stock-quantity');
      let quantity = parseInt($input.val());
      if (isNaN(quantity) || quantity < 1) {
        alert("Please enter a valid quantity");
        return;
      }
      $.ajax({
        url: 'update-stock.php',
        type: 'POST',
        dataType: 'json',
        data: { product_id: productId, quantity: quantity },
        success: function(response){
          if(response.success){
            alert(response.message);
            location.reload();
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