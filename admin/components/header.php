<nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid"><a class="navbar-brand name" href="#">Yumy<span class="go">Admin</span></a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item"> <a class="nav-link active" aria-current="page" href="index2.php"><span class="home">dashboard</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" href="#">products</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="#">orders</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="#">chat</a> </li>
                        </ul>
                        <div class="button" onclick="signup()">Sign up </div>
                    </div>
                </div>
</nav>
<script>
    function signup(){
        window.location.href= "noConnnection.php";
    }
</script>
<style>
    .button {
  display: inline-block;
  padding: 15px 40px;
  font-size: 18px;
  font-weight: bold;
  color: #ffffff;
  background: linear-gradient(to bottom, #007bff, #0056b3);
  border: none;
  border-radius: 30px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
}

.button:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.button:active {
  transform: scale(0.95);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}
body{
         background:#e2eaef;
      }
</style>