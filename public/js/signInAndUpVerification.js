const checkboxSlider = document.querySelector("#checkboxSlider");

checkboxSlider.addEventListener("change", function () {
    window.location.href = checkboxSlider.checked
        ? "index.php?action=signIn"
        : "index.php?action=signUp";
});

if (document.getElementById("signInForm")) {
    checkboxSlider.checked = true;
    const formSignIn = document.getElementById("signInForm");
    const emailSignIn = document.getElementById("emailSignIn");
    const passwordSignIn = document.getElementById("passwordSignIn");

    formSignIn.addEventListener("submit", (e) => {
        e.preventDefault();

        if (
            emailSignIn.value.trim() != "" &&
            passwordSignIn.value.trim() != ""
        ) {
            formSignIn.submit();
        }
    });
} else {
    const formSignUp = document.getElementById("signUpForm");
    const username = document.getElementById("userNameSignUp");
    const email = document.getElementById("emailSignUp");
    const password = document.getElementById("passwordSignUp");
    const password2 = document.getElementById("passwordConfSignUp");

    formSignUp.addEventListener("submit", (e) => {
        e.preventDefault();

        let submittable = checkInputs(username, email, password, password2);
        if (submittable) {
            formSignUp.submit();
        }
    });
}

function checkInputs(username, email, password, password2) {
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    let submittableUser = (submittableEmail = submittablePass = submittablePass2 = false);

    if (usernameValue === "") {
        setErrorFor(username, "Username cannot be blank");
    } else if (usernameValue.length < 6) {
        setErrorFor(username, "Username cannot be shorter than 6 characters");
    } else {
        setSuccessFor(username);
        submittableUser = true;
    }

    if (emailValue === "") {
        setErrorFor(email, "Email cannot be blank");
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, "Not a valid email");
    } else {
        setSuccessFor(email);
        submittableEmail = true;
    }

    if (passwordValue === "") {
        setErrorFor(password, "Password cannot be blank");
    } else {
        setSuccessFor(password);
        submittablePass = true;
    }

    if (password2Value === "") {
        setErrorFor(password2, "Password2 cannot be blank");
    } else if (passwordValue !== password2Value) {
        setErrorFor(password2, "Passwords does not match");
    } else {
        setSuccessFor(password2);
        submittablePass2 = true;
    }

    return submittableUser && submittableEmail && submittablePass && submittablePass2
        ? true
        : false;
}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector("small");
    formControl.className = "formControl error";
    small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = "formControl success";
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
        email,
    );
}
