<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);

    //Owns Table
    $owns = 'SELECT userID, game, platform, hoursComplete, score, userReview, status, purchaseDate FROM Owns';
    $qo = $pdo->query($owns);
    $qo->setFetchMode(PDO::FETCH_ASSOC);
} catch (\Throwable $e) {
    die("Could not connect to the database:" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>All Available Games</title>
    </head>
    <body>
		<!--List of Owned Games-->
        <h2>List of Owned Games</h2>
        <form action="/start.php" method="post"><input type="submit" value="RETURN TO HOME"></form>
            <table border=1 cellspacing=5 cellpadding=5>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Game</th>
                        <th>Platform</th>
                        <th>Completed</th>
                        <th>Game Time</th>
                        <th>Purchase Date</th>
                        <th>Score</th>
                        <th>Review</th>
                        <th>Delete?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $qo->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['userID']);?></td>
                            <td><?php echo htmlspecialchars($row['game']);?></td>
                            <td><?php echo htmlspecialchars($row['platform']);?></td>
                            <td><?php echo (htmlspecialchars($row['status'])) ? "Yes" : "No";?></td>
                            <td><?php echo htmlspecialchars($row['hoursComplete']);?></td>
                            <td><?php echo htmlspecialchars($row['purchaseDate']);?></td>
                            <td><?php echo htmlspecialchars($row['score']);?></td>
                            <td><?php echo htmlspecialchars($row['userReview']);?></td>
                            <!--HIDDEN PASS VALUES TO DELETE-->
                            <form action="/deleteGame.php" method="post">
                            <input type="hidden" id="userID" name="userID" value="<?php echo htmlspecialchars($row['userID']);?>">
                            <input type="hidden" id="game" name="game" value="<?php echo htmlspecialchars($row['game']);?>">
                            <input type="hidden" id="platform" name="platform" value="<?php echo htmlspecialchars($row['platform']);?>">
                            <td><input type="submit" value="DELETE"></td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            
    </body>
</div>
</html>
