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


// Login modal
const loginBtn = document.getElementById("loginBtn");
const modal = document.getElementById("loginModal");

// Open modal
loginBtn.addEventListener("click", function(e) {
    e.preventDefault();
    modal.style.display = "block";
});

// Close when clicking outside
window.addEventListener("click", function(e) {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});

// register
const signupModal = document.getElementById("signupModal");
const openSignup = document.getElementById("openSignup");
const backToLogin = document.getElementById("backToLogin");

// Open signup (from login)
openSignup.addEventListener("click", function(e) {
    e.preventDefault();
    modal.style.display = "none";        // close login
    signupModal.style.display = "block"; // open signup
});

// Back to login
backToLogin.addEventListener("click", function(e) {
    e.preventDefault();
    signupModal.style.display = "none";
    modal.style.display = "block";
});

// Close signup when clicking outside
window.addEventListener("click", function(e) {
    if (e.target === signupModal) {
        signupModal.style.display = "none";
    }
});