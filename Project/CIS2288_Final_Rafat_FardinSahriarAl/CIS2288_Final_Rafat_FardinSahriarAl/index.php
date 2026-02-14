<?php
/*
 * Filename: index.php
 * Author:   Fardin
 * Date:     Dec 11, 2025
 * Purpose:  Display news with admin controls when logged in.
 */


global $mysqli;
session_start();
require_once "connect.php";

$pageTitle = "News - Home";
include("incPageHead.php");

$query = "SELECT storyId, headline, storyDetails FROM news";
$result = $mysqli->query($query);
?>
    <div class="jumbotron"></div>
<?php

echo "<div class='panel panel-default'>";

if (isset($_SESSION['valid_user'])) {
    $glyphEditIcon = "<span style='float:right'><a title='edit this story' href='editNews.php?='><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></span>";

} else
    $glyphEditIcon = "";

if ($result) {
    $numResults = $result->num_rows;
    if ($numResults > 0) {
        $news = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($news as $new) {

            echo "<div class='panel-heading'>" . htmlspecialchars($new['headline']) . $glyphEditIcon. "</div>";
            echo "<div class='panel-body'>" . htmlspecialchars($new['storyDetails']) . "</div>";

        }

        echo "</div>";
    } else {
        echo "<div class='alert alert-warning'>No news found.</div>";
    }
    $result->free();
} else {
    echo "<div class='alert alert-danger'>Error retrieving data.</div>";
}
include("incPageFoot.php");
$mysqli->close();
?>