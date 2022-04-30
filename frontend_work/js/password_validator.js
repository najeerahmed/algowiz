const password = document.getElementById("password");
const req_special_char = document.getElementById("req-special-char");
const req_number = document.getElementById("req-number");
const req_length = document.getElementById("req-length");
const submit_button = document.getElementById("bt-submit");

// disable the enter key - so the user has to click through register account
window.addEventListener("keydown", (e) => {
    if (e.keyCode === 13){
        console.log("test");
        e.preventDefault();
    }
});

let satisfy_special = false;
let satisfy_num = false;
let satisfy_length = false;
password.addEventListener("keyup", () => {
    if (special_check(password.value)){
        req_special_char.style.color = "green";
        satisfy_special = true;
    }
    else {
        req_special_char.style.color = "red";
        satisfy_special = false;
    }

    if (num_check(password.value)){
        req_number.style.color = "green";
        satisfy_num = true;
    }
    else {
        req_number.style.color = "red";
        satisfy_num = false;
    }

    if (password.value.length >= 7){
        req_length.style.color = "green";
        satisfy_length = true;
    }
    else {
        req_length.style.color = "red";
        satisfy_length = false;
    }
});

// if password conditions are not met yet then don't send data to backend
submit_button.addEventListener("click", (e) => {
    if (!(satisfy_length && satisfy_num && satisfy_special)){
        e.preventDefault();
    }
});




function special_check(string){
    const special_chars = "~`!#$%^&*+@=-()[]\\\';,/{}|\":<>?";
    for (let i = 0; i < string.length; i++){
        if (special_chars.includes(string[i])){
            return true;
        }
    }

    return false;
}

function num_check(string){
    for (let i = 0; i < string.length; i++){
        if (!isNaN(string[i])){
            return true;
        }
    }

    return false;
}