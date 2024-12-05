<html>
<script src="jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="code.css">
<script>
    $(document).ready(function(){
        $('form').on('submit', function(event){
            document.getElementById("end").innerText = "ok";
            event.preventDefault();
            $.ajax({
                url: 'conn.php',
                type: 'GET',
                data: $(this).serialize(),
                success: function(data) {
                    console.log("ok");
                }
            });
        });
    });
    </script>
        <h1>Data Send DB</h1>
<form>
    <label>pisheh</label><br>
<input type="text" placholder="name" name="name" pattern="^[\u0600-\u06FF\s]+$" required><br>
<input type="submit" value="send">
</form>
<p id="end"></p>
</html>