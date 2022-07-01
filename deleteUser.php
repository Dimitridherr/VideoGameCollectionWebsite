<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Delete User</title>
    </head>
    <body>
		<p>
			<?php
				$userID=$_POST["userID"];

				//Tests if the user owns any games and removes them
				try 
				{
					//establish connection
					$conn = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					//deletes all owned games
					$rmv = sprintf("DELETE FROM Owns WHERE userID=%d",$userID);
    				$conn->exec($rmv);

    				//deletes user
    				$sql = sprintf("DELETE FROM User WHERE userID = %d",$userID);
    				$conn->exec($sql);
    				echo sprintf("User ID %d deleted...",$userID);
					exitTimeout();
				} catch(PDOException $e) 
				{
					echo $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
