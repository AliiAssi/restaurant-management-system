<?php
include '../../components/connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "
    SELECT * FROM chat 
    WHERE (from_id = $id OR rec_id = $id)
    ORDER BY id ASC
    ";
	$query = mysqli_query($con,$sql);
    
    $conversations = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $conversations[] = $row;
    }
    $_SESSION['conversations'] = $conversations;
?>
<?php
}
?>