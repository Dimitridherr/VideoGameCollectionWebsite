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
		<!--5 Table Join-->
        <?php
        try {
            $pdo = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);
            $f = sprintf("SELECT concat(fname,\" \",lname) AS \"User\", G.game AS \"Games Owned\", O.score AS \"User Score\", G.platform AS \"Game Console\", Sub.genre AS \"Genre\", S.studio AS \"Studio\", S.publisher AS \"Publisher\" FROM Game G, Owns O, User U, Studio S, Subgenre Sub, Classification C WHERE O.userID=U.userID AND O.game=G.game AND O.platform=G.platform AND G.studio=S.studio AND G.game=C.game and G.platform=C.platform AND C.subGenre=Sub.subGenre ORDER BY concat(fname,\" \",lname) ASC, G.game ASC, G.platform ASC, Sub.genre ASC, O.score ASC");
            $qf = $pdo->query($f);
            $qf->setFetchMode(PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            die("Could not connect to the database:" . $e->getMessage());
        }
        ?>
        <h2>All Games Owned by All Users</h2>
        <table border=1 cellspacing=5 cellpadding=5>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Games Owned</th>
                    <th>User Score</th>
                    <th>Game Console</th>
                    <th>Genre</th>
                    <th>Studio</th>
                    <th>Publisher</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $qf->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['User']) ?></td>
                        <td><?php echo htmlspecialchars($row['Games Owned']); ?></td>
                        <td><?php echo htmlspecialchars($row['User Score']); ?></td>
                        <td><?php echo htmlspecialchars($row['Game Console']); ?></td>
                        <td><?php echo htmlspecialchars($row['Genre']); ?></td>
                        <td><?php echo htmlspecialchars($row['Studio']); ?></td>
                        <td><?php echo htmlspecialchars($row['Publisher']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table> 
    </body>
</div>
</html>
