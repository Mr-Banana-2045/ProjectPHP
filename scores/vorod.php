<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data GET DB</title>
    <script src="jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="code.css">
</head>
<body>
    <h1>Data GET DB</h1>
    <form id="loginForm">
        <input type="hidden" name="action" value="login">
        <select id="names" name="name" class="custom-select" style="text-align:right;">
            <option value="">لطفا انتخاب کنید</option>
        </select><br>
        <input type="password" placeholder="password" name="password" required><br>
        <input type="submit" value="send">
    </form>

    <script>
        $(document).ready(function(){
            // Fetch names via AJAX
            $.ajax({
                url: 'stud.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        $('#names').append(`<option value="${item.name}">${item.name}</option>`);
                    });
                }
            });

            // Handle form submission
            $('#loginForm').on('submit', function(event){
                event.preventDefault();
                const selectedName = $('#names').val();

                $.ajax({
                    url: 'vor.php?action=login',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data) {
                        if (selectedName === "شریعتمداری") {
                            window.location.href = "score.php";
                        } else {
                            console.log("ok");
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
