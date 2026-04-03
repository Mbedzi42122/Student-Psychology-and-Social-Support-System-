const hero = document.querySelector(".hero");
const dots = document.querySelectorAll(".dot");

const backgrounds = [
    "img/Background1.png",
    "img/Background2.png",
    "img/Background3.png"
];

let index = 0;

function changeBackground() {
    index++;

    if (index >= backgrounds.length) {
        index = 0;
    }

    // Change background
    hero.style.backgroundImage = `url(${backgrounds[index]})`;

    // Update dots
    dots.forEach(dot => dot.classList.remove("active"));
    dots[index].classList.add("active");
}

// Change every 20 seconds
setInterval(changeBackground, 20000);