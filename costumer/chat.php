<?php
include '../components/connection.php';
include 'app/fetch_messages.php';

if(!isset($_SESSION["userId"]))
{
    header("login.php");
}
else{
	$userId = $_SESSION["userId"];
}
$conversations = getConversations($con,$userId);
if(isset($_SESSION['conversations'])){
  $conversations = $_SESSION['conversations'];
  unset($_SESSION['conversations']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yumy  chat</title>
    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css"
    rel="stylesheet"
    />
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"
    ></script> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
      #chatBox{
        align-items: stretch;
        max-height: 500px;
      }
      /* Hide both vertical and horizontal scrollbars */
body::-webkit-scrollbar {
  display: none;
}

/* If you only want to hide the vertical scrollbar */
#chatBox::-webkit-scrollbar-vertical {
  display: none;
}

/* If you only want to hide the horizontal scrollbar */


        .container{
            height:100%;
        }
        
  .form-outline {
  display: flex;
  flex: 1;
}

.form-controll {
  width: 80%;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  resize: none;
}

#sendButton {
  width: 20%;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 15px;
  cursor: pointer;
}
body{
  height: 100%;
}

#sendButton:hover {
  background-color: #0056b3;
}
.card-body {
  flex: 1;
  overflow-y: auto;
}

.card {
  flex: 1;
  display: flex;
  flex-direction: column;
}
body, html {
  height: 100%;
  margin: 0;
  padding: 0;
}
    </style>
</head>
<?php include '../components/cosHeader.php'; ?>   
<body style="background-color: #e2eaef; height:100%;">
  <div class="container py-5">

    <div class="row d-flex justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card" id="chat1" style="border-radius: 15px;">
          <div
            class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0"
            style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <p class="mb-0 fw-bold"> Yumy Live chat</p>
            <i class="fas fa-times"></i>
          </div>
          <!-- start of the chat-->
          <!-- ************************************************************** -->
          <div class="card-body" id="chatBox">
            <?php
            foreach ($conversations as $chat){
            ?>
            <?php
            if($chat['from_id'] == $userId){
            ?>
            <div class="d-flex flex-row justify-content-start mb-4">
              <img src="users_profiles_img/default.png"
                alt="avatar 1" style="width: 45px; height: 100%;">
              <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);">
                <p class="small mb-0">
                <?=$chat['msg'];?>
                </p>
              </div>
            </div>
            <?php } ?>
            <?php
            if($chat['rec_id'] == $userId){
            ?>
            <!-- start of reply -->
            <div class="d-flex flex-row justify-content-end mb-4">
              <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #fbfbfb;">
                <p class="small mb-0">
                <?=$chat['msg'];?>
                </p>
              </div>
              <img src="../admin/images/R.png"
                alt="avatar 1" style="width: 45px; height: 100%;">
            </div>
            <?php } ?>
            <!-- end of reply -->
            <?php } ?>
          </div>
          <!-- end of it -->
          <div class="form-outline">
              <textarea class="form-controll" id="message" rows="1" placeholder="Type your message here"></textarea>
              <button id="sendButton"><i class="fa fa-paper-plane"></i></button>
          </div>
        </div>

      </div>
    </div>

  </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Your JavaScript code here
</script>

<script>
	var scrollDown = function(){
        let chatBox = document.getElementById('chatBox');
        alert("A");
        chatBox.scrollTop = chatBox.scrollHeight;
	}

	scrollDown();

	$(document).ready(function(){
      $("#sendButton").on('click', function(){
      	message = $("#message").val();
      	if (message == "") return;

      	$.post("app/insert_message.php",
      		   {
      		   	message: message,
              from: <?=$userId?>
      		   },
      		   function(data, status){
                  $("#message").val("");
                  $("#chatBox").append(data);
                  scrollDown();
      		   });
      });



      let fechData = function(){
      	$.post("app/get_chat.php", 
      		   {
      		   	id:<?=$userId?>
      		   },
      		   function(data, status){
                  $("#chatBox").append(data);
                  if (data != "") scrollDown();
      		    });
      }

      fechData();

      setInterval(fechData, 500);
    });
</script>