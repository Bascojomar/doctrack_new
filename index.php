<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    *{
    src: local("Segoe UI Light") !important;
    }

    li a{
    font-family: "Segoe UI" !important;
    font-weight: 500 !important;
    }
    /* Add your custom styles here */
    body {
        padding-top: 56px; /* Adjust according to your navbar height */
    }
    .navbar {
        transition: all 0.3s ease-in-out;
        height: 80px;
        background-color: #0E2A7D !important;
    }
    .navbar.active {
        background-color: #343a40;
    }
    .section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel{
        margin-top: -230px;
    }
    .nav-item.active .nav-link {
        color: #fff !important;
    }
    ::-webkit-scrollbar{
    display: none;
} 
html {
    scroll-behavior: smooth;
    scroll-snap-type: both mandatory;
}

section{
    scroll-snap-align: start;
}

img{
    height: 50px;
}

.learn-more{
    background-color: #0E2A7D !important;
}
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="doc.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item mx-4">
            <a class="nav-link active" href="#home">Home</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item mx-4">
            <a class="nav-link" href="#faq">FAQ</a>
          </li>
          <li class="nav-item ms-4">
            <a class="btn btn-light px-4" href="index1">LOG IN</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Home Section -->
  <section id="home" class="section bg-light">
    <div class="container-fluid">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel" style="width: 100%; height: 200px;">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2" aria-label="Third slide"></li>
            </ol>
            <div class="carousel-inner" role="listbox" style="width: 100%; height: 100%;">
                <div class="carousel-item active">
                    <img src="mainBG.png" class="w-100 d-block" style="width: 100%; height: 100%;" alt="First slide" />
                </div>
                <div class="carousel-item">
                    <img src="mainBG.png" class="w-100 d-block" style="width: 100%; height: 100%;" alt="Second slide" />
                </div>
                <div class="carousel-item">
                    <img src="mainBG.png" class="w-100 d-block" style="width: 100%; height: 100%;" alt="Third slide" />
                </div>
            </div>
            <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> -->
        </div>
    </div>
</section>

  <!-- About Section -->
  <section id="about" class="section">
    <div class="container">
        <div class="p-5 my-5">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">About Us</h1>
                <p class="col-md-8 fs-4">
                    Using a series of utilities, you can create this jumbotron, just
                    like the one in previous versions of Bootstrap. Check out the
                    examples below for how you can remix and restyle it to your liking.
                </p>
                <button class="btn btn-primary btn-lg learn-more" type="button">
                    Learn more
                </button>
            </div>
          </div>
  </section>

  <!-- FAQ Section -->
  <section id="faq" class="section bg-light">
    <div class="container">
        <div class="container-fluid">
            <h1 class="display-5 fw-bold">Frequently Asked Questions</h1>
            <div class="accordion" id="accordionExample">
    
                <!-- Accordion Item #1 -->
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            This is the first item's accordion body.
                        </div>
                    </div>
                </div>
    
                <!-- Accordion Item #2 -->
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            This is the second item's accordion body.
                        </div>
                    </div>
                </div>
    
                <!-- Accordion Item #3 -->
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            This is the third item's accordion body.
                        </div>
                    </div>
                </div>
    
                <!-- Accordion Item #4 -->
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Accordion Item #4
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            This is the fourth item's accordion body.
                        </div>
                    </div>
                </div>
    
                <!-- Accordion Item #5 -->
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Accordion Item #5
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            This is the fifth item's accordion body.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  <!-- Smooth Scroll Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const sections = document.querySelectorAll(".section");
      const navbarLinks = document.querySelectorAll(".navbar-nav .nav-link");
      
      window.addEventListener("scroll", () => {
        let current = "";
        
        sections.forEach(section => {
          const sectionTop = section.offsetTop;
          const sectionHeight = section.clientHeight;
          if (pageYOffset >= sectionTop - sectionHeight / 3) {
            current = section.getAttribute("id");
          }
        });
        
        navbarLinks.forEach(link => {
          link.classList.remove("active");
          if (link.getAttribute("href").substring(1) === current) {
            link.classList.add("active");
          }
        });
        
        if (window.pageYOffset > 0) {
          document.querySelector(".navbar").classList.add("active");
        } else {
          document.querySelector(".navbar").classList.remove("active");
        }
      });
    });
  </script>
</body>
</html>