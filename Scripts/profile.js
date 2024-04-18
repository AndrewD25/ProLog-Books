/*
Andrew Deal
Prolog Books Profile Page JS
DUE DATE
*/

//Modal Window Code

const overlay = document.getElementById("overlay");

function showUserModal() {
    const userModal = document.getElementById("editProfileModal");
    hideAllModal()
    userModal.classList.remove('hidden');
    overlay.classList.remove("hidden");
}

function showPfpModal() {
    const pfpModal = document.getElementById("pfpModal");
    pfpModal.classList.remove('hidden');
    overlay.classList.remove("hidden");
}

function hidePfpModal() {
    const pfpModal = document.getElementById("pfpModal");
    pfpModal.classList.add('hidden');
}

function hideAllModal() {
    let modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        modals[i].classList.add("hidden");
    }
    overlay.classList.add("hidden");
}

overlay.onclick = hideAllModal;


//Profile Picture Menu Functionality 

let allPfpOptions = document.getElementsByClassName("pfpOption");
for (let i = 0; i < allPfpOptions.length; i++) {
    allPfpOptions[i].addEventListener("click", function (e) {
        let pfpsrc = e.target.closest(".pfpOption").getAttribute("src").replace("../Images/Pfps/", "");
        let pfpname = convert(pfpsrc);
        document.getElementById("selected").textContent = pfpname;
    })
}

const selectBtn = document.querySelector(".selector");
selectBtn.addEventListener("click", function(e) {
    let selected = document.getElementById("selected").textContent;
    if (selected !== "None") {
        document.getElementById("modalPfp").src = "../Images/Pfps/" + convert(selected, "name-to-pfp");
        document.getElementById("hidden_pfp_input").value = convert(selected, "name-to-pfp");
    }
    hidePfpModal();
})

function convert(src, direction = "pfp-to-name") {
    const pfpToName = {
        "pfp1.jpg": "Books",
        "pfp2.jpg": "Superman",
        "pfp3.jpg": "Batman",
        "pfp4.jpg": "Wonder Woman",
        "pfp5.jpg": "Spider-Man",
        "pfp6.jpg": "Hulk",
        "pfp7.jpg": "X-Men",
        "pfp8.jpg": "Invincible",
        "pfp9.jpg": "TMNT",
        "pfp10.jpg": "Optimus Prime",
        "pfp11.jpg": "Green Lantern"
    };
    
    const nameToPfp = {};
    for (const key in pfpToName) {
        const value = pfpToName[key];
        nameToPfp[value] = key;
    }

    if (direction === "pfp-to-name") {
        return pfpToName[src] || "Default";
    } else if (direction === "name-to-pfp") {
        return nameToPfp[src] || "Default";
    } else {
        return "Invalid direction";
    }
}


//Bio form functionality
