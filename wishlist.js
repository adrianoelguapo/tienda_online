$(document).ready(function(){
    $('.remove-from-wishlist').click(function(){
        let productId = $(this).data('product-id');
        $.ajax({
            url: 'remove-from-wishlist.php',
            type: 'POST',
            dataType: 'json',
            data: { product_id: productId },
            success: function(response) {
                if(response.success){
                    alert('Product removed from wishlist');
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
