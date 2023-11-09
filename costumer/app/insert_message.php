
<?php
include '../../components/connection.php';
if(!isset($_SESSION["userId"]))
{
    header("login.php");
}
else{
	$userId = $_SESSION["userId"];
}

?>
<?php
if(isset($_POST['message']))
{
    $message = $_POST['message'];
    $from = $_POST['from'];
    $sql = "INSERT INTO chat (msg,from_id,rec_id,time)
    VALUES('$message',$from,'0',NOW()) ;";
    mysqli_query($con,$sql);

    if(isset($_SESSION['conversations']))
    {
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
    }
}
?>