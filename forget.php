<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
        body {
    background: url(log.png) no-repeat fixed top/cover;
}

*{
      font-family: arial;
  overflow: hidden;
}
    .card{
      width: 100%;
      max-width: 500px; /* Adjust max-width as needed */
      margin: auto; /* Center the card horizontally */
    }

    select {
        position: absolute;
        margin-top: -27px;
        width: 377px;
        height: 33px;
        margin-left: 85px;
    }

    a {
        text-decoration: none;
        color: white;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card border-black">
          <div class="text-center my-3 fw-bold">
            FORGET PASSWORD  
          </div> 
          <div class="card-body">
          <form action="forgetpass.php" method="POST">
              <div class="mb-3">
                <div class="row mb-3">
                  <div class="col-2">
                    <label for="username" class="form-label fw-bold">Campus</label>
                    <select name="campus" required>
                    <option disabled selected hidden>Select Campus</option>  
                    <option>Sumacab Campus</option>
                    <option>General Tinio Street Campus</option>
                    <option>Atate Campus</option>
                    <option> Fort Magsaysay Campus</option>
                    <option>Gabaldon Campus</option>
                    <option>San Isidro</option>
                </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-2">
                    <label for="email" class="form-label fw-bold">Email</label>
                  </div>
                  <div class="col-10">
                    <input type="email" class="form-control" id="email"  name="email" placeholder="Enter your email" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-2">
                    <label for="letter" class="form-label fw-bold">Letter</label>
                  </div>
                  <div class="col-10">
                    <input type="text" class="form-control"  name="letter" id="letter" placeholder="Enter your letter">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-2">
                    <!-- <label for="letter" class="form-label fw-bold">Letter</label> -->
                  </div>
                  <div class="col-10">
                    <input type="text" class="form-control" id="letter" name="request" placeholder="Enter your reason">
                  </div>
                </div>
              </div>
              <div class="d-grid gap-2">
                <div class="row">
                  <div class="col-9 text-end">
                    <button type="button" class="btn btn-danger fw-bold"><a href="index1">Cancel</a></button>
                  </div>
                  <div class="col-3 text-start">
                    <button type="submit" class="btn btn-warning fw-bold text-light" name="submit">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ZfT+P5K3TaHq6i8TA00jb4XV7DfoCnmphE2vpxxPd4+j7x1B9q9f9dgFDz5tUFb2" crossorigin="anonymous"></script>
</body>
</html>

<!-- <body>
    <main>
    <form action="forgetpass.php" method="POST">
        <div class="bakpri">
        <div id = "loginform" class="nav">
            <div class="border1">
            <div class="border">
            <div class="border2">
            <div class="background">
            <div class="logo">
            <img src="pic/traking.png" alt="">
            </div>
            </div>
            </div>
            </div>
            </div>
            <div class="lok">
            <img src="pic/logodoctrack.png">
            </div>
        <h1>FORGET PASSWORD</h1>
        <hr>
        <h2>Please Enter your Campus, Email and Letter to forget your account password.</h2>
		<div class="log">
        <div class="selected">
        <ul> 
            <div class="campus">
        <label>CAMPUS :</label>
        <li><select name="campus" required>
            <option disabled selected hidden></option>  
            <option>Sumacab Campus</option>
            <option>General Tinio Street Campus</option>
            <option>Atate Campus</option>
            <option> Fort Magsaysay Campus</option>
            <option>Gabaldon Campus</option>
            <option>San Isidro</option>
        </select></li>
        </div>
        <div class="input">
        <label>EMAIL :</label>
        <li><input type="email" name="email" required></li>
        </div>
        </div>
        <div class="letter">
        <label>LETTER :</label>
        <li><select name="letter" id="letter">
            <option disabled selected hidden>Reasons why forgetting password. </option>  
            <option>This is to bring into your kind concern that I am unable to log in to my portal, and it shows an incorrect password.</option>
            <option>This is to bring into your kind concern that I am unable to log in to my portal, and it shows an incorrect password.</option>
            <option>This is to bring into your kind concern that I am unable to log in to my portal, and it shows an incorrect password.</option>
        </select></li>
        </div>
        <div class="option">
        <li><textarea name="request" id="request"></textarea></li>
        </div>
        <div class="submit">
        <li><input type="submit" value="Submit" name='submit'></li>
        </div>
</ul>
		</div>
		</div>
    </form> -->