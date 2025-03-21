$(document).ready(function(){
    $('.add-to-wishlist').click(function(){
        var productId = $(this).data('product-id');
        $.ajax({
            url: 'add-to-wishlist.php',
            type: 'POST',
            dataType: 'json',
            data: { product_id: productId },
            success: function(response){
                if(response.success){
                    alert('Product added to wishlist');
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
