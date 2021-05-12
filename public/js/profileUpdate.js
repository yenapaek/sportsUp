const addMySport = () => {
    let mySportsList = document.getElementById("mySportsList");
    let sportsCategories = document.getElementById("sportsCategories");
    let newSport = document.createElement("li");
    let newCategory = sportsCategories.selectedOptions[0];
    let categoryId = newCategory.id;
    let categoryName = newCategory.innerHTML;
    console.log(categoryId);
    newSport.classList.add('category');

    newSport.appendChild(document.createTextNode('# '+categoryName));

    mySportsList.appendChild(newSport);
    
    
    let xhr = new XMLHttpRequest;
    xhr.open("POST", "../index.php?action=addMySport");
    // xhr.onreadystatechange = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //       let mySportsList = document.getElementById("mySportsList");
    //       let sportsCategories = document.getElementById("sportsCategories");
    //       let newSport = document.createElement("li");
    //       let newCategory = sportsCategories.selectedOptions[0];
    //       let categoryId = newCategory.id;
    //       let categoryName = newCategory.innerHTML;
    //         console.log(categoryId);
    //       newSport.classList.add('category');

    //       newSport.appendChild(document.createTextNode(categoryName));

    //       mySportsList.appendChild(newSport);

    //         }
    //   };
    xhr.send('categoryId='.categoryId);
}