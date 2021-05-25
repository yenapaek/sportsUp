let formCriteria = document.getElementById("formCriteria");

// by sport or event
let selectCriteria = document.getElementById("selectCriteria");

// div for sports categories
let sportSelect = document.getElementById("sportSelect");

// search input text
let searchInput = document.getElementById("searchInput");

let checker = false;
sportSelect.hidden = true;

function loadFile(sportName, isForInput) {
    let xhr = new XMLHttpRequest();
    if (isForInput) {
        xhr.open(
            `GET`,
            `index.php?action=searchSubmit&sportCriteria=${sportName}`,
        );
    }
    if (!isForInput) {
        xhr.open(
            `GET`,
            `index.php?action=searchSubmit&searchEvent=${sportName}`,
        );
    }

    xhr.addEventListener("load", function () {
        if (xhr.status === 200) {
            let response = xhr.responseText;
            let sectionThree = document.querySelector(
                "#mainContainer section:nth-child(3)",
            );
            sectionThree.innerHTML = response;
        } else if (
            xhr.readyState === XMLHttpRequest.DONE &&
            xhr.status != 200
        ) {
            alert(
                "There is an error !\n\nCode :" +
                    xhr.status +
                    "\nText : " +
                    xhr.statusText,
            );
        }
    });
    xhr.send(null);
}

{
    selectCriteria.addEventListener("change", function (e) {
        if (e.target.value == "Sport" && !checker) {
            sportSelect.hidden = false;
            searchInput.setAttribute("type", "hidden");
            checker = true;
        } else {
            sportSelect.hidden = true;
            searchInput.setAttribute("type", "text");
            checker = false;
        }
    });
}

{
    formCriteria.addEventListener("submit", function (e) {
        e.preventDefault();
        if (checker == true) {
            let criteria = document.querySelector("#sportsCriteria");
            let criteriaValue = criteria.options[criteria.selectedIndex].value;
            loadFile(criteriaValue, true);
        } else {
            let input = document.getElementById("searchInput");
            let inputValue = input.value;
            loadFile(inputValue, false);
        }
    });
}