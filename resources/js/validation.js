document.addEventListener("DOMContentLoaded", function () {
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("password_confirmation");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
});

<script src="validation.js"></script>
// var mpd1 = document.querySelector(".mpd1");
// var mpd2 = document.querySelector(".mpd2");
// mpd2.onkeyup = function () {
//   message_error = document.querySelector(".message_error");
//   if (mpd1.value != mpd2.value) {
//     message_error.innerText = "les mots de passe ne sont pas comformes";
//   } else {
//     message_error.innerText = "";
//   }
// };

function showSuccessAlert(message) {
    var successAlert = document.getElementById("success-alert");
    successAlert.style.display = "block";
    successAlert.innerText = message;
}

function showErrorAlert(message) {
    var errorAlert = document.getElementById("error-alert");
    errorAlert.style.display = "block";
    errorAlert.innerText = message;
}


