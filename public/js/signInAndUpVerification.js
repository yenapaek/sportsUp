const inputVerification = (inputId) => {
    let input = document.querySelector(`#${inputId}`);

    if (
        trim(input.value).length < 6 ||
        trim(input.value).length == 0
    ) {
        input.style.backgroundColor = "red";
    } else {
        input.style.backgroundColor = "white";
    }

    if (inputId == "passwordSignUp" || inputId == "passwordConfSignUp") {
        let password = document.querySelector("#passwordSignUp");
        let passwordConf = document.querySelector("#passwordConfSignUp");

        if (password.value != passwordConf.value) {
            password.style.backgroundColor = "red";
            passwordConf.style.backgroundColor = "red";
        } else {
            password.style.backgroundColor = "white";
            passwordConf.style.backgroundColor = "white";
        }
    }

    
};
