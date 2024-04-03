<?php

include '../config/db.php';

function fetchVideosByUserGroup($userGroupId)
{
    global $db; // Assuming $db is your PDO database connection

    // Prepare the SQL statement
    $stmt = $db->prepare("SELECT * FROM videos WHERE user_group_id = :userGroupId");

    // Bind the user group ID to the SQL statement
    $stmt->bindParam(':userGroupId', $userGroupId, PDO::PARAM_INT);

    // Execute the query
    $stmt->execute();

    // Fetch all results as an associative array
    $videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $videos;
}