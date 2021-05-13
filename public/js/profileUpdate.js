const addMySport = () => {
    let mySportsList = document.getElementById("mySportsList");
    let sportsCategories = document.getElementById("sportsCategories");
    let newCategory = sportsCategories.selectedOptions[0];
    let newSport = document.createElement("li");
    let categoryId = newCategory.id;
    let categoryName = newCategory.innerHTML;
    newSport.classList.add('category');
    newSport.appendChild(document.createTextNode('# '+categoryName));
    mySportsList.appendChild(newSport);
    mySportsList.appendChild(document.createElement("br"));
    
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'index.php?action=addMySport');
    let form = new FormData();
    form.append("categoryId",categoryId);
    xhr.send(form);
}