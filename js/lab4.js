$(function() {
  /* Clear Messages */
  readRegState();
  SignUpInit();
  ForgotPasswordInit();
  readMessage();
  readUserData();
  if (RegState <= 0) {
    $(".ResetPasswordForm1").hide();
    $(".LoginForm").show();
    if (Message != "") {
      $("#MessageAlert").show();
      $("#MessageAlert").html(Message);
    }
  }
  if (RegState == 2) {
    $(".LoginForm").hide();
    $(".SetPasswordForm").show();
    GetEmailQuery();
  }
  if (RegState == 3) {
    GetAcodeQuery();
    GetEmailQuery();
  }
  if (RegState == 5) {
    $(".SignUpForm").hide();
    $(".LoginForm").hide();
    $(".resetPasswordForm2").hide();
    $(".ResetPasswordForm1").show();
  }
});

// Get Regstate from php session
function readRegState() {
  $.ajax({
    type: "GET",
    crossOrigin: true,
    url:
      "http://cis-linux2.temple.edu/~tug36870/2305/ajaxlab/php/readRegState.php",
    async: false,
    dataType: "json",
    encode: true
  }).always(data => {
    console.log(data);
    RegState = parseInt(data.value);
    return data;
  });
}

// Get Message from php session
function readMessage() {
  $.ajax({
    type: "GET",
    crossOrigin: true,
    url:
      "http://cis-linux2.temple.edu/~tug36870/2305/ajaxlab/php/readMessage.php",
    async: false,
    dataType: "json",
    encode: true
  }).always(data => {
    console.log(data);
    Message = data.value.toString();
    if (Message.length > 1 && RegState < 0) {
      const AlertMarkUp = `
      <div class="alert alert-danger" role="alert">
        ${Message}
      </div>
     `;
      $(".nav-container").prepend(AlertMarkUp);
    }
    if (Message.length > 1 && RegState >= 0) {
      const AlertMarkUp = `
      <div class="alert-success" role="alert">
        ${Message}
      </div>
    `;
      $(".nav-container").prepend(AlertMarkUp);
    }
    return data;
  });
}

/* Get User information from Session */
function readUserData() {
  $.ajax({
    type: "GET",
    crossOrigin: true,
    url:
      "http://cis-linux2.temple.edu/~tug36870/2305/ajaxlab/php/readUserData.php",
    async: false,
    dataType: "json",
    encode: true
  }).always(data => {
    UserName = `${data.firstname.toString()} ${data.lastname.toString()}`;
    if (data.hasOwnProperty("firstname")) {
      const LogOutMarkUp = `
      <li>
        <a href="http://cis-linux2.temple.edu/~tug36870/2305/ajaxlab/php/logout_controller.php">Logout</a>
      </li>
   `;
      const WelcomeMarkUp = `
      <div>
        <h3>Hello ${UserName}</h3>
      </div>
     `;
      $(".nav-container").prepend(WelcomeMarkUp);
      $(".navLogin").html(LogOutMarkUp);
    }
    return data;
  });
}

function SignUpInit() {
  $("#signUpButton").click(() => {
    $("#registrationButton").css("color", "red");
    $(".LoginForm").hide();
    $(".SignUpForm").show();
    LoginButtonInit();
  });
}

function LoginButtonInit() {
  $(".LoginButton").click(function() {
    $(".LoginButton").css("background-color", "green");
    $(".LoginButton").css("border-color", "green");
    $(".SignUpForm").hide();
    $(".ResetPasswordForm1").hide();
    $(".LoginForm").show();
    console.log("hit button");
  });
}

function ForgotPasswordInit() {
  $("#ForgotPasswordButton").click(() => {
    $(".LoginForm").hide();
    $(".ResetPasswordForm1").show();
    LoginButtonInit();
  });
}

function GetEmailQuery() {
  let urlParams = new URLSearchParams(window.location.search);
  const Email = urlParams.get("Email");
  console.log(Email);
  document.getElementById("SetFormEmail").value = Email;
}
function GetAcodeQuery() {
  let urlParams = new URLSearchParams(window.location.search);
  const Acode = urlParams.get("Acode");
  console.log(Acode);
  document.getElementById("ForgotAcode").value = Acode;
}
