<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO($DSN, $DB_USERNAME, $DB_PASSWORD);

    //User Table
    $user = 'SELECT userID, fname, mname, lname, birthday FROM User';
    $qu = $pdo->query($user);
    $qu->setFetchMode(PDO::FETCH_ASSOC);
} catch (\Throwable $e) {
    die("Could not connect to the database:" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>All Users</title>
    </head>
    <body>
		<!--All Users-->
        <form action="/start.php" method="post"><input type="submit" value="RETURN TO HOME"></form>
        <br><h2>List of All Users</h2>
            <table border=1 cellspacing=5 cellpadding=5>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>First name</th>
                            <th>Middle name</th>
                            <th>Last name</th>
                            <th>Birthday</th>
                            <th>Delete?</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $qu->fetch()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['userID']) ?></td>
                                <td><?php echo htmlspecialchars($row['fname']); ?></td>
                                <td><?php echo htmlspecialchars($row['mname']); ?></td>
                                <td><?php echo htmlspecialchars($row['lname']); ?></td>
                                <td><?php echo htmlspecialchars($row['birthday']); ?></td>
                                <td><?php echo '<form action="/deleteUser.php" method="post"><input type="submit" value="DELETE"><input type="hidden" name="userID" value="' . htmlspecialchars($row['userID']) . '"></form>'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
            </table>
    </body>
</div>
</html>
