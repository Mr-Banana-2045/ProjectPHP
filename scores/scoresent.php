<html>
<script src="jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="code.css">
    <h1>Data login DB</h1>
<form>
    <input type="text" placholder="name" name="user" required><br>
    <select id="dynamicSelect" name="teach">
        <option value="">لطفا انتخاب کنید</option>
    </select><br>
    <select id="dars" name="name">
        <option value="">لطفا انتخاب کنید</option>
    </select><br>
<input type="submit" value="send">
</form>
<p id="end"></p>
<script>
    $(document).ready(function(){
            $.ajax({
                url: 'stud.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        $('#dynamicSelect').append(`<option value="${item.name}">${item.name}</option>`);
                    });
                }
            });
        });
    </script>
    <script>
    $(document).ready(function(){
            $.ajax({
                url: 'db5.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        $('#dars').append(`<option value="${item.name}">${item.name}</option>`);
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
                url: 'conns.php',
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