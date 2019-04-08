$(function() {
  readRegState();
  alert("RegState = " + RegState + " !!!!");
  let Message = readMessage();
  alert("Message = " + Message);
  if (RegState == 0) {
    $("#SetPasswordForm").show();
    $(".LoginForm").hide();
    if (Message != "") {
      $("#MessageAlert").show();
      $("#MessageAlert").html(Message);
    }
  }
});

$(document).ready(function() {
  alert("ok");
  $("#registrationButton").click(() => {
    $("#registrationButton").css("color", "red");
    $(".LoginForm").hide();
  });
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
    alert("Ajax returned Message: [" + data + "]");
    return data;
  });
}
