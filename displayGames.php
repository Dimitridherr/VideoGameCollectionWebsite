<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
    //Games Table
    $games = 'SELECT game, platform, releaseYear, studio, subGenre, rating, currentPrice FROM Game';
    $qg = $pdo->query($games);
    $qg->setFetchMode(PDO::FETCH_ASSOC);
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
		<!--List of Available Games-->
		<form action="/start.php" method="post"><input type="submit" value="RETURN TO HOME"></form>
        <h2>List of Available Games</h2>
        <table border=1 cellspacing=5 cellpadding=5>
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Platform</th>
                    <th>Release Year</th>
                    <th>Studio</th>
                    <th>Subgenre</th>
                    <th>Rating</th>
                    <th>Current Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $qg->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['game']) ?></td>
                        <td><?php echo htmlspecialchars($row['platform']); ?></td>
                        <td><?php echo htmlspecialchars($row['releaseYear']); ?></td>
                        <td><?php echo htmlspecialchars($row['studio']); ?></td>
                        <td><?php echo htmlspecialchars($row['subGenre']); ?></td>
                        <td><?php echo htmlspecialchars($row['rating']); ?></td>
                        <td><?php echo htmlspecialchars($row['currentPrice']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </body>
</div>
</html>
