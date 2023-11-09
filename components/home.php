<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style> 
    .btn {
  background-color: #117964;
  color:white;
  letter-spacing :5%;
}
.btn:hover{
    background-color:green;
    width: 100px;
}
#food{
    background-color:white;
}
    </style>
    <link rel="stylesheet" href="components/css/home.css">
    </head>
<body>
  
    <section class="showcase-area" id="showcase">
        <div class="showcase-container">
            <h1 class="main-title" id="home">Eat Right Food</h1>
            <p>Eat Healty, it is good for our health.</p>
            <a href="menu.php?menu=menu" class="btn btn-primary">Menu</a>
        </div>
    </section>
    <section id="about">
        <div class="about-wrapper container">
            <div class="about-text">
                <p class="small">About Us</p>
                <h2>We've beem making healthy food last for 10 years</h2>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Esse ab
                    eos omnis, nobis dignissimos perferendis et officia architecto,
                    fugiat possimus eaque qui ullam excepturi suscipit aliquid optio,
                    maiores praesentium soluta alias asperiores saepe commodi
                    consequatur? Perferendis est placeat facere aspernatur!
                </p>
            </div>
            <div class="about-img">
                <img src="https://i.postimg.cc/mgpwzmx9/about-photo.jpg" alt="food" />
            </div>
        </div>
    </section>
    <section id="food">
        <h2>Types of food</h2>
        <div class="food-container container">
            <div class="food-type fruite">
                <div class="img-container">
                    <img src="https://i.postimg.cc/yxThVPXk/food1.jpg" alt="error" />
                    <div class="img-content">
                        <h3>fruite</h3>
                        <a href="https://en.wikipedia.org/wiki/Fruit" class="btn btn-primary" target="blank">learn
                            more</a>
                    </div>
                </div>
            </div>
            <div class="food-type vegetable">
                <div class="img-container">
                    <img src="https://i.postimg.cc/Nffm6Rkk/food2.jpg" alt="error" />
                    <div class="img-content">
                        <h3>vegetable</h3>
                        <a href="https://en.wikipedia.org/wiki/Vegetable" class="btn btn-primary" target="blank">learn
                            more</a>
                    </div>
                </div>
            </div>
            <div class="food-type grin">
                <div class="img-container">
                    <img src="https://i.postimg.cc/76ZwsPsd/food3.jpg" alt="error" />
                    <div class="img-content">
                        <h3>grin</h3>
                        <a href="https://en.wikipedia.org/wiki/Grain" class="btn btn-primary" target="blank">learn
                            more</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer">
        <h2>Restraunt &copy; all rights reserved</h2>
    </footer>
    <!-- .................../ JS Code for smooth scrolling /...................... -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="app.js"></script>
</html>
</body>
</html>