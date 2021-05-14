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

///////////////////////////////////////////////////////

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

    let files = this.files,
        filesLen = files.length,
        imgType;

    for (let i = 0; i < filesLen; i++) {
        imgType = files[i].name.split(".");
        imgType = imgType[imgType.length - 1].toLowerCase();

        if (allowType.indexOf(imgType) != 1) {
            var reader = new FileReader();

            reader.addEventListener("load", function () {
                // const c = document.querySelector("#avatar");
                const img = document.querySelector("#profile-img");
                img.src = this.result;
            });
            reader.readAsDataURL(myFile.files[0]);
        }
    }
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

const addMySport = () => {
    let mySportsList = document.getElementById("mySportsList");
    let sportsCategories = document.getElementById("sportsCategories");
    let newCategory = sportsCategories.selectedOptions[0];
    let newSport = document.createElement("li");
    let categoryId = newCategory.id;
    let categoryName = newCategory.innerHTML;
    newSport.classList.add('category');
    newSport.appendChild(document.createTextNode('#'+categoryName));
    mySportsList.appendChild(newSport);
    mySportsList.appendChild(document.createElement("br"));
    
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=addMySport');
    let form = new FormData();
    form.append("categoryId",categoryId);
    xhr.send(form);
}
