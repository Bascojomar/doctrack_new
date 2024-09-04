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
        background-color: black !important;
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
                    <img src="FrontNEUST2.jpg   " class="w-100 d-block" style="width: 100%; height: 100%;" alt="First slide" />
                </div>
                <div class="carousel-item">
                    <img src="centerN.jpg" class="w-100 d-block" style="width: 100%; height: 100%;" alt="Second slide" />
                </div>
                <div class="carousel-item">
                    <img src="roomN.jpg" class="w-100 d-block" style="width: 100%; height: 100%;" alt="Third slide" />
                </div>
            </div>
            <div class="text-center">
            <img class="img-fluid" src="neust.png" alt="">
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
  <!-- About Section -->
  <section id="about" class="section">
    <div class="container">
        <div class="p-5 my-5">
            <div class="container-fluid py-5"></div>
                <div class="row">
                    <div class="col col-8">
                        <h1 class="display-5 fw-bold">About Us</h1>
                        <p class="col-md-8 fs-4">
                            Using a series of utilities, you can create this jumbotron, just
                            like the one in previous versions of Bootstrap. Check out the
                            examples below for how you can remix and restyle it to your liking.
                        </p>
                    </div>
                    <div class="col col-4">
                        <img class="img-fluid" src="neust_logo-1.png" alt="">
                    </div>
                </div>
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
                        Which purpose does neust's document tracking system serve?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        To increase productivity and cut down on time spent, NEUST'S Document Tracking System is utilized to monitor documents. Additionally, this is utilized to simplify and improve a number of facets of document management, assisting firms in enhancing productivity, security, compliance, and teamwork.
                        </div>
                    </div>
                </div>
    
                <!-- Accordion Item #2 -->
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How do i access the document tracking system?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        Only the individual to whom an account has granted access can access the document tracking system by signing into your designated account.
                        </div>
                    </div>
                </div>
    
                <!-- Accordion Item #3 -->
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How can i download files from the system?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        You can download the desired file by visiting the load updates page and selecting the "download" button.
                        </div>
                    </div>
                </div>
    
                <!-- Accordion Item #5 -->
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        What sould i do when i encountered an error while using the system?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        Users can get in touch with help if they run into problems. Contact the system's support if the error persists and you can't come up with a fix. Give them the specifics of the mistake, any pertinent screenshots, and a rundown of your activities at the time it happened.
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
