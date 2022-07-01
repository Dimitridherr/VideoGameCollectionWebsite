<?php
   $DB_SERVER = 'localhost';
   $DB_USERNAME = '';
   $DB_PASSWORD = '';
   $DB_DATABASE = 'ddh5256_431W';
   $DSN = "mysql:host=$DB_SERVER;dbname=$DB_DATABASE";
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   //Used to display a exit timeout
   function exitTimeout() 
   {
      ?>
            <p>You will be redirected in 3 seconds</p>
            <script>
               var timer = setTimeout(function() {
                  window.location='start.php'
               }, 3000);
            </script>
      <?php
      exit();
   }
?>
