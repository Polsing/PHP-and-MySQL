const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

function togglePasswordUP() {
    var checkbox1 = document.getElementById("showPassword1");
    var passwordInputs = document.querySelectorAll('input[id^="password"]');

      passwordInputs.forEach(function (passwordInput) {
        passwordInput.type = checkbox1.checked ? "text" : "password";
      });
  }

function togglePasswordIN(){
    var checkbox2 = document.getElementById("showPassword2");
    var passwordInputIN = document.getElementById("passwordIN");
    passwordInputIN.type = checkbox2.checked ? "text" : "password";
}

function checkPasswordMatch() {
  var password1 = document.getElementById("password1").value;
  var password2 = document.getElementById("password2").value;
  var signUpButton = document.getElementById("signUpButton");

  // ตรวจสอบว่าค่าใน input ทั้งสองตัวเหมือนกันหรือไม่
  if (password1 === password2) {
    signUpButton.disabled = false;
    signUpButton.classList.add("active");
  } else {
    signUpButton.disabled = true;
    signUpButton.classList.remove("active");
  }
}

function checkMatch(){
  var emaiIN = document.getElementById("emaiIN").value;
  var passwordIN = document.getElementById("passwordIN").value;
  var signInButton = document.getElementById("signInButton");
    if(emaiIN != null && passwordIN != null){
      signInButton.disabled = false;
      signInButton.classList.add("active");
    }
    if(emaiIN == null || passwordIN == null){
      signInButton.disabled = true;
      signInButton.classList.remove("active");
    }
}
