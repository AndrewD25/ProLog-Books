/*
Andrew Deal
Prolog Books Profile Page JS
DUE DATE
*/

//Modal Window Code

const overlay = document.getElementById("overlay");

function showModal(id) {
    hideModal();
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    overlay.classList.remove("hidden");
}

function hideModal() {
    let modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        modals[i].classList.add("hidden");
    }
    overlay.classList.add("hidden");
}

overlay.onclick = hideModal;


//Profile Picture Menu Functionality 

let allPfpOptions = document.getElementsByClassName("pfpOption");
for (let i = 0; i < allPfpOptions.length; i++) {
    allPfpOptions[i].addEventListener("click", function (e) {
        let pfpsrc = e.target.closest(".pfpOption").getAttribute("src").replace("../Images/Pfps/", "");
        let pfpname = getPfpName(pfpsrc);
        document.getElementById("selected").textContent = pfpname;
    })
}

function getPfpName(src) {
    switch (src) {
        case "pfp1.jpg":
            return "Books";
        case "pfp2.jpg":
            return "Superman";
        case "pfp3.jpg":
            return "Batman";
        case "pfp4.jpg":
            return "Wonder Woman";
        case "pfp5.jpg":
            return "Spider-Man";
        case "pfp6.jpg":
            return "Hulk";
        case "pfp7.jpg":
            return "X-Men";
        case "pfp8.jpg":
            return "Invincible";
        case "pfp9.jpg":
            return "TMNT";
        case "pfp10.jpg":
            return "Optimus Prime";
        case "pfp11.jpg":
            return "Green Lantern";
        default:
            return "Default";
    }
}

