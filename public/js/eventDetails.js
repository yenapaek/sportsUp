const addComment = (eventId) => {
    const allBox = document.querySelector("#comment");
    const form = document.querySelector("#formComment");
    const input = document.querySelector("#commentAdd");
  
    let xhr = new XMLHttpRequest();
    xhr.open(`POST`, `index.php`);
    let formData = new FormData(form);
    xhr.addEventListener("load", function () {
        if (xhr.status === 200) {
            allBox.innerHTML = xhr.responseText;
            deleteCommentEventInit();
            input.value = "";
        }
    });
    xhr.send(formData);
};

function deleteCommentEventInit() {
    if (document.querySelectorAll(".deleteComment")) {
        const delIcon = document.querySelectorAll(".deleteComment");
        const commentIdDel = document.querySelectorAll(".commentIdDel");
        const eventIdDel = document.querySelectorAll(".eventIdDel");
        delIcon.forEach((element, index) => {
            element.addEventListener("click", () => {
                let xhr = new XMLHttpRequest();
                xhr.open(`POST`, `index.php`);
                let form_data = new FormData();
                form_data.append("action", "deleteComment");
                form_data.append("commentIdDel", commentIdDel[index].value);
                form_data.append("eventIdDel", eventIdDel[index].value);
                xhr.addEventListener("load", function () {
                    if (xhr.status === 200) {
                        const parentBox = element.parentElement.parentElement;
                        parentBox.remove();
                    }
                });
                xhr.send(form_data);
            });
        });
    }
}

deleteCommentEventInit();

{
    let attendBtn = document.querySelector(".attendBtn>a");
    if(attendBtn.classList[1] === "eventFull"){
        attendBtn.href="";
        attendBtn.style.backgroundColor = "grey";
    }
}
