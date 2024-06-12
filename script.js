$(document).ready(function(){
    $('#login-form').on('submit', function(event){
        event.preventDefault();
        
        const username = $('#username').val();
        const password = $('#password').val();
        
        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {
                username: username,
                password: password
            },
            success: function(response){
                if(response === 'success'){
                    window.location.href = 'dashboard.html';
                } else {
                    $('#message').text('Invalid username or password');
                }
            }
        });
    });
});
