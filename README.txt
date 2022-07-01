This project was completed for CMPSC 431W: Database Management Systems. Our project's prompt was to create a website that keeps some sort of running database on a chosen domain using SQL and php or python as the interface. Our team chose to create a website that would maintain a collection of users' owned and played video games. We chose to use php to manage the SQL database and send queries when needed. 

This project allowed our team to learn the application of SQL in real world scenarios. Furthermore, the team gained an in-depth understanding of php.


Project Files Summary
config.php is used to display an exit timeout after performing an action.
deleteGame.php allows the user to delete a game from the Owns table.
deleteUser.php will remove a user from the User table and all of their associated games from the Owns table.
exchangeGames.php is the transaction file. Here, the code tests to make sure there are valid values given from the Owns table. If so, then the code will roll a random number generator. 80% of the time, the video game transaction goes through successfully. 20% of the time there is a simulated error, rolling back the code to a savepoint created before the transaction took place.
insertGame.php lets the user choose a game to add to their collection in the Owns table as long as the game/user exists and the user does not already own the game.
insertUser.php adds a user to the database given a first and last name in the User table.
modifyGame.php allows the user to modify a game that they own in the Owns table. More specifically, it allows them to modify the hours it took them to complete the game, their score, review, if they completed the game, and when they bought it.
modifyUser.php lets the user change some of their own information in the User table, such as their name and birthday.
displayGames.php displays all the games available for the users to add to their collection.
displayOwnedGames.php displays all the games owned by every user.
displayPlatforms.php displays all the available gaming platforms.
displayUsers.php displays all the users currently in the database.
report1.php display report 1 which shows an overview of all the games and their reviews contained in the database
tableJoin.php displays an example of a 5 table join that shows every single game that each owner owns, their platforms, the user’s score, their genres, and the studios/publishers that released the game.
start.php is the main file used to run the entire code. This is where the adding, deleting, modifying, transaction, and report mockups all are.


Sources
Website used to get all the data used in the Games, Studio, Owns, and Classification tables - https://extendsclass.com/csv-generator.html
Website used for the Platform table - https://gamicus.fandom.com/wiki/List_of_last_video_games_released_on_video_game_consoles
Website used for the User table - https://www.kaggle.com/sidtwr/videogames-sales-dataset/version/1?select=Video_Games_Sales_as_at_22_Dec_2016.csv
Joshua Bibighaus provided the data used in the Subgenre and Reviewer tables.
Dimitri Herr provided the data used in Review table.
