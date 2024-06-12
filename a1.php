<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <form id="loginForm">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
        <p id="error" style="color:red;"></p>
    </form>

    <script>
        $(document).ready(function () {
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: $(this).serialize(),
                    success: function (response) {
                        var jsonData = JSON.parse(response);

                        // Check if login was successful
                        if (jsonData.success == "1") {
                            location.href = 'dashboard.php';
                        } else {
                            $('#error').text(jsonData.message);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>