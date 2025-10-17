<?php
session_start(); // optional if you show different UI for logged users
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./dist/style.css" />
    <title>Kho Prado</title>
  </head>

  <body>
    <header>
      <nav class="nav-main">
        <div class="logo-container">
          <img src="assets/kho_prado1.png" alt="Logo" height="80" />
        </div>
        <a href="./html/login.php">
          <button class="bookbtn">Login</button>
        </a>
        <div class="hamburger book" id="hamburger">
          <img
            src="assets/hamburger.svg"
            alt="hamburger"
            onclick="toggleMenu()"
          />
        </div>
      </nav>
    </header>

    <section class="hero-section">
      <div class="hero-text">
        <h1 class="">
          Get Ready For Your Best Ever
          <span class="highlight">Dental Experience!</span>
        </h1>

        <p class="description">
          We use only the best quality materials on the market in order to
          provide the best products to our patients, So don’t worry about
          anything and book yourself.
        </p>
        <div class="book-button">
          <button onclick="location.href='./html/login.php'">Get Started</button>
          <div class="border">
            <div class="sky">
              <img src="assets/Calling.svg" alt="phone-icon" />
            </div>
          </div>
          <div>
            <p>Emergency</p>
            <p>09456363472</p>
          </div>
        </div>
      </div>
      <div class="hero-image">
        <img src="assets/doc.svg" alt="" class="doctor" />
        <img src="assets/Ellipse 1087.svg" alt="" class="circle-1" />
        <img src="assets/Ellipse 1088.svg" alt="" class="circle-2" />
        <img src="assets/Group 1000001037.svg" alt="" class="shape" />
      </div>
    </section>
    <section class="welcome-section">
      <div class="welcome-container">
        <div class="welcome-text">
          <h2>
            We're <span class="highlight">Welcoming</span> New Patients And
            Can't Wait To Meet You.
          </h2>
          <p>
            Stay organized and on schedule with SJN Appointment. Experience the
            convenience of managing your appointments with just a few clicks
          </p>
        </div>
        <div class="welcome-image">
          <img src="assets/patient1.svg" alt="" />
        </div>
      </div>
    </section>
    <footer class="footer-section">
      <div class="footer-container">
        <img src="assets/kho_prado1.png" alt="" height="58" />
        <ul class="footer-menu">
          <li><a href="#home">Home</a></li>
          <li><a href="#service">Service</a></li>
          <li><a href="#blog">Blog</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
      <hr />
      <div class="footer-icon">
        <p>All right reserved 2025 | Terms and Condition apply</p>
        <div class="icons">
          <img src="assets/facebok.svg" alt="" />
          <img src="assets/instagram.svg" alt="" />
          <img src="assets/youtube.svg" alt="" />
          <img src="assets/twitter.svg" alt="" />
        </div>
      </div>
    </footer>
    <script>
      const faqItems = document.querySelectorAll(".faq-item");

      faqItems.forEach((item) => {
        const question = item.querySelector(".faq-question");

        question.addEventListener("click", () => {
          // Close other open items (optional)
          faqItems.forEach((i) => {
            if (i !== item) i.classList.remove("active");
          });

          // Toggle the clicked one
          item.classList.toggle("active");
        });
      });
    </script>
    <!-- <script>
      const container = document.querySelector(".treatment-container");
      const cards = document.querySelectorAll(".treatment-card");

      let index = 0;

      setInterval(() => {
        index = (index + 1) % cards.length; // go to next card, loop back
        container.scrollTo({
          left: cards[index].offsetLeft,
          behavior: "smooth",
        });
      }, 3000); // 2 seconds]
    </script> -->
    <script src="js/hamburger.js"></script>
  </body>
</html>
