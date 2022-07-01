<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Exchange Games</title>
    </head>
    <body>
        <p>
            <?php 
                //Extracts values of the game
                $userID1=(empty($_POST["userID1"])) ? NULL : $_POST["userID1"];
                $userID2=(empty($_POST["userID2"])) ? NULL : $_POST["userID2"];
                $game=(empty($_POST["game"])) ? NULL : $_POST["game"];
                $platform=(empty($_POST["platform"])) ? NULL : $_POST["platform"];

                //Tests to ensure primary values are given
                if(is_null($userID1))
                {
                    echo "Need a userID to take game from...";
                    exitTimeout();
                }
                if(is_null($userID2))
                {
                    echo "Need a userID to give game to...";
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

                    //Gets game and platform owned by user 1
                    $g = sprintf("SELECT game FROM Owns WHERE userid=%d AND game=\"%s\" AND platform=\"%s\"",$userID1,$game,$platform);
                    $qg = $conn->query($g);
                    $qg->setFetchMode(PDO::FETCH_ASSOC);

                    //Fetches the game
                    while($grow=$qg->fetch()){
                         $isGValid=$grow['game'];
                    }

                    //Gets user 1
                    $u1 = sprintf("SELECT userID FROM User WHERE userID=%d",$userID1);
                    $qu1 = $conn->query($u1);
                    $qu1->setFetchMode(PDO::FETCH_ASSOC);

                    //Fetches the user
                    while($urow=$qu1->fetch()){
                         $isU1Valid=$urow['userID'];
                    }

                    //Gets user 2
                    $u2 = sprintf("SELECT userID FROM User WHERE userID=%d",$userID2);
                    $qu2 = $conn->query($u2);
                    $qu2->setFetchMode(PDO::FETCH_ASSOC);

                    //Fetches the user
                    while($urow=$qu2->fetch()){
                         $isU2Valid=$urow['userID'];
                    }
                } catch(PDOException $e) 
                {
                    echo $e->getMessage();
                }

                //Tests if both users and game exists
                if(empty($isU1Valid))
                {
                    echo sprintf("The user \"%s\" does not exist\n",$userID1);
                    exitTimeout();
                }
                if(empty($isU2Valid))
                {
                    echo sprintf("The user \"%s\" does not exist\n",$userID2);
                    exitTimeout();
                }
                if(empty($isGValid))
                {
                    echo sprintf("The game \"%s\" on platform \"%s\" does not exist\n",$game,$platform);
                    exitTimeout();
                }

                //Proceeds to exchange the games between the users
                try 
                {
                    //Creates statements
                    $stmt1=sprintf("DELETE FROM Owns WHERE userID = %d AND game = \"%s\" AND platform = \"%s\" ",$userID1, $game, $platform);
                    $stmt2=sprintf("INSERT INTO Owns (userID,game,platform) VALUES (%d, \"%s\", \"%s\")",$userID2,$game,$platform);

                    $conn->exec("START TRANSACTION");
                    $conn->exec("SAVEPOINT State");
                    $conn->exec($stmt1);
                    $conn->exec($stmt2);

                    //To test rollback, randomly cause failure
                    if(rand(1,10)>=8)
                    {
                        echo "Random failure... rolling back...";
                        $conn->exec("ROLLBACK TO State");
                    }
                    else
                    {
                        $conn->exec("COMMIT");
                        echo sprintf("Added game %s on platform %s from user %d's to user %d's collection...",$game,$platform,$userID1,$userID2);
                    }
                } catch(PDOException $e) 
                {
                    echo sprintf("Following error: %s",$e->getMessage());
                    $conn->exec("ROLLBACK TO State");
                }
                $conn = null;
                exitTimeout();
            ?>
        </p>
    </body>
</div>
</html>
