<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Insert New Owned Game</title>
    </head>
    <body>
		<p>
			<?php 
				//Extracts values of the game
				$userID=(empty($_POST["userID"])) ? NULL : $_POST["userID"];
				$game=(empty($_POST["game"])) ? NULL : $_POST["game"];
				$platform=(empty($_POST["platform"])) ? NULL : $_POST["platform"];
				$hoursComplete=(empty($_POST["hoursComplete"])) ? NULL : $_POST["hoursComplete"];
				$score=(empty($_POST["score"])) ? NULL : $_POST["score"];
				$userReview=(empty($_POST["userReview"])) ? NULL : $_POST["userReview"];
				$completed=(empty($_POST["status"])) ? 0 : 1;
				$purchaseDate=(empty($_POST["purchaseDate"])) ? NULL : $_POST["purchaseDate"];

				//Tests to ensure primary values are given
				if(is_null($userID))
				{
					echo "Need a userID...";
					exitTimeout();
				}
				if(is_null($game))
				{
					echo "Need a game name...";
					exitTimeout();
				}
				if(is_null($platform))
				{
					echo "Need a platform name...";
					exitTimeout();
				}

				//Finds the given game and user
				try 
				{
					//establish connection
					$conn = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					//Gets game and platform
					$g = sprintf("SELECT game FROM Game WHERE game=\"%s\" AND platform=\"%s\"",$game,$platform);
    				$qg = $conn->query($g);
    				$qg->setFetchMode(PDO::FETCH_ASSOC);

    				//Fetches the game
					while($grow=$qg->fetch()){
					     $isGValid=$grow['game'];
					}

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

				//Tests if the game and user exists
				if(is_null($isGValid))
				{
					echo sprintf("The game \"%s\" does not exist\n",$game);
					exitTimeout();
				}
				if(is_null($isUValid))
				{
					echo sprintf("The user \"%s\" does not exist\n",$userID);
					exitTimeout();
				}

				//Inserts basic primary information
				try 
				{
					$sql=sprintf("INSERT INTO Owns (userID,game,platform) VALUES (%d, \"%s\", \"%s\")",$userID,$game,$platform);
					$conn->exec($sql);
				} catch(PDOException $e) 
				{
					echo $sql . "<br>" . $e->getMessage();
				}

				//Add additional information through updates
				try 
				{
					$conn->exec("START TRANSACTION");
                    $conn->exec("SAVEPOINT State");
					//Hours Complete
					if(!is_null($hoursComplete))
					{
						$sql=sprintf("UPDATE Owns SET hoursComplete=%d WHERE userID=%d AND game=\"%s\" AND platform=\"%s\"",$hoursComplete,$userID,$game,$platform);
						$conn->exec($sql);
					}
					//Score
					if(!is_null($score))
					{
						$sql=sprintf("UPDATE Owns SET score=%d WHERE userID=%d AND game=\"%s\" AND platform=\"%s\"",$score,$userID,$game,$platform);
						$conn->exec($sql);
					}
					//User Review
					if(!is_null($userReview))
					{
						$sql=sprintf("UPDATE Owns SET userReview=\"%s\" WHERE userID=%d AND game=\"%s\" AND platform=\"%s\"",$userReview,$userID,$game,$platform);
						$conn->exec($sql);
					}
					//Completed
					if(!is_null($completed))
					{
						$sql=sprintf("UPDATE Owns SET status=%d WHERE userID=%d AND game=\"%s\" AND platform=\"%s\"",$completed,$userID,$game,$platform);
						$conn->exec($sql);
					}
					//Purchase Date
					if(!is_null($purchaseDate))
					{
						$sql=sprintf("UPDATE Owns SET purchaseDate=\"%s\" WHERE userID=%d AND game=\"%s\" AND platform=\"%s\"",$purchaseDate,$userID,$game,$platform);
						$conn->exec($sql);
					}
					
				} catch(PDOException $e) 
				{
					$conn->exec("ROLLBACK TO State");
					echo $sql . "<br>" . $e->getMessage();
				}
				$conn->exec("COMMIT");
				echo sprintf("Added game %s on platform %s to user %d's collection...",$game,$platform,$userID);
				$conn = null;
				exitTimeout();
			?>
		</p>
    </body>
</div>
</html>
