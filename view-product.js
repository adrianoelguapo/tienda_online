$(document).ready(function(){
    function showModal(message) {
        $('#notificationModal .modal-body').text(message);
        $('#notificationModal').modal('show');
    }
    

    $('.add-to-wishlist').click(function(){
        let productId = $(this).data('product-id');
        $.ajax({
            url: 'add-to-wishlist.php',
            type: 'POST',
            dataType: 'json',
            data: { product_id: productId },
            success: function(response){
                if(response.success){
                    showModal('Product added to wishlist');
                } else {
                    showModal(response.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.error('Error: ' + textStatus, errorThrown);
            }
        });
    });

    $('.add-to-cart').click(function(){
        let productId = $(this).data('product-id');
        $.ajax({
            url: 'add-to-cart.php',
            type: 'POST',
            dataType: 'json',
            data: { product_id: productId },
            success: function(response){
                if(response.success){
                    showModal('Product added to cart');
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
