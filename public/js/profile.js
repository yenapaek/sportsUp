const listOfMySport = document.querySelectorAll("#mySportsList li");
const editPersonnalInfos = document.querySelector("#editPersonnalInfos");
const profileAvatar = document.querySelector(".profile-img");
const imgFirst = document.querySelector(".profile-img").src;

profileAvatar.addEventListener("mouseover", function () {
    profileAvatar.style.cursor = "pointer";
    profileAvatar.src = "./public/images/profile/edit-round.png";
});

profileAvatar.addEventListener("mouseout", function () {
    profileAvatar.src = imgFirst;
});

const myFile = document.querySelector("#file");
let allowType = ["png", "jpg", "jpeg"];

profileAvatar.addEventListener("click", function () {
    myFile.click();
});

myFile.addEventListener("change", function () {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php?action=editProfileAvatar");

    var form = new FormData();
    form.append("file", myFile.files[0]);
    xhr.send(form);

    xhr.onload = function () {
        if (xhr.status != 200) {
            alert(`Error ${xhr.status}: ${xhr.statusText}`);
        } else {
            location.reload();
        }
    };
});

editPersonnalInfos.addEventListener("click", function () {
    const myInfo = document.querySelector("#myInfos");
    const allSpan = myInfo.querySelectorAll("span");
    if (myInfo.querySelector("input")) {
        const allInput = myInfo.querySelectorAll("input");

        allInput.forEach((element, index) => {
            allSpan[index].textContent = element.value;
            element.remove();

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "index.php?action=editProfileInfo");
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

            input.setAttribute("onClick", "select()");

            index === 2
                ? input.setAttribute("type", "date")
                : input.setAttribute("type", "text");

            index === 3 ? (input.disabled = true) : false;
            input.value = element.textContent;
            element.appendChild(input);
        });

        editPersonnalInfos.classList.replace("far", "fas");
        editPersonnalInfos.classList.replace("fa-edit", "fa-check");
    }
});

const addMySport = () => {
    let mySportsList = document.getElementById("mySportsList");
    let sportsCategories = document.getElementById("sportsCategories");
    let newCategory = sportsCategories.selectedOptions[0];
    let newSport = document.createElement("li");
    let categoryId = newCategory.id;
    let categoryName = newCategory.innerHTML;
    newSport.classList.add("category");
    newSport.appendChild(document.createTextNode("#" + categoryName));
    mySportsList.appendChild(newSport);
    mySportsList.appendChild(document.createElement("br"));

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php?action=addMySport");
    let form = new FormData();
    form.append("categoryId", categoryId);
    xhr.send(form);
};

listOfMySport.forEach((list) => {
    list.addEventListener("click", () => {
        let categoryTrimed = list.textContent.replace(/^\#/gi, "");
        console.log(categoryTrimed);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "index.php?action=searchSubmit");
        let form = new FormData();
        form.append("sportCriteria", categoryTrimed);
        xhr.send(form);

        window.location.href = `index.php?action=events`;
    });
});