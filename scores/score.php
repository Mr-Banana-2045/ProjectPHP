<?php
session_start();
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
<script src="jquery-3.6.0.min.js"></script>
<body class="container-fluid d-flex align-items-center justify-content-center">
    <div class="card" style="width: 700px;">
  <div class="card-body">
    <h1 style="text-align:center;" class="text-primary">اتاق ثبت نمره <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : 'ناشناس'; ?></h1><br>
<form>
<div id="ok"></div>
</form>
</div>
</div>
</body>
<script>
    $(document).ready(function(){
            $.ajax({
                url: 'end.php',
                type: 'GET',
                success: function(data) {
                    $('#ok').html(data);
                }
            });
        });
    </script>
<script>
$(document).ready(function(){
    $('form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: 'scorephp.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === "success") {
                    alert(data.message);
                } else {
                    alert("خطا در به‌روزرسانی نمرات.");
                }
            },
            error: function() {
                alert("خطا در ارسال درخواست.");
            }
        });
    });
});
    </script>
</html>