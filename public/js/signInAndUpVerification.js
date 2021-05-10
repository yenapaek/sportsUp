const formSignIn = document.getElementById("signInForm");
const emailSignIn = document.getElementById("emailSignIn");
const passwordSignIn = document.getElementById("passwordSignIn");

const form = document.getElementById("signUpForm");
const username = document.getElementById("userNameSignUp");
const email = document.getElementById("emailSignUp");
const password = document.getElementById("passwordSignUp");
const password2 = document.getElementById("passwordConfSignUp");

form.addEventListener("submit", (e) => {
    e.preventDefault();

    let submittable = checkInputs();
    if (submittable) {
        form.submit();
    }
});

formSignIn.addEventListener("submit", (e) => {
    e.preventDefault();

    if (emailSignIn.value.trim() != "" && passwordSignIn.value.trim() != "") {
        formSignIn.submit();
    }
});

function checkInputs() {
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    let submittableUser = (submittableEmail = submittablePass = false);

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
        submittablePass = true;
    }

    return submittableUser && submittableEmail && submittablePass
        ? true
        : false;
}

function setErrorFor(input, message) {
    const formControl = input.parentElement;
    const small = formControl.querySelector("small");
    formControl.className = "form-control error";
    small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    formControl.className = "form-control success";
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
        email,
    );
}
