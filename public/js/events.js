let selectCriteria = document.getElementById("selectCriteria");
let sportSelect = document.getElementById("sportSelect");
let searchInput = document.getElementById("searchInput");
let formCriteria = document.getElementById("formCriteria");
let checker = false;
sportSelect.hidden = true;

function loadFile(searchName, sportName) {
    let xhr = new XMLHttpRequest();
    if (searchName == 'Sport') {
        xhr.open(`GET`, `index.php?action=searchSubmit&sportCriteria=${sportName}`);
    } 
    if (searchName == 'Event') {
        xhr.open(`GET`, `index.php?action=searchSubmit&searchEvent=${sportName}`);
    }
    if (searchName == 'Popularity') {
        xhr.open(`GET`, `index.php?action=searchSubmit&searchPopularity`);
    }
    if (searchName == 'Recently') {
        xhr.open(`GET`, `index.php?action=searchSubmit&searchRecently`);
    }

    xhr.addEventListener("load", function () {
        if (xhr.status === 200) {
            let response = xhr.responseText;
            let sectionThree = document.querySelector('#mainContainer section:nth-child(3)');
            sectionThree.innerHTML = response;
            

        } else if (xhr.readyState === XMLHttpRequest.DONE && xhr.status != 200) {
            alert('There is an error !\n\nCode :' + xhr.status + '\nText : ' + xhr.statusText);
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
        } if (e.target.value == "Event") {
            sportSelect.hidden = true;
            searchInput.setAttribute("type", "text");
            checker = false;
        } if (e.target.value == "Popularity") {
            searchInput.setAttribute("type", "hidden");
            sportSelect.hidden = true;
        } if (e.target.value == "Recently") {
            searchInput.setAttribute("type", "hidden");
            sportSelect.hidden = true;
        }
    });
}

{
    formCriteria.addEventListener("submit", function (e) {
        e.preventDefault();
        let selectCriteria = document.getElementById("selectCriteria");
        let selectCriteriaValue = selectCriteria.options[selectCriteria.selectedIndex].value;

        if(selectCriteriaValue == 'Sport') {
            let criteria = document.querySelector("#sportsCriteria");
            let criteriaValue = criteria.options[criteria.selectedIndex].value;
            loadFile('Sport', criteriaValue);
        }
        if (selectCriteriaValue == 'Event') {
            let input = document.getElementById("searchInput");
            let inputValue = input.value;
            loadFile('Event', inputValue);
        }
        if (selectCriteriaValue == 'Popularity') {
            loadFile('Popularity');
        }
        if (selectCriteriaValue == 'Recently') {
            loadFile('Recently');
        }
    });
}





