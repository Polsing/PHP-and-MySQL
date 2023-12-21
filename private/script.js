function togglePassword() {
    var checkbox = document.getElementById("showPassword");
    var passwordInputs = document.querySelectorAll('input[id^="password"]');

      passwordInputs.forEach(function (passwordInput) {
        passwordInput.type = checkbox.checked ? "text" : "password";
      });
  }

function checkPasswordMatch() {
    var password1 = document.getElementById("password1").value;
    var password2 = document.getElementById("password2").value;
    var rsButton = document.getElementById("rsButton");
  
    // ตรวจสอบว่าค่าใน input ทั้งสองตัวเหมือนกันหรือไม่
    if(password1 === password2){ 
        rsButton.disabled = false;
        rsButton.classList.add("active");
    }
    
    if(password1 !== password2){
        rsButton.disabled = true;
        rsButton.classList.remove("active");
    }
  }