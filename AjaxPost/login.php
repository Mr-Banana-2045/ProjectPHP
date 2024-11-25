<html>
<script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="code.css">
    <h1>Data login DB</h1>
<form>
    <input type="text" placholder="name" name="name" required><br>
    <select id="dynamicSelect" name="pish">
        <option value="">لطفا انتخاب کنید</option>
    </select><br>
    <input type="password" placholder="password" name="password" required><br>
<input type="submit" value="send">
</form>
<p id="end"></p>
<script>
    $(document).ready(function(){
            $.ajax({
                url: 'db.php',
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
                url: 'conn1.php',
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