<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: url('p1.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        header {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            text-align: center;
        }

        h1 {
            color: #fff;
        }

        nav {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        nav a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }

        #slideshow-container {
            max-width: 980px; /* Doubled the size */
            margin: 0.5cm auto 0; /* Adjusted margin to pull it down and added space above */
            overflow: hidden;
            position: relative;
            border-radius: 20px;
        }

        .mySlides {
            display: none;
            text-align: center;
        }

        .mySlides img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Maintain aspect ratio and cover the container */
            border-radius: 20px;
            filter: blur(0.1px);
        }

        /* Slideshow navigation buttons */
        .prev, .next {
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -30px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .prev {
            left: 0;
            border-radius: 3px 0 0 3px;
        }

        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        section {
            margin-bottom: 20px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .login-register {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .login-register button {
            margin-left: 10px;
        }

        h2, p {
            color: #fff;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }

        footer {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body>

    <header>
        <h1>Horizon Adventures</h1>
        <nav>
            <a href="travel.php">Travel</a>
            <a href="offers.php">Offers</a>
            <a href="insurance.php">Insurance</a>
            <a href="contact.php">Contact</a>
            <a href="about.php">About</a>
        </nav>
    </header>

    <div id="slideshow-container">
        <div class="mySlides">
            <img src="slide1.jpg" alt="Slide 1">
        </div>

        <div class="mySlides">
            <img src="slide2.jpg" alt="Slide 2">
        </div>
        <div class="mySlides">
            <img src="slide3.jpg" alt="Slide 2">
        </div>

        <!-- Add more slides as needed... -->
    </div>

    <!-- <section>
        <h2>About Me</h2>
    </section> -->

    <section>
        <h2>Current Date and Time</h2>
        <p><?php echo "Today is " . date("Y-m-d") . " and the time is " . date("H:i:s"); ?></p>
    </section>

    <section class="login-register">
        <button onclick="window.location.href='login.php'">Login</button>
        <a href="register.php"><button>Register</button></a>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Abdelrhman_Ahmed_IFU1</p>
    </footer>

    <script>
        // JavaScript for the slideshow
        var slideIndex = 0;

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 2000); // Change slide every 2 seconds
        }

        showSlides(); // Start the slideshow
    </script>
</body>
</html>
