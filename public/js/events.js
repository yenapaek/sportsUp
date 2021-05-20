function loadFile(searchName, secondData, thirdData) {
    console.log(searchName);
    let xhr = new XMLHttpRequest();
    
    switch (searchName) {
        case 'Popularity':  xhr.open(`GET`, `index.php?action=searchSubmit&searchPopularity`);
                            break;
    
        case 'Sport':   xhr.open(`GET`, `index.php?action=searchSubmit&sportCriteria=${secondData}`);
                        break;

        case 'Event':   xhr.open(`GET`, `index.php?action=searchSubmit&searchEvent=${secondData}`);
                        break;

        case 'attendingEvents':    xhr.open(`POST`, `index.php?action=searchSubmit&attendingEvents`);
                            break;

        case 'Favorite':    xhr.open(`POST`, `index.php?action=favoriteCreation&favoriteUser=${secondData}&favoriteEvent=${thirdData}`);
                            break;

        case 'FavoriteEliminate':   xhr.open(`POST`, `index.php?action=favoriteElimination&favoriteUser=${secondData}&favoriteEvent=${thirdData}`);
                                    break;

        case 'hostingEvents' :    xhr.open(`GET`, `index.php?action=searchSubmit&hostingEvents`);
                                    break;
        default: return;
    }
    
    if(searchName != "Favorite" && searchName != "FavoriteEliminate") {
        xhr.addEventListener("load", function () {
            if (xhr.status === 200 ) {
                let response = xhr.responseText;
                let sectionThree = document.querySelector('#mainContainer section:nth-child(3)');
                sectionThree.innerHTML = response;
                initFavorites();
                
            } else if (xhr.readyState === XMLHttpRequest.DONE && xhr.status != 200) {
                alert('There is an error !\n\nCode :' + xhr.status + '\nText : ' + xhr.statusText);
            }
        });
    }
    console.log(xhr.readyState)
    xhr.send(null);
}

function initFavorites (){
    let favorites = document.querySelectorAll(".favorites");
    for( let i=0; i<favorites.length; i++) {
        favorites[i].addEventListener("click", function (e) {

            switch (e.target.classList.value) {
                case 'far fa-heart':    e.target.classList.value = 'fas fa-heart';
                                        loadFile('Favorite', favorites[i].getAttribute('dataUserId'), favorites[i].getAttribute('dataEventId'));
                                        break;
            
                case 'fas fa-heart' :   e.target.classList.value = 'far fa-heart';
                                        loadFile('FavoriteEliminate', favorites[i].getAttribute('dataUserId'), favorites[i].getAttribute('dataEventId'));
                                        break;
            
                default: return;
            }

        })
    }
}

// by sport or event
let selectCriteria = document.getElementById("selectCriteria");

// div for sports categories
let sportSelect = document.getElementById("sportSelect");

// search input text
let searchInput = document.getElementById("searchInput");
let formCriteria = document.getElementById("formCriteria");

let checker = false;
sportSelect.hidden = true;

{
    if(selectCriteria) {
        selectCriteria.addEventListener("change", function (e) {

            switch (true) {
                case e.target.value == 'Sport' && !checker: sportSelect.hidden = false;
                                                            searchInput.setAttribute("type", "hidden");
                                                            checker = true;
                                                            break;
            
                case e.target.value == 'Event': sportSelect.hidden = true;
                                                searchInput.setAttribute("type", "text");
                                                checker = false;
                                                break;
            
                case e.target.value == 'Popularity':    searchInput.setAttribute("type", "hidden");
                                                        sportSelect.hidden = true;
                                                        checker = false;
                                                        break;
            
                case e.target.value == 'attendingEvents':  searchInput.setAttribute("type", "hidden");
                                                    sportSelect.hidden = true;
                                                    checker = false;
                                                    break;

                case e.target.value == 'hostingEvents' :  searchInput.setAttribute("type", "hidden");
                                                            sportSelect.hidden = true;
                                                            checker = false;
                                                            break;
            
                default: return;
            }

        });
    
    }
    
    formCriteria.addEventListener("submit", function (e) {
        e.preventDefault();
        let selectCriteria = document.getElementById("selectCriteria");
        let selectCriteriaValue = selectCriteria.options[selectCriteria.selectedIndex].value;
        console.log('this is the selectcriteria value', selectCriteriaValue);

        switch (selectCriteriaValue) {
            case 'Sport':   let criteria = document.querySelector("#sportsCriteria");
                            let criteriaValue = criteria.options[criteria.selectedIndex].value;
                            loadFile('Sport', criteriaValue, null);
                            break;
            case 'Event':   let input = document.getElementById("searchInput");
                            let inputValue = input.value;
                            loadFile('Event', inputValue, null);
                            break;

            case 'Popularity':  loadFile('Popularity', null, null);
                                break;
            case 'attendingEvents':    loadFile('attendingEvents', selectCriteria.getAttribute('dataUserId'), null);
                                break;

            case 'hostingEvents' :    loadFile('hostingEvents', selectCriteria.getAttribute('dataUserId'), null);
                                        break;

            default: return;
        }
    });

    initFavorites();
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
