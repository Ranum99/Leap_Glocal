window.onload = typeOfUser;

function typeOfUser() {
    const labels = document.getElementsByClassName("typeOfUser_label");
    const inputs = document.getElementsByClassName("typeOfUser_input");


    for (let j = 0; j < labels.length; j++) {
        if (inputs[j].checked) {
            labels[j].style.background = "red";
        } else {
            labels[j].style.background = "white";
        }
    }

    for (let i = 0; i < labels.length; i++) {
        inputs[i].addEventListener("click", () => {
            for (let j = 0; j < labels.length; j++) {
                if (inputs[j].checked) {
                    labels[j].style.background = "red";
                } else {
                    labels[j].style.background = "white";
                }
            }
        })
    }
}