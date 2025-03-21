$(document).ready(function(){
    $('.profile-form').submit(function(e){
        e.preventDefault();
        let formData = $(this).serialize();
        $.ajax({
            url: 'update_profile.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if(response.success){
                    showModal('Profile updated successfully');
                } else {
                    showModal(response.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                showModal('An error occurred: ' + textStatus);
            }
        });
    });
    
    function showModal(message) {
        $("#notificationModal .modal-body").text(message);
        $("#notificationModal").modal('show');
    }
});
