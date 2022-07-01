<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modify User</title>
    </head>
    <body>
		<p>
			<?php 
				//Values built to include assignment when appropriate
				$userID=(empty($_POST["userID"])) ? NULL : $_POST["userID"];
				$fname=(empty($_POST["fname"])) ? NULL : $_POST["fname"];
				$mname=(empty($_POST["mname"])) ? NULL : $_POST["mname"];
				$lname=(empty($_POST["lname"])) ? NULL : $_POST["lname"];
				$birthday=(empty($_POST["birthday"])) ? NULL : $_POST["birthday"];

				//Tests to ensure primary values are given
				if(is_null($userID))
				{
					echo "Need a userID...";
					exitTimeout();
				}

				//Finds the given userID
				try 
				{
					//establish connection
					$conn = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					//Gets user
					$u = sprintf("SELECT userID FROM User WHERE userID=%d",$userID);
    				$qu = $conn->query($u);
    				$qu->setFetchMode(PDO::FETCH_ASSOC);

					//Fetches the user
					while($urow=$qu->fetch()){
					     $isUValid=$urow['userID'];
					}
				} catch(PDOException $e) 
				{
					echo $e->getMessage();
				}

				//Tests if the user exists
				if(empty($isUValid))
				{
					echo sprintf("The user \"%s\" does not exist\n",$userID);
					exitTimeout();
				}

				//Updates relevant information
				try 
				{
					$conn->exec("START TRANSACTION");
                    $conn->exec("SAVEPOINT State");
					//First name
					if(!is_null($fname))
					{
						$sql=sprintf("UPDATE User SET fname=\"%s\" WHERE userID=%d ",$fname,$userID);
						$conn->exec($sql);
					}
					//Middle name
					if(!is_null($mname))
					{
						$sql=sprintf("UPDATE User SET mname=\"%s\" WHERE userID=%d ",$mname,$userID);
						$conn->exec($sql);
					}
					//Last name
					if(!is_null($lname))
					{
						$sql=sprintf("UPDATE User SET lname=\"%s\" WHERE userID=%d ",$lname,$userID);
						$conn->exec($sql);
					}
					//Birthday
					if(!is_null($birthday))
					{
						$sql=sprintf("UPDATE User SET birthday=\"%s\" WHERE userID=%d ",$birthday,$userID);
						$conn->exec($sql);
					}
				} catch(PDOException $e) 
				{
					$conn->exec("ROLLBACK TO State");
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn->exec("COMMIT");
				echo sprintf("Modified user %d...",$userID);
				$conn = null;
				exitTimeout();
			?>
		</p>
    </body>
</div>
</html>
