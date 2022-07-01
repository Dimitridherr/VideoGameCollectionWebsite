<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>All Available Games</title>
    </head>
    <body>
		<!--List of All Platforms-->
        <form action="/start.php" method="post"><input type="submit" value="RETURN TO HOME"></form>
        <?php
        try {
            $pdo = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
            $p = 'SELECT platform, yearReleased, company, firstGameReleased, lastGameReleased, portable FROM Platform';
            $qp = $pdo->query($p);
            $qp->setFetchMode(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            die("Could not connect to the database:" . $e->getMessage());
        }
        ?>
        <h2>All Platforms</h2>
        <table border=1 cellspacing=5 cellpadding=5>
            <thead>
                <tr>
                    <th>Platform</th>
                    <th>Release Year</th>
                    <th>Company</th>
                    <th>First Game</th>
                    <th>Last Game</th>
                    <th>Portable</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $qp->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['platform']) ?></td>
                        <td><?php echo htmlspecialchars($row['yearReleased']); ?></td>
                        <td><?php echo htmlspecialchars($row['company']); ?></td>
                        <td><?php echo htmlspecialchars($row['firstGameReleased']); ?></td>
                        <td><?php echo htmlspecialchars($row['lastGameReleased']); ?></td>
                        <td><?php echo (htmlspecialchars($row['portable'])) ? "Yes":"No";?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </body>
</div>
</html>
