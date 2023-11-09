<?php
include '../components/connection.php';
$adminId= 1;
$sql = "SELECT * FROM restuser,restorder WHERE restuser.userId = restorder.userId order by totalPrice desc";
if(isset($_GET["sort"]))
{
    if($_GET["sort"] == 1)
    {
        $sql = "SELECT * FROM restuser,restorder WHERE restuser.userId = restorder.userId order by firstName asc";
        if (isset($_POST["search"]))
        {
            $fn = $_POST["what"];
            $sql = "SELECT * FROM restuser,restorder WHERE restuser.userId = restorder.userId AND firstName = '$fn'  order by firstName asc";
        }

    }
    else if($_GET["sort"] == 2)
    {
        $sql = "SELECT * FROM restuser,restorder WHERE restuser.userId = restorder.userId order by totalPrice desc";
        if (isset($_POST["search"]))
        {
            $fn = $_POST["what"];
            $sql = "SELECT * FROM restuser,restorder WHERE restuser.userId = restorder.userId AND firstName = '$fn'  order by firstName desc";
        }
    }
}
if (isset($_POST["search"]))
{
    $fn = $_POST["what"];
    $sql = "SELECT * FROM restuser,restorder WHERE restuser.userId = restorder.userId AND firstName = '$fn'  order by firstName desc";
}
if(isset($_POST["undo"])){
    $sql = "SELECT * FROM restuser,restorder WHERE restuser.userId = restorder.userId order by totalPrice desc";
}

$query = mysqli_query($con,$sql);
if(!mysqli_fetch_array($query))
    $not_found = true;
$query = mysqli_query($con,$sql);
?>
<html>
<head>
<link rel="stylesheet" href="css/index2.css">
<link rel="stylesheet" href="css/costumers.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
<link rel="stylesheet" href="css/history.css">
<link rel="stylesheet" href="css/costumers.css">
<style>
    .center-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #bcd4e6;
  padding: 20px;
  margin-bottom:12%;
}

.sort-container,
.search-container {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.sort-container label,
.search-container label {
  font-size: 18px;
  font-weight: bold;
  margin-right: 10px;
}

select,
input[type="text"] {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  outline: none;
  transition: border-color 0.2s ease-in-out;
}

select {
  min-width: 150px;
}

input[type="text"] {
  min-width: 300px;
}

select:focus,
input[type="text"]:focus {
  border-color: #007bff;
}

button {
  padding: 10px 20px;
  font-size: 16px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: #ffffff;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

button:hover {
  background-color: #0056b3;
}
.container{
    margin-left:7%;                 
}
</style>
<script>
    function handleSortChange() {
                var sortOption = document.getElementById("sort").value;
                if (sortOption === "z-a")
                    window.location.href="history.php?sort=2";
                else if(sortOption === "a-z")    
                    window.location.href="history.php?sort=1";
    }
</script>
</head>
<body>
<div class="innercard p-2">
    <?php include 'components/header.php'; ?>
    <div class="center-container">
  <div class="sort-container">
    <label for="sort">Sort:</label>
    <select id="sort" onchange="handleSortChange()">
      <option value="a-z" <?php if(isset($_GET["sort"]) && $_GET["sort"] == 1) echo "selected";  ?> >A to Z</option>
      <option value="z-a" <?php if(isset($_GET["sort"]) && $_GET["sort"] == 2) echo "selected";  ?> >Z to A</option>
    </select>
  </div>
  <form action="history.php" method="post">
  <div class="search-container">
    <label for="search">Search:</label>
    <input type="text" id="what" name = "what" required placeholder="Type here to search..."> 
    <label for=""></label><button name="search" onclick="search()" >search</button>
    </form>
    
  </div>
  <?php if(isset($_POST["search"])){ ?> 
    <form action=""method="POST">
    <label for=""></label><button name="undo" onclick="">undo</button>
    </form>
    <?php } ?>
</div>

    <div class="container">
    <?php if(isset($not_found)&& $not_found) { ?>
        not found
    <?php }else { ?>   
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>costumer</th>
                <th>Date</th>
                <th>Products</th>
				<th>Generated_Profit</th>
				<th>metohd</th>
			</tr>
		</thead>
		<tbody>
			<?php
            while($res = mysqli_fetch_array($query)){
                $id = $res["orderId"];
                $costumer = $res["firstName"]."  ".$res["lastName"];
                $date = $res["placedOn"];
                $products = $res["totalProducts"];
                $Generated_prifit = $res["totalPrice"];
                $method = $res["method"]; 
            ?>
            <tr>
            <td><?=$id;?></td>
            <td><?=$costumer;?></td>
            <td><?=$date;?></td>
            <td><?=$products;?></td>
            <td><?=$Generated_prifit;?>$</td>
            <td><?=$method;?></td>
            </tr>
            <?php } ?>
		</tbody>
	</table>
    <?php } ?>
    </div>
</div>
</body>
</html>
        