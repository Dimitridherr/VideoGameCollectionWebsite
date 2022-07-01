<?php
include("config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Video Game Collection Database</title>
    </head>
    <body>
        <form action="/report1.php" method="post"><input type="submit" value="ALL GAME REVIEWS"></form>
        <form action="/tableJoin.php" method="post"><input type="submit" value="ALL GAMES OWNED BY ALL USERS"></form>
        <form action="/displayPlatforms.php" method="post"><input type="submit" value="SEE ALL GAME PLATFORMS"></form>
        <form action="/displayOwnedGames.php" method="post"><input type="submit" value="DISPLAY ALL OWNED GAMES"></form>
        <!--Insert User-->
        <br><h2>Insert a new user:</h2>
        <form action="/displayUsers.php" method="post"><input type="submit" value="SEE ALL USERS"></form>
        <form action="/insertUser.php" method="post">
            <table>
                <tr><td>First name:</td><td><input type="text" id="fname" name="fname" value=""></td></tr>
                <tr><td>Middle name:</td><td><input type="text" id="mname" name="mname" value=""></td></tr>
                <tr><td>Last name:</td><td><input type="text" id="lname" name="lname" value=""></td></tr>
                <tr><td>Birthday:</td><td><input type="date" id="birthday" name="birthday" value=""></td></tr>
            </table>
            <input type="submit" value="INSERT">
        </form>

        <!--Insert New Game to Collection-->
        <br><h2>Add New Game to Collection:</h2>
        <form action="/displayGames.php" method="post"><input type="submit" value="SEE AVAILABLE GAMES"></form>
        <form action="/insertGame.php" method="post">
            <table>
                <tr><td>User ID</td><td><input type="text" id="userID" name="userID" value=""></td></tr>
                <tr><td>Game Name</td><td><input type="text" id="game" name="game" value=""></td></tr>
                <tr><td>Platform</td><td><input type="text" id="platform" name="platform" value=""></td></tr>
                <tr><td>Completed?</td><td><input type="checkbox" id="status" name="status"></td></tr>
                <tr><td>Hours Took to Complete</td><td><input type="number" id="hoursComplete" name="hoursComplete" min="0" max="1000" step="0.01" value="?"></td></tr>
                <tr><td>Review out of 10</td><td><input type="number" id="score" name="score" min="0" max="10" step="0.01" value=""></td></tr>
                <tr><td>Full Review</td><td><textarea name="userReview" id="userReview"></textarea></td></tr>
                <tr><td>Date Purchased</td><td><input type="date" id="purchaseDate" name="purchaseDate"></td></tr>
            </table>
            <input type="submit" value="INSERT">
        </form>

        <!--Modify User-->
        <br><h2>Modify User:</h2>
        <form action="/modifyUser.php" method="post">
            <table>
                <tr><td>User ID:</td><td><input type="text" id="userID" name="userID" value=""></td></tr>
                <tr><td></td></tr>
                <tr><td>----------Modifications----------</td></tr>
                <tr><td></td></tr>
                <tr><td>First name:</td><td><input type="text" id="fname" name="fname" value=""></td></tr>
                <tr><td>Middle name:</td><td><input type="text" id="mname" name="mname" value=""></td></tr>
                <tr><td>Last name:</td><td><input type="text" id="lname" name="lname" value=""></td></tr>
                <tr><td>Birthday:</td><td><input type="date" id="birthday" name="birthday" value=""></td></tr>
            </table>
            <input type="submit" value="UPDATE">
        </form>

        <!--Modify User's Game-->
        <br><h2>Modify User's Game:</h2>
        <form action="/modifyGame.php" method="post">
            <table>
                <tr><td>User ID</td><td><input type="text" id="userID" name="userID" value=""></td></tr>
                <tr><td>Game Name</td><td><input type="text" id="game" name="game" value=""></td></tr>
                <tr><td>Platform</td><td><input type="text" id="platform" name="platform" value=""></td></tr>
                <tr><td></td></tr>
                <tr><td>----------Modifications----------</td></tr>
                <tr><td></td></tr>
                <tr><td>Completed?</td><td><input type="checkbox" id="status" name="status"></td></tr>
                <tr><td>Hours Took to Complete</td><td><input type="number" id="hoursComplete" name="hoursComplete" min="0" max="1000" step="0.01" value="?"></td></tr>
                <tr><td>Review out of 10</td><td><input type="number" id="score" name="score" min="0" max="10" step="0.01" value="?"></td></tr>
                <tr><td>Full Review</td><td><textarea name="userReview" id="userReview"></textarea></td></tr>
                <tr><td>Date Purchased</td><td><input type="date" id="purchaseDate" name="purchaseDate"></td></tr>
            </table>
            <input type="submit" value="UPDATE">
        </form>

        <!--Exchange Game Between Users-->
        <br><h2>Exchange Game:</h2>
        <form action="/exchangeGames.php" method="post">
            <table>
                <tr><td>User ID Giving Game:</td><td><input type="text" id="userID1" name="userID1" value=""></td></tr>
                <tr><td>User ID Receiving Game:</td><td><input type="text" id="userID2" name="userID2" value=""></td></tr>
                <tr><td>Game Name</td><td><input type="text" id="game" name="game" value=""></td></tr>
                <tr><td>Platform</td><td><input type="text" id="platform" name="platform" value=""></td></tr>
            </table>
            <input type="submit" value="EXCHANGE">
        </form>
    </body>
</div>
</html>
