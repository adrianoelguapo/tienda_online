$(document).ready(function(){
    $('.accept-order').click(function(){
        let orderId = $(this).data('order-id');
        $.ajax({
            url: 'update-order-status.php',
            type: 'POST',
            dataType: 'json',
            data: { order_id: orderId, action: 'accept' },
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

    $('.reject-order').click(function(){
        let orderId = $(this).data('order-id');
        $.ajax({
            url: 'update-order-status.php',
            type: 'POST',
            dataType: 'json',
            data: { order_id: orderId, action: 'reject' },
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