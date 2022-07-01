<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Report 1</title>
    </head>
    <body>
        <form action="/start.php" method="post"><input type="submit" value="RETURN TO HOME"></form>
		<!--Report 1-->
        <?php
        try {
            $pdo = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
            $a = sprintf("SELECT G.game AS \"Game\", G.platform AS \"Platform\", R.score AS \"Score\", R.reviewer AS \"Reviewer\" FROM Game G, Review R WHERE G.game=R.game AND G.platform=R.platform ORDER BY G.game ASC, G.platform ASC, R.reviewer ASC");
            $qa = $pdo->query($a);
            $qa->setFetchMode(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            die("Could not connect to the database:" . $e->getMessage());
        }
        ?>
        <h2>All Game Reviews</h2>
        <table border=1 cellspacing=5 cellpadding=5>
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Platform</th>
                    <th>Score</th>
                    <th>Reviewer</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $qa->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Game']) ?></td>
                        <td><?php echo htmlspecialchars($row['Platform']); ?></td>
                        <td><?php echo htmlspecialchars($row['Score']); ?></td>
                        <td><?php echo htmlspecialchars($row['Reviewer']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>  
    </body>
</div>
</html>
