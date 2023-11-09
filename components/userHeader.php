<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><b>YUMY</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="menu.php?menu=menu">menu</a>
      </li>
      <?php if (isset($_GET['menu'])){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">category</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#main dish">main dish</a>
          <a class="dropdown-item" href="#fast food">fast food</a>
          <a class="dropdown-item" href="#drinks">drinks</a>
          <a class="dropdown-item" href="#desserts">desserts</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#others">others</a>
        </div>
      </li>
      <?php } ?>
      
      <li class="nav-item">
        <a class="nav-link disabled" href="#"></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="costumer/login.php">orders</a>
          <a class="dropdown-item" href="costumer/login.php">reservation</a>
          <a class="dropdown-item" href="costumer/login.php">Yumy live chat</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <!-- chat icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="chat" height="2em" viewBox="0 0 512 512" onclick="chat()"><path d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z"/></svg>
      <!-- basket icon -->
      <svg xmlns="http://www.w3.org/2000/svg"  height="2em"  class="basket" viewBox="0 0 576 512"  onclick="addToCart()"><path d="M253.3 35.1c6.1-11.8 1.5-26.3-10.2-32.4s-26.3-1.5-32.4 10.2L117.6 192H32c-17.7 0-32 14.3-32 32s14.3 32 32 32L83.9 463.5C91 492 116.6 512 146 512H430c29.4 0 55-20 62.1-48.5L544 256c17.7 0 32-14.3 32-32s-14.3-32-32-32H458.4L365.3 12.9C359.2 1.2 344.7-3.4 332.9 2.7s-16.3 20.6-10.2 32.4L404.3 192H171.7L253.3 35.1zM192 304v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16zm96-16c8.8 0 16 7.2 16 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16zm128 16v96c0 8.8-7.2 16-16 16s-16-7.2-16-16V304c0-8.8 7.2-16 16-16s16 7.2 16 16z"/></svg>
      <!-- heart icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="heart" onclick="heart()" height="2em" viewBox="0 0 512 512"  onclick="heart()"><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg>
      <!-- profile icon -->
      <svg xmlns="http://www.w3.org/2000/svg" height="2em" class="profile" viewBox="0 0 448 512"  onclick="profile()"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>   
      <!-- search icon -->
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class="hidden" id="myDiv">
  <a class="button-link" href="#">settings</a>
  <a class="button-link-logout" href="#">LOGOUT</a>
</div>
<script>
 $(document).ready(function() {
  var index = 0;
    $('#svgElement').click(function() {
      $('#myDiv').removeClass('hidden');
      $('#myDiv').addClass('toggle');
    });

    $(document).click(function(event) {
      var targetElement = event.target;
      if (!$(targetElement).is('#svgElement') && !$.contains($('#myDiv')[0], targetElement) ) {
        $('#myDiv').removeClass('toggle').addClass('hidden');
        
      }
    });
  });
</script>
<style>
  .profile{
    margin-right:15px;
    cursor:pointer;
  }
  .profile:hover{
    fill:brown;
  }
  .chat{
    margin-right:15px;
    cursor:pointer;
  }
  .chat:hover{
    margin-right:15px;
    fill:green;
  }
  .navbar{
    position:relative;
  }
  
      .button-link {
      width:100%;
      display: inline-block;
      padding: 10px 20px;
      margin-bottom:2px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      border: none;
      font-size: 16px;
      cursor: pointer;
    }
    .button-link-logout {
      width:100%;
      display: inline-block;
      padding: 10px 20px;
      margin-bottom:1px;
      background-color: #ed1c24;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      border: none;
      font-size: 16px;
      cursor: pointer;
    }
  .hidden{
    display:none;
  }
  .toggle{
    display:block;
    position:absolute;
    margin-left:72%   ;
    width:110px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }
  body{
    position: relative;
  }
  .image{
    cursor:pointer;
    margin-right:1em;
  }
  .heart{
    cursor:pointer;
    margin-right:1em;
    fill:black;
  }
  .heart:hover{
    cursor:pointer;
    margin-right:1em;
    fill:red;
  }
  .basket{
    cursor:pointer;
    margin-right:1em;
    fill:black;
  }
  .basket:hover{
    cursor:pointer;
    margin-right:1em;
    fill:#00bfff ;
  }
  a:hover{
    color:white;
    letter-spacing:5px;;
    padding:5px;
    text-decoration:none;
  }
  .btn {
  background-color: #117964;
  color:white;
  letter-spacing :5%;
}
.btn:hover{
    background-color:green;
    width: 100px;
}
</style>
<script>
  function heart()
  {
    window.location.href = "costumer/login.php";
  }
  function reservation()
  {
    window.location.href = "costumer/login.php";
  }
  function chat()
  {
    window.location.href = "costumer/login.php";
  }
  function profile()
  {
    window.location.href = "costumer/login.php";
  }
  function addToCart()
  {
    window.location.href = "costumer/login.php";
  }
</script>