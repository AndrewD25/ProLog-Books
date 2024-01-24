// Autocomplete Script
let dcComics = [
    "Action Comics",
    "Aquaman",
    "Batgirl",
    "Batman",
    "Birds of Prey",
    "Blue Beetle",
    "Booster Gold",
    "Catwoman",
    "Detective Comics",
    "Doom Patrol",
    "Green Arrow",
    "Green Lantern",
    "Green Lantern Corps",
    "Harley Quinn",
    "Hawkman",
    "Justice League",
    "Justice Society of America",
    "Legion of Super-Heroes",
    "Nightwing",
    "Red Hood and the Outlaws",
    "Sinestro",
    "Suicide Squad",
    "Superman",
    "Supergirl",
    "Teen Titans",
    "Titans",
    "The Flash",
    "Wonder Woman",
    "Young Justice"
];
let marvelComics = [
    "The Amazing Spider-Man",
    "Ant-Man",
    "The Avengers",
    "Black Panther",
    "Captain America",
    "Daredevil",
    "Deadpool",
    "Doctor Strange",
    "Fantastic Four",
    "Guardians of the Galaxy",
    "The Incredible Hulk",
    "Iron Man",
    "Luke Cage",
    "Ms. Marvel",
    "The Punisher",
    "The Silver Surfer",
    "The Spectacular Spider-Man",
    "Spider-Woman",
    "Thor",
    "Venom",
    "Wolverine",
    "X-Force",
    "X-Men",
];
let otherComics = [
    "Hellboy",
    "Invincible",
    "Spawn",
    "WildC.A.T.s"
];
let otherBooks = [
    "Harry Potter",
    "The Lord of the Rings",
    "Game of Thrones",
    "The Chronicles of Narnia",
    "The Hunger Games",
    "Divergent",
    "Percy Jackson & the Olympians",
    "The Maze Runner",
    "Twilight",
    "The Dark Tower"
];
let autoSuggest = [...dcComics, ...marvelComics, ...otherComics, ...otherBooks];

function autocomplete(inp, arr = autoSuggest) { //arr is optional param
    var currentFocus;
    var maxResults = 5; // Maximum number of results to display
    
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        closeAllLists();
        if (!val) { return false; }
        currentFocus = -1;
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);

        for (i = 0; i < arr.length; i++) {
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                if (a.childElementCount >= maxResults) {
                    break; // Exit loop if maximum results reached
                }

                b = document.createElement("DIV");
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                
                b.addEventListener("click", function(e) {
                    inp.value = this.getElementsByTagName("input")[0].value;
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });

    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            currentFocus++;
            addActive(x);
        } else if (e.keyCode == 38) { //up
            currentFocus--;
            addActive(x);
        } else if (e.keyCode == 13) {
            e.preventDefault();
            if (currentFocus > -1) {
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}