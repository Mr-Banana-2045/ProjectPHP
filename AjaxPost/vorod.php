<html>
<script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="code.css">
    <h1>Data GET DB</h1>
<form>
<input type="hidden" name="action" value="login">
    <input type="text" placholder="name" name="name" required><br>
    <input type="password" placholder="password" name="password" required><br>
<input type="submit" value="send">
</form>
<p id="end"></p>
<script>
    $(document).ready(function(){
            $.ajax({
                url: 'vor.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        $('#dynamicSelect').append(`<option value="${item.id}">${item.pish}</option>`);
                    });
                }
            });  
    });
    </script>
        <script>
    $(document).ready(function(){
        $('form').on('submit', function(event){
            document.getElementById("end").innerText = "ok";
            event.preventDefault();
            $.ajax({
                url: 'vor.php',
                type: 'GET',
                data: $(this).serialize(),
                success: function(data) {
                    console.log("ok");
                }
            });
        });
    });
    </script>
</html>