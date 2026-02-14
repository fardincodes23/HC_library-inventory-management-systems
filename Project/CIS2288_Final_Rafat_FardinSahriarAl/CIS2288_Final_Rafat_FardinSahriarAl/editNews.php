<?php
/*
 * Filename: editNews.php
 * Author:   Fardin
 * Date:     Dec 11, 2025
 * Purpose:  Form to edit existing news. Pre-filled with data. Protected.
 */
session_start();
$pageTitle = "News - Edit";
include("incPageHead.php");

/*
This page will present the user with an edit form and is also used to process form input

 //User Messages
            $message = "<div class='alert alert-success'>Edit Success <a href='index.php'>View All News</a></div>";
            $message = "<div class='alert alert-danger'>There was a problem with your query. <a href=\"javascript:history.back()\">Go Back</a></div>";
            $message = "<div class='alert alert-danger'>One or more fields was empty. <a href=\"javascript:history.back()\">Go Back</a></div>";
*/

//Making sure user is logged in
include ("incCheckCreds.php");

require("connect.php");

$message = "";
$new = null;

if (isset($_GET['storyId'])) {
    $storyId = $mysqli->real_escape_string($_GET['storyId']);
    $query = "SELECT * FROM news WHERE storyId = $storyId";
    $result = $mysqli->query($query);
    $num_results = $result->num_rows;

    if ($num_results> 0) {
        $new = $result->fetch_assoc();
        $storyId = $new['storyId'];
        $headline = $new['headline'];
        $storyDetails = $new['storyDetails'];
    } else {
        $message = "No news not found.";
    }
    $result->free();
} else {
    $message = "No ID provided.";
}

?>
    <body>
    <h2>Edit News Item</h2>


    <form action="editNews.php" method="post">
        <div class="form-group">
            <label for="headLine">Headline:</label><br>
            <input id="headLine" type="text" name="headline" class="form-control" value="<?php echo htmlspecialchars($new['headline']); ?>"/>
        </div>
        <div class="form-group">
            <label for="storyDetails">Story Details:</label><br>
            <textarea id="storyDetails" class="form-control" name="storyDetails"><?php echo htmlspecialchars($new['storyDetails']); ?></textarea><br>
            <input type="hidden" name="id" value=""/>
            <input type="submit" name="submit" class="btn btn-default" value="Commit Edit">
        </div>
    </form>


<?php
include("incPageFoot.php");
?>