<header>
  <div class="nav-container">
    <ul class="nav-menu">
      <a href="">
        <h1>Charlie Puth</h1>
      </a>
      <li><a href="">Music</a></li>
      <li><a href="">Tour</a></li>
      <li><a href="">News</a></li>
      <li>
        <a href="" data-toggle="modal" data-target="#exampleModal">Login</a>
      </li>
    </ul>
  </div>
  <div class="nav-content">
    <div class="side-container"></div>
    <div class="video-container">
      <video class="video" autoplay="autoplay" muted="true" loop="loop">
        <source src="./assets/doneforme.mp4" type="video/mp4" />
      </video>
    </div>
  </div>
</header>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="alert alert-warning" role="alert"></div>
      <!-- Login Form -->
      <div class="LoginForm">
        <form action="php/login_controller.php" method="post" enctype="multipart/form-data">
          <p>Please Login to your account</p>
          <div class="form-group">
            <label for="email">Email address</label>
            <input name="Email" type="email" class="form-control" id="Email" aria-describedby="emailHelp" placeholder="Joedoe@email.com" required />
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input name="Password1" type="password" class="form-control" id="Password1" placeholder="Password" value="" required />
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberPassword" value="value1" />
            <label class="form-check-label" for="exampleCheck1">Remember Password</label>
            <a href="php/change_session_controller.php">Forgot password?</a>
          </div>
          <div class="g-recaptcha" data-sitekey="6Ld8IZQUAAAAALV45v301da9VhtkkCb6OuXU3rjL"></div>
          <div class="button-container">
            <button type="submit" class="btn btn-primary CTAButton">Login</button>
            <div id='signUpButton' class="btn btn-primary CTAButton">Sign Up</div>
          </div>
        </form>
      </div>

      <!-- Set Password -->

    </div>
  </div>
</div>