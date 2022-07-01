<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Insert New User</title>
    </head>
    <body>
		<p>
			<?php 
				//Extracts values of the user
				$fname=(empty($_POST["fname"])) ? NULL : $_POST["fname"];
				$lname=(empty($_POST["lname"])) ? NULL : $_POST["lname"];
				$mname=(empty($_POST["mname"])) ? NULL : $_POST["mname"];
				$birthday=(empty($_POST["birthday"])) ? NULL : $_POST["birthday"];

				//Tests for invalid values
				if (is_null($fname))
			    {      
			    	echo "Missing first name...";
			    	exitTimeout();
			    }
			    if (is_null($lname))
			    {      
			    	echo "Missing last name...";
			    	exitTimeout();
			    }

				//Inserts basic primary information
				try 
				{
					//establish connection
					$conn = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$sql=sprintf("INSERT INTO User (fname,lname) VALUES (\"%s\", \"%s\")",$fname,$lname);
					$conn->exec($sql);

					//Gets created user
					$userID=NULL;
					$u = sprintf("SELECT userID FROM User WHERE userID=%d",$userID);
    				$qu = $conn->query($u);
    				$qu->setFetchMode(PDO::FETCH_ASSOC);

					//Fetches the user
					while($urow=$qu->fetch()){
					     $userID=$urow['userID'];
					}
				} catch(PDOException $e) 
				{
					echo $e->getMessage();
				}

				//Add additional information through updates
				try 
				{
					$conn->exec("START TRANSACTION");
                    $conn->exec("SAVEPOINT State");
					//Middle Name
					if(is_null($mname))
					{
						$sql=sprintf("UPDATE User SET mname=\"%s\" WHERE userID=%d",$mname,$userID);
						$conn->exec($sql);
					}
					//Birthday
					if(is_null($birthday))
					{
						$sql=sprintf("UPDATE User SET birthday=\"%s\" WHERE userID=%d",$birthday,$userID);
						$conn->exec($sql);
					}
				} catch(PDOException $e) 
				{
					$conn->exec("ROLLBACK TO State");
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn->exec("COMMIT");
				echo sprintf("User \"%s\", \"%s\" added...",$fname,$lname);
				$conn = null;
				exitTimeout();
			?>
		</p>
    </body>
</div>
</html>
