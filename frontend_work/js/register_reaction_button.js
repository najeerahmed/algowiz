const like_button = document.getElementById("bt-like");
const dislike_button = document.getElementById("bt-dislike");

let liked = false;
let disliked = false;

like_button.addEventListener("click", () => {
    liked = !liked;
    if (liked){
        like_button.style.backgroundColor = "#6A3190";
    }
    else {
        like_button.style.backgroundColor = "white";
    }
    
    disliked = false;
    dislike_button.style.backgroundColor = "white";
});

dislike_button.addEventListener("click", () => {
    disliked = !disliked;

    if (disliked){
        dislike_button.style.backgroundColor = "#6A3190";
    }
    else {
        dislike_button.style.backgroundColor = "white";
    }

    liked = false;
    like_button.style.backgroundColor = "white";
});