const editPersonnalInfos = document.querySelector("#editPersonnalInfos");

editPersonnalInfos.addEventListener("click", function () {
    // window.location.href = "index.php?action=editPersonnalInfos";
    const myInfo = document.querySelector("#myInfos");
    const allSpan = myInfo.querySelectorAll("span");
    if (myInfo.querySelector("input")) {
        const allInput = myInfo.querySelectorAll("input");

        allInput.forEach((element, index) => {
            allSpan[index].textContent = element.value;
            element.remove();

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "index.php?action=editPersonnalInfos");
            var form = new FormData();
            form.append("first", allSpan[0].textContent);
            form.append("last", allSpan[1].textContent);
            form.append("date", allSpan[2].textContent);
            form.append("email", allSpan[3].textContent);
            form.append("city", allSpan[4].textContent);

            xhr.send(form);
        });

        editPersonnalInfos.classList.replace("fas", "far");
        editPersonnalInfos.classList.replace("fa-check", "fa-edit");
    } else {
        allSpan.forEach((element, index) => {
            let input = document.createElement("input");
            index === 2
                ? input.setAttribute("type", "date")
                : input.setAttribute("type", "text");

            input.value = element.textContent;
            element.appendChild(input);
        });

        editPersonnalInfos.classList.replace("far", "fas");
        editPersonnalInfos.classList.replace("fa-edit", "fa-check");
    }
});
