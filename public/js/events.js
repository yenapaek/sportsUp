// by sport or event
let selectCriteria = document.getElementById("selectCriteria");

// div for sports categories
let sportSelect = document.getElementById("sportSelect");

// search input text
let searchInput = document.getElementById("searchInput");
let formCriteria = document.getElementById("formCriteria");

let checker = false;
sportSelect.hidden = true;

function loadFile(searchName, secondData, thirdData) {
    let xhr = new XMLHttpRequest();
    if (searchName == 'Popularity') {
        xhr.open(`GET`, `index.php?action=searchSubmit&searchPopularity`);
    }
    if (searchName == 'FavoritesEvents') {
        xhr.open(`GET`, `index.php?action=searchSubmit&searchFavorites=${secondData}`);
    }
    if (searchName == 'Sport') {
        xhr.open(`GET`, `index.php?action=searchSubmit&sportCriteria=${secondData}`);
    } 
    if (searchName == 'Event') {
        xhr.open(`GET`, `index.php?action=searchSubmit&searchEvent=${secondData}`);
    }
    if (searchName == 'MyEvents') {
        xhr.open(`GET`, `index.php?action=searchSubmit&myEvents=${secondData}`);
    }
    if (searchName == 'Favorite') {
        xhr.open(`POST`, `index.php?action=favoriteCreation&favoriteUser=${secondData}&favoriteEvent=${thirdData}`);
    }
    if (searchName == 'FavoriteEliminate') {
        xhr.open(`POST`, `index.php?action=favoriteElimination&favoriteUser=${secondData}&favoriteEvent=${thirdData}`);
    }

    xhr.addEventListener("load", function () {
        if (xhr.status === 200 ) {
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
        } if (e.target.value == "MyEvents") {
            searchInput.setAttribute("type", "hidden")
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
        if (selectCriteriaValue == 'FavoritesEvents') {
            loadFile('FavoritesEvents', selectCriteria.getAttribute('dataUserId'));
            console.log(criteriaValue);
            loadFile(criteriaValue, true);
        } 
        if (selectCriteriaValue == 'MyEvents') {
            loadFile('MyEvents', selectCriteria.getAttribute('dataUserId'))
        }
        else {
            let input = document.getElementById("searchInput");
            let inputValue = input.value;
            loadFile(inputValue, false);
        } 
    });
}

{
    let favorites = document.querySelectorAll(".favorites");
    for( let i=0; i<favorites.length; i++) {
        favorites[i].addEventListener("click", function (e) {
            console.log('empty heart, so filling the heart');
            if (e.target.classList.value == 'far fa-heart') {
                e.target.classList.remove("far");
                e.target.classList.add("fas");
                loadFile('Favorite', favorites[i].getAttribute('dataUserId'), favorites[i].getAttribute('dataEventId'));
            }
            if (e.target.classList.value == 'fas fa-heart') {
                console.log('full heart, so getting it empty');
                e.target.classList.remove("fas");
                e.target.classList.add("far");
                loadFile('FavoriteEliminate', favorites[i].getAttribute('dataUserId'), favorites[i].getAttribute('dataEventId'));
            }
        })
    }
}






// {
    // let buttons = document.querySelectorAll("a[eventId]");    
    // const attendEvent = (button) => {
    //     let eventId = button.getAttribute('eventId');
    //     // if (eventId){
    //         button.addEventListener("click", (e) => {
    //             let currentButton = e.target;
    //             let xhr = new XMLHttpRequest();
    //             xhr.open('POST', 'index.php?action=attendEvent');
    //             let form = new FormData();
    //             form.append("eventId",eventId);
    //             xhr.send(form);
            
    //             xhr.addEventListener("load", function() {
    //                 if (xhr.status === 200) {
    //                     currentButton.innerHTML = "Attending";
    //                     // #TODO add something to show that a user is attending an event
    //                     alert("attending event added!");
    //                 } else if (xhr.readyState === XMLHttpRequest.DONE && xhr.status != 200) {
    //                     alert('There is an error !\n\nCode :' + xhr.status + '\nText : ' + xhr.statusText);
    //                 }
    //             });
    //         });
        // } else {
        //     button.href = "index.php?action=signInAndSignUp";
        // }
//     }
//     buttons.forEach(button => attendEvent(button));
// }
