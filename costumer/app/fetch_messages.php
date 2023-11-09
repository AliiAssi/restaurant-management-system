
<?php
if(!isset($_SESSION["userId"]))
{
    header("login.php");
}
else{
	$userId = $_SESSION["userId"];
}

?>
<?php
function getConversations($con, $userId) {
    $sql = "
        SELECT * FROM chat 
        WHERE (from_id = $userId OR rec_id = $userId)
        ORDER BY id ASC
    ";
    $query = mysqli_query($con, $sql);

    if (!$query) {
        // Handle query error here
        return false;
    }

    $conversations = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $conversations[] = $row;
    }
    $_SESSION['conversations'] = $conversations;
    return $conversations;
}

?>
