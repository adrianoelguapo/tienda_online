$(document).ready(function(){
    function showModal(message) {
        $("#notificationModal .modal-body").text(message);
        $("#notificationModal").modal('show');
    }

    $('.accept-order').click(function(){
        let orderId = $(this).data('order-id');
        $.ajax({
            url: 'update-order-status.php',
            type: 'POST',
            dataType: 'json',
            data: { order_id: orderId, action: 'accept' },
            success: function(response){
                if(response.success){
                    showModal(response.message);
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
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
                    showModal(response.message);
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
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