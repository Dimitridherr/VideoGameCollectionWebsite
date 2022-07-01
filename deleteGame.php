<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Delete Game</title>
    </head>
    <body>
		<p>
			<?php 
				$sql = sprintf("DELETE FROM Owns WHERE userID = %d AND game = \"%s\" AND platform = \"%s\" ",$_POST["userID"], $_POST["game"], $_POST["platform"]);
				try 
				{
					$conn = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$conn->exec($sql);
					echo sprintf("The game %s, %s was removed from user %s",$_POST["game"], $_POST["platform"], $_POST["userID"]);
					exitTimeout();
				} catch(PDOException $e) 
				{
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn = null;
			?>
		</p>
    </body>
</div>
</html>
