<?php
$db_name = 'coffee_db';
$username = 'root';
$password = 'root';
$host = 'localhost';
$port = '3308';
$dsn = "mysql:host=$host;port=$port;dbname=$db_name";


session_start();

// Use $_SESSION['user_id'] for queries!
$current_page = basename($_SERVER['PHP_SELF']); 

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_POST['send'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $guests = filter_var($_POST['guests'], FILTER_SANITIZE_NUMBER_INT);

    $select_contact = $conn->prepare("SELECT * FROM `coffee_form` WHERE name = ? AND number = ? AND guests = ?");
    $select_contact->execute([$name, $number, $guests]);

    if ($select_contact->rowCount() > 0) {
        $message[] = 'message sent already!';
    } else {
        $insert_contact = $conn->prepare("INSERT INTO `coffee_form`(name, number, guests) VALUES(?,?,?)");
        $insert_contact->execute([$name, $number, $guests]);
        $message[] = 'message sent successfully!';
    }
}

if (isset($_POST['register'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $check_user = $conn->prepare("SELECT * FROM re_users WHERE username = ? OR email = ?");
    $check_user->execute([$username, $email]);
    if ($check_user->rowCount() > 0) {
        echo "<script>alert('Username or Email already exists!');</script>";
    } else {
        $insert_user = $conn->prepare("INSERT INTO re_users (username, email, password) VALUES (?, ?, ?)");
        $insert_user->execute([$username, $email, $password]);
        echo "<script>alert('Registration Successful! You can now login.'); window.location.href='#login';</script>";
    }
}

if (isset($_POST['login'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $check_user = $conn->prepare("SELECT * FROM re_users WHERE username = ? AND password = ?");
    $check_user->execute([$username, $password]);

    if ($check_user->rowCount() > 0) {
        $user = $check_user->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $user['id'];          // <<-- Set user_id in session!
        $_SESSION['username'] = $user['username'];   // (optional) Set username in session

        echo "<script>alert('Login Successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Invalid Username or Password');</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Complete Responsive Coffee Shop Website Design</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   <?php
    if(isset($message)){
        foreach($message as $message){
            echo '
            <div class="message" style="
               position: sticky;
               top: 0;
               z-index: 1100;
               background: var(--main-color);
               padding: 2rem;
               display: flex;
               align-items: center;
               justify-content: space-between;
               gap: 1.5rem;
               max-width: 1200px;
               margin: 0 auto;">
               <span style="color: var(--white);
               font-size: 2rem;">'.$message.'</span>

               <i class="fas fa-times" style="font-size: 2.5rem;
               color: var(--white);
               cursor: pointer;" onclick="this.parentElement.remove();"></i>
            </div>
            ';
        }
     }
   ?>

<!-- header section starts  -->

<header class="header">

   <section class="flex">

      <a href="#home" class="logo"><img src="images/logo.png" alt=""></a>

      <nav class="navbar">
         <a href="#home"><b>home</b></a>
         <a href="#about"><b>about</b></a>
         <a href="#menu"><b>menu</b></a>
         <a href="#gallery"><b>gallery</b></a>
         <a href="#team"><b>team</b></a>
         <a href="#contact"><b>contact</b></a>
         <a href="order.html"><b>order</b></a>
         <a href="#login"><b>login</b></a>
          <a href="feedback.html"><b>Feedback</b></a>

      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>

   </section>

</header>


<!-- header section ends -->

<!-- home section starts  -->

<div class="home-bg">

   <section class="home" id="home">

      <div class="content">
         <h3>coffee heaven</h3>
         <p>At Coffee Heaven, you're not just a customer. You're family.  
            Come. Sip. Smile. Let your coffee story begin…</p>
      </div>
   </section>

</div>

<!-- home section ends -->
<!-- registration section starts  -->

<section class="register" id="register">

   <div class="heading">
      <h3>Register Now</h3>
   </div>

   <div class="row">
      <form action="" method="post" style="margin: 0 auto; max-width: 400px; width: 100%; text-align: center;">
         <h3 style="font-size: 28px; margin-bottom: 20px;">Create your account</h3>
         <input type="text" name="username" required class="box" placeholder="Enter your username" style="margin-bottom: 15px; padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
         <input type="email" name="email" required class="box" placeholder="Enter your email" style="margin-bottom: 15px; padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
         <input type="password" name="password" required class="box" placeholder="Enter your password" style="margin-bottom: 15px; padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
         <input type="submit" name="register" value="Register Now" class="btn" style="padding: 10px 25px; font-weight: bold; background-color: #7a4f28; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
         <p style="margin-top: 15px;">Already have an account? <a href="#login">Login here</a></p>
      </form>
   </div>
</section>

<!-- login section starts -->

<section class="login" id="login">

   <div class="heading">
      <h3>login now</h3>
   </div>

   <div class="row">

      <form action="" method="post" style="margin: 0 auto; max-width: 400px; width: 100%; text-align: center;">
         <h3 style="font-size: 28px; margin-bottom: 20px;">welcome back!</h3>
         
         <input type="text" name="username" required class="box" placeholder="enter your username" style="margin-bottom: 15px; padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
         
         <input type="password" name="password" required class="box" placeholder="enter your password" style="margin-bottom: 15px; padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px;">
         
         <input type="submit" name="login" value="login now" class="btn" style="padding: 10px 25px; font-weight: bold; background-color: #7a4f28; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
         
         <p style="margin-top: 15px;">don't have an account? <a href="#register">register now</a></p>
      </form>

   </div>

</section>


<!-- login section ends -->


<!-- about section starts  -->

<section class="about" id="about">

   <div class="image">
      <img src="images/about-img.svg" alt="">
   </div>

   <div class="content">
      <h3>A cup of coffee can complete your day</h3>
      <p>We handpick the finest coffee beans, roast them with care, and pour every cup with passion.  
  Whether you’re here for a quick espresso, a creamy latte, or a calm place to unwind — we’re here to serve with warmth and love.
</p>
<a href="#menu" class="btn" style="background: #6f4e37; color: #fff; padding: 10px 20px; border-radius: 5px; display: inline-block; text-decoration: none;">
  our menu
</a>
   </div>

</section>

<!-- about section ends -->

<!-- facility section starts  -->

<section class="facility">

   <div class="heading">
      <h3>our facility</h3>
   </div>

   <div class="box-container">

      <div class="box">
         <img src="images/icon-1.png" alt="">
         <h3>varieties of coffees</h3>
         <p>Strong, bold and pure – perfect shot to boost your day!</p>
      </div>

      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>coffee beans</h3>
         <p>From farm to roast — our beans are pure, fresh, and full of soul!</p>
      </div>

      <div class="box">
         <img src="images/icon-3.png" alt="">
         <h3>breakfast and sweets</h3>
         <p>Start your day fresh with warm, wholesome bites made to energize!</p>
      </div>

      <div class="box">
         <img src="images/icon-4.png" alt="">
         <h3>read to go coffee</h3>
         <p>Brewed fresh, packed fast — your perfect coffee, ready when you are.!</p>
      </div>

   </div>

</section>

<!-- facility section ends -->


<!-- menu section starts  -->

<section class="menu" id="menu">

   <div class="heading">
      <h3>popular menu</h3>
   </div>

   <div class="box-container">

      <div class="box">
         <img src="images/menu-1.png" alt="">
         <h3>love you coffee</h3>
      </div>

      <div class="box">
         <img src="images/menu-2.png" alt="">
         <h3>Cappuccino</h3>
      </div>

      <div class="box">
         <img src="images/menu-3.png" alt="">
         <h3>Mocha coffee</h3>
      </div>

      <div class="box">
         <img src="images/menu-4.png" alt="">
         <h3>Frappuccino</h3>
      </div>

      <div class="box">
         <img src="images/menu-5.png" alt="">
         <h3>black coffee</h3>
      </div>

      <div class="box">
         <img src="images/menu-6.png" alt="">
         <h3>love heart coffee</h3>
      </div>

   </div>

</section>

<!-- menu section ends -->

<!-- gallery section starts  -->

<section class="gallery" id="gallery">

   <div class="heading">
      <h3>our gallery</h3>
   </div>

   <div class="box-container">
      <img src="images/gallery-1.webp" alt="">
      <img src="images/gallery-2.webp" alt="">
      <img src="images/gallery-3.webp" alt="">
      <img src="images/gallery-4.webp" alt="">
      <img src="images/gallery-5.webp" alt="">
      <img src="images/gallery-6.webp" alt="">
   </div>

</section>


<!-- gallery section ends -->

<!-- team section starts  -->

<section class="team" id="team">

   <div class="heading">
      <h3>our team</h3>
   </div>

   <div class="box-container">

   <div class="box">
         <img src="images/our-team-1.jpg" alt="">
         <h3>Rohan</h3>
      </div>
      <div class="box">
         <img src="images/our-team-2.jpg" alt="">
         <h3>Nikhil</h3>
      </div>
      <div class="box">
         <img src="images/our-team-3.jpg" alt="">
         <h3>Mahek</h3>
      </div>
      <div class="box">
         <img src="images/our-team-4.jpg" alt="">
         <h3>Saurabh</h3>
      </div>
      <div class="box">
         <img src="images/our-team-5.jpg" alt="">
         <h3>Neha</h3>
      </div>
      <div class="box">
         <img src="images/our-team-6.jpg" alt="">
         <h3>Yash</h3>
      </div>
   </div>

</section>
<br><br><br>
<!-- team section ends -->

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    video {
      width: 100%;
      height: 500px;
      object-fit: cover;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 50%;
    }
  </style>
</head>
<body>

  <!-- Heading Section -->
  <div class="heading">
    <h3>Coffee Heaven Official</h3>
  </div>

  <!-- Bootstrap Carousel with Videos -->
  <div id="videoCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <div class="carousel-item active">
        <video autoplay loop muted playsinline>
          <source src="images/1117250_Woman_Caucasian_3840x2160.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>

      <div class="carousel-item">
        <video autoplay loop muted playsinline>
          <source src="images/1474209_People_Technology_3840x2160.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>

      <div class="carousel-item">
        <video autoplay loop muted playsinline>
          <source src="images/1475494_People_Leisure_3840x2160.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>

      <div class="carousel-item">
        <video autoplay loop muted playsinline>
          <source src="images/1474249_People_Technology_3840x2160.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>

      <div class="carousel-item">
        <video autoplay loop muted playsinline>
          <source src="images/1474259_People_Technology_3840x2160.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>

    </div>

    <!-- Carousel Navigation -->
    <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<br><br><br><br>
  <style>
  body {
    margin: 0;
    padding: 20px;
    background-color: #fffefb;
  }

  .tea-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 5 columns */
    gap: 0px; /* ✅ No space between images */
    justify-content: center;
  }

  .tea-img {
    width: 100%;
    aspect-ratio: 1 / 1; /* square box */
    overflow: hidden;
  }

  .tea-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  @media (max-width: 768px) {
    .tea-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  @media (max-width: 500px) {
    .tea-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
</style>

</head>
<body>
<div class="heading">
      <h3>MOMENTS @ COFFEE HEAVEN</h3>
   </div>

  <div class="container">
    <div class="tea-grid">

 
 <!-- 10 compact images -->
      <div class="tea-img"><img src="coffee 2.avif" alt="quote1"></div>
      <div class="tea-img"><img src="image 2.jpg" alt="girl with tea"></div>
      <div class="tea-img"><img src="coffee 6.jpg" alt="quote2"></div>
      <div class="tea-img"><img src="image 3.jpg" alt="sandwich"></div>
      <div class="tea-img"><img src="coffee 7.jpg" alt="quote3"></div>
      <div class="tea-img"><img src="image 5.jpg" alt="couple with tea"></div>
      <div class="tea-img"><img src="coffee 8.jpg" alt="chai pe milenge"></div>
      <div class="tea-img"><img src="image 4.jpg" alt="eating food"></div>
      <div class="tea-img"><img src="image 1.jpg" alt="cup of tea life quote"></div>
      <div class="tea-img"><img src="food lover.jpg" alt="snack roll"></div>

   
</div>
  </div>

  <br><br><br><br>

   <style>
   .review-box {
      border: 2px solid #0000001a;
      border-radius: 15px;
      padding: 30px;
      background: #fff;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .review-stars {
      color: gold;
      font-size: 1.5rem;
    }

    .review-box p {
      margin: 15px 0;
    }

    .customer-footer {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-top: 30px;
      padding: 15px;
      transition: 0.3s ease;
      width: calc(100% + 60px);
      margin-left: -30px;
      margin-bottom: -30px;
      border-radius: 0px !important;
    }

    .review-box:hover .customer-footer {
      background-color: #be9c79;
    }

    .customer-footer img {
      width: 55px;
      height: 55px;
      object-fit: cover;
      border-radius: 50%;
      display: block;
      overflow: hidden;
    }

    .customer-footer .name {
      font-weight: 600;
      font-size: 1.1rem;
      margin: 0;
      color: #000;
    }

    .customer-footer .role {
      font-size: 0.9rem;
      color: #333;
      margin: 0;
    }

    .review-title {
      font-weight: 500;
      color: #9c7e5c;
      margin-top: 5px;
    }

    h2.section-title {
      text-align: center;
      font-weight: 700;
      margin: 40px 0;
      font-size: 2.5rem;
      font-family: Georgia, serif;
    }
  </style>

  <div class="heading">
      <h3>Customer's Review</h3>
   </div>


    <div class="row g-4">
      <!-- Review 1 -->
      <div class="col-md-4">
        <div class="review-box h-100">
          <div>
            <div class="review-stars">★★★★★</div>
            <div class="review-title">From Coffee Heaven</div>
            <h4><p>"The Cappuccino At Coffee Heaven Is A Dream! The Aroma, The Froth, The Flavor Everything Was On Point. Definitely My New Go-To Spot For Morning Coffee!"</p></h4>
          </div>
          <div class="customer-footer">
            <img src="m2.jpg" alt="Harshil">
            <div>
               <h5><p class="name"><b>Harshil</b></p></h5>
               <h5><p class="name"><b></b></p></h5>
              <p class="role">Happy Customer</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Review 2 -->
      <div class="col-md-4">
        <div class="review-box h-100">
          <div>
            <div class="review-stars">★★★★★</div>
            <div class="review-title">From Coffee Heaven</div>
           <h4> <p>"I Tried Their Hazelnut Latte And I Was Blown Away. So Smooth And Delicious! The Cozy Ambience Just Makes The Whole Experience Even Better!"</p></h4>
          </div>
          <div class="customer-footer">
            <img src="pic3.avif" alt="Shreya">
            <div>
               <h5><p class="name"><b>Shreya</b></p></h5>
              <p class="role">Happy Customer</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Review 3 -->
      <div class="col-md-4">
        <div class="review-box h-100">
          <div>
            <h3><div class="review-stars">★★★★★</div></h3>
            <div class="review-title">From Coffee Heaven</div>
           <h4><p>"Absolutely Loved The Iced Caramel Macchiato! It Was Refreshing, Beautifully Balanced, And Served With A Smile. Thank You Coffee Heaven!"</p></h4>
          </div>
          <div class="customer-footer">
            <img src="m3.jpg" alt="Shivam">
            <div>
              <h5><p class="name"><b>Shivam</b></p></h5>
              <p class="role">Happy Customer</p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

<!-- contact section starts  -->

<section class="contact" id="contact">

   <div class="heading">
      <h3>contact us</h3>
   </div>

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="POST">
         <h3>book a table</h3>
         <input type="text" name="name" method="POST" required class="box" maxlength="20" placeholder="enter your name">
         <input type="number" name="number" method="POST" required class="box" maxlength="20" placeholder="enter your number" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false">
         <input type="number" name="guests" method="POST" required class="box" maxlength="20" placeholder="how many guests" min="0" max="99" onkeypress="if(this.value.length == 2) return false">
         <input type="submit" name="send" value="send message" class="btn">
      </form>

   </div>

</section>

<!-- contact section ends -->

<!-- footer section starts  -->

<section class="footer">

   <div class="box-container">

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>our email</h3>
         <p>Maitrifulpawar19@gmil.com</p>
         <p>bitsj2024072722@bitbaroda.com</p>
      </div>

      <div class="box">
         <i class="fas fa-clock"></i>
         <h3>opening hours</h3>
         <p>07:00am to 09:00pm</p>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>shop location</h3>
         <p>Vadodara, india - 400104</p>
      </div>

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>our number</h3>
         <p>+123-456-7890</p>
         <p>+111-222-3333</p>
      </div>

   </div>

   <div class="credit"> &copy; copyright @ 2025 by <span>Maitri</span> | all rights reserved! </div>

</section>

<!-- footer section ends -->


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>