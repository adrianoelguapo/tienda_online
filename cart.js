$(document).ready(function(){

    $('.plus-btn').click(function(){
        let $row = $(this).closest('.cart-item');
        let $input = $row.find('.cart-item-qty');
        let quantity = parseInt($input.val());
        quantity++;
        $input.val(quantity);
        updateCartItem($row, quantity);
    });

    $('.minus-btn').click(function(){
        let $row = $(this).closest('.cart-item');
        let $input = $row.find('.cart-item-qty');
        let quantity = parseInt($input.val());
        if(quantity > 1){
            quantity--;
            $input.val(quantity);
            updateCartItem($row, quantity);
        }
    });

    $('.cart-item-qty').on('change', function(){
        let $row = $(this).closest('.cart-item');
        let quantity = parseInt($(this).val());
        if(isNaN(quantity) || quantity < 1){
            quantity = 1;
            $(this).val(quantity);
        }
        updateCartItem($row, quantity);
    });

    $('.cart-item-remove').click(function(){
        if(confirm("Remove this item from your cart?")){
            let $row = $(this).closest('.cart-item');
            let productId = $row.data('product-id');
            $.ajax({
                url: 'remove-from-cart.php',
                type: 'POST',
                dataType: 'json',
                data: { product_id: productId },
                success: function(response){
                    if(response.success){
                        location.reload();
                    } else {
                        alert(response.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.error('Error: ' + textStatus, errorThrown);
                }
            });
        }
    });

    function updateCartItem($row, newQuantity){
        let productId = $row.data('product-id');
        $.ajax({
            url: 'update-cart-quantity.php',
            type: 'POST',
            dataType: 'json',
            data: { product_id: productId, quantity: newQuantity },
            success: function(response){
                if(response.success){
                    location.reload();
                } else {
                    alert(response.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.error('Error: ' + textStatus, errorThrown);
            }
        });
    }
});
