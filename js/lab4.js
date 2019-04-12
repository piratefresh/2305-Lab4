$(function() {
  /* Clear Messages */
  readRegState();
  SignUpInit();
  readMessage();
  if (Message.length > 0 && RegState != 0) {
    const AlertMarkUp = `
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <p>${Message}</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    `;
    document.querySelector(".nav-container").prepend(AlertMarkUp);
  }
  if (RegState >= 0) {
    $(".SignUpForm").hide();
    $(".SetPasswordForm").hide();
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
});

// Get Regstate from php session
function readRegState() {
  alert("ReadRegState ajax");
  $.ajax({
    type: "GET",
    url: "php/readRegState.php",
    async: false,
    dataType: "json",
    encode: true
  }).always(data => {
    console.log(data);
    alert("Ajax returned name: [" + data.name + "] value[" + data.value + "]");
    RegState = parseInt(data.value);
    alert("ajax return: RegState={{" + RegState + "}}");
    return data;
  });
}

// Get Message from php session
function readMessage() {
  $.ajax({
    type: "GET",
    url: "php/readMessage.php",
    async: false,
    dataType: "json",
    encode: true
  }).always(data => {
    console.log(data);
    alert("Ajax returned Message: [" + data.value + "]");
    Message = data.value.toString();
    return data;
  });
}

function SignUpInit() {
  alert("ok");
  $("#signUpButton").click(() => {
    $("#registrationButton").css("color", "red");
    $(".LoginForm").hide();
    $(".SignUpForm").show();
    LoginButtonInit();
  });
}

function LoginButtonInit() {
  $("#LoginButton").click(function() {
    $(".SignUpForm").hide();
    $(".LoginForm").show();
  });
}

function GetEmailQuery() {
  let urlParams = new URLSearchParams(window.location.search);
  const Email = urlParams.get("Email");
  console.log(Email);
  document.getElementById("SetFormEmail").value = Email;
}
