<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no"
    />
    <link rel="stylesheet" href="CSS/aboutus.css" />
    <!-- Font awesome icon (links) -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <title>About Us</title>
  </head>
  <body>
    <!--Header-->
    <script>
      const toggle = () => {
        document.getElementById("nav").classList.toggle("navactive");
      };
    </script>

    <header>
      <div class="brand">
        <span class="fa fa-cutlery"></span>
        <h1>Food Pickup Service</h1>
      </div>

      <span class="fa fa-bars" id="menuIcon" onclick="toggle()"></span>

      <div class="navbar" id="nav">
        <ul>
          <li>
            <span class="fa fa-home" id="headIcon"></span>
            <a href="homepage.php"> Home </a>
          </li>
          <li>
            <span class="fa fa-bars" id="headIcon"></span>
            <a href="Menu.php"> Menu </a>
          </li>
          <li>
            <span class="fa fa-crosshairs" id="headIcon"></span>
            <a href="accept.php"> Pickup </a>
          </li>
          <li>
            <span class="fa fa-user-circle" id="headIcon"></span>
            <a href="Account.php"> Profile </a>
          </li>
          <li>
            <span class="fa fa-question-circle" id="headIcon"></span>
            <a href="aboutUs.php"> Help </a>
          </li>
          <li>
            <span class="fa fa-sign-out" id="headIcon"></span>
            <a href="logout.php"> Signout </a>
          </li>
        </ul>
      </div>
    </header>

    <!--About Us-->
    <section class="aboutUs fade-in">
      <div class="aboutUs__container">
        <div class="AboutUs1">
          <h1>ABOUT US</h1>
          <p>
            Sunway College @ Velocity currently does not have our own canteen.
            During the short lunch break, we needed to queue up with others at
            the food court to order food. Usually, the duration to order food
            could take up to 20 to 40 minutes, especially longer during lunch
            time. As a result, some might have either be late for class or skip
            their meal. Our project aims to help our community such as college
            students and lecturers to purchase food during the bustling study or
            working hours. We propose to develop a web application that allows
            the users within the community to manage their food ordering
            conveniently and flexibly. Having this application, the users can
            either save their time queuing up ordering food or rushing to grab
            food themselves during the short recess.
          </p>
        </div>
        <div class="image1"></div>
      </div>
    </section>

    <!--Our services-->
    <section class="our__service fade-in">
      <div class="title">
        <h1>Our Services</h1>
      </div>
      <div class="services">
        <div class="card">
          <div class="icon">
            <i class="fa fa-calendar"></i>
          </div>
          <h2>Term of Use</h2>
          <p>
            Please read these terms of use carefully before using Sunway College
            Food Pickup Service website operated by us.
          </p>
          <a href="#term-of-use" class="button">Read more</a>
        </div>

        <div class="card">
          <div class="icon">
            <i class="fa fa-wrench"></i>
          </div>
          <h2>Privacy Policy</h2>
          <p>
            Before you continue using our website, we advise you to read our
            privacy policy regarding our user data collection. It will help you
            better understand our practices.
          </p>
          <a href="#privacy-policy" class="button">Read more</a>
        </div>

        <div class="card">
          <div class="icon">
            <i class="fa fa-search"></i>
          </div>
          <h2>How do I pay for my food?</h2>
          <p>
            Here have provide to user how to make a payment with the food and
            about the delivery fee.
          </p>
          <a href="#pay-food" class="button">Read more</a>
        </div>
      </div>
    </section>

    <!-- Term of Use section -->
    <section class="term-of-use " id="term-of-use">
      <div class="card1 fade-in">
        <div class="content ">
          <!-- Your Term of Use content goes here... -->
          <h1>Term of Use</h1>
          <h3>Conditions of use:</h3>
          <p>
            This website only provide to the students and lecturers of Sunway
            College. By using this website, you certify that you have read and
            reviewed this Agreement and that you agree to comply with its terms.
            If you do not want to be bound by the terms of this Agreement, you
            are advised to leave the website accordingly. We only grants use and
            access of this website, its products, and its services to those who
            have accepted its terms.
          </p>
          <br />
          <h3>Intellectual property:</h3>
          <p>
            You agree that all contents and services provided on this website
            are the property of Sunway College, its affiliates, directors,
            officers, employees, agents, suppliers, or licensors including all
            copyrights, trade secrets, trademarks, patents, and other
            intellectual property. You also agree that you will not reproduce or
            redistribute the Sunway College’s intellectual property in any way,
            including electronic, digital, or new trademark registrations.
            <br />
            You grant Sunway College a royalty-free and non-exclusive license to
            display, use, copy, transmit, and broadcast the content you upload
            and publish. For issues regarding intellectual property claims, you
            should contact the company in order to come to an agreement.
          </p>
          <br />
          <h3>User accounts:</h3>
          <p>
            As a user of this website, you may be asked to register with us and
            provide private information. You are responsible for ensuring the
            accuracy of this information, and you are responsible for
            maintaining the safety and security of your identifying information.
            You are also responsible for all activities that occur under your
            account or password. If you think there are any possible issues
            regarding the security of your account on the website, inform us
            immediately so we may address it accordingly. We reserve all rights
            to terminate accounts, edit or remove content and cancel orders in
            their sole discretion.
          </p>
          <br />
          <h3>Indemnification:</h3>
          <p>
            You agree to indemnify Sunway College and its affiliates and hold
            Sunway College harmless against legal claims and demands that may
            arise from your use or misuse of our services. We reserve the right
            to select our own legal counsel.
          </p>
          <br />
          <h3>Changes to Terms:</h3>
          <p>
            We may update or modify these Terms of Service at any time. It is
            your responsibility to review these terms periodically for any
            changes.
          </p>
        </div>
      </div>
    </section>

    <section class="card2-container" id="privacy-policy">
      <div class="card2 fade-in">
        <div class="privacy-policy-img">
          <script src="https://cdn.lordicon.com/lordicon.js"></script>
          <lord-icon
            src="https://cdn.lordicon.com/vistbkts.json"
            trigger="hover"
            style="width: 250px; height: 250px"
          >
          </lord-icon>
        </div>
        <div class="content">
          <h1>Privacy Policy</h1>
          <br />
          <h3>
            This privacy notice for Sunway College Pickup Service, describes how
            and why we might collect, store, use, and/or process your
            information when you use our services, such as when you:
          </h3>
          <br />
          <h3>
            Visit our website at [Website URL], or any website of ours that
            links to this privacy notice. By reading this privacy notice, it
            will help you to understand your privacy rights and choices. If you
            do not agree with our policies and practices, please do not use our
            services. If you still have any questions or concerns, please
            contact us at [Email Address].
          </h3>
          <br /><br />
          <p>
            1. Information Collection: We may collect personal information when
            you interact with our website, order a service, sign up for
            newsletters, or participate in surveys or events.
          </p>
          <p>
            2. Use of Information: We use your information to process services,
            communicate with you, and improve our services. We do not sell or
            share your information with third parties for marketing purposes.
          </p>
          <p>
            3. Security: We implement security measures to protect your personal
            information from unauthorized access or disclosure.
          </p>
          <p>
            4. Cookies: We use cookies to enhance your browsing experience. By
            using our website, you consent to our use of cookies as described in
            our Cookie Policy.
          </p>
          <p>
            5. Links to Third-Party Sites: Our website may contain links to
            external sites. We are not responsible for the privacy practices or
            content of these third-party sites.
          </p>
        </div>
      </div>
    </section>

    <section class="card3-container" id="pay-food">
      <div class="card3  fade-in">
        <div class="content">
          <h1>How do I pay for my food?</h1>
          <br />
          <h3>Step 1:</h3>
          <br />
          <p>
            Firstly, the user has to use their ID to log in on the login page.
          </p>
          <br />
          <h3>Step 2:</h3>
          <br />
          <p>
            After logging in the user can start choosing their restaurant and
            food.
          </p>
          <br />
          <h3>Step 3:</h3>
          <br />
          <p>
            When the user has confirmed their restaurant and food it will go to
            the confirm order page to let the user confirm their restaurant and
            food because once the user has confirmed their order, the order will
            not be changed by the user.
          </p>
          <br />
          <h3>Step 4:</h3>
          <br />
          <p>
            When the user has confirmed their restaurant and food it will go to
            the confirm order page to let the user confirm their restaurant and
            food because once the user has confirmed their order, the order will
            not be changed by the user.
          </p>
          <br />
          <h3>Step 5:</h3>
          <br />
          <p>
            Users will be provided with their invoices and the location of the
            payment.
          </p>
          <br />
        </div>
      </div>
    </section>

    <!-- JavaScript -->
    <script src="JS/aboutUs.js"></script>
    <!-- Footer -->
    <dl class="footer-container">
      <section class="footer">
        <h4>Sunway College Food Pickup Service</h4>
        <p>
        Welcome to Sunway Pickup Service! For further information can check on below!
        </p>
        <div class="footer-ul">
          <ul>
            <li><a href="#">About Us</a></li>
            <li><a href="#term-of-use">Term of Use</a></li>
            <li><a href="#privacy-policy">Privacy Policy</a></li>
            <li><a href="#pay-food">How do I pay for my food?</a></li>
          </ul>
        </div>
        <br />
        <div class="icons">
          <a href="https://www.facebook.com/" target="blank"
            ><i class="fa fa-facebook"></i
          ></a>
          <a href="https://www.twitter.com/" target="blank"
            ><i class="fa fa-twitter"></i
          ></a>
          <a href="https://www.instagram.com/" target="blank"
            ><i class="fa fa-instagram"></i
          ></a>
        </div>
        <p>Restaurant Location</p>
        <hr />
        <p>
          Sunway Velocity Level 3. Lot B31-34 <br />Sunway Pyramid Level 5, Lot
          B 101-106
        </p>
        <p>Made with <i class="fa fa-heart-o"></i> by Ernest Group</p>
      </section>
    </dl>
  </body>
</html>
