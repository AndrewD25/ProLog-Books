//Autocomplete script

"use strict";

function autocomplete(inp, arr) {
    var currentFocus;
    var maxResults = 5; // Maximum number of results to display
    
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value.toLowerCase();
        closeAllLists();
        if (val.length < 2) { return false; } // Only start showing suggestions when input is 2 characters or longer
        currentFocus = -1;

        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        this.parentNode.appendChild(a);

        for (i = 0; i < arr.length; i++) {
            var item = arr[i].toLowerCase();
            var normalizedVal = (val !== "the " && val.startsWith("the ")) ? val.substring(4) : val;
            var normalizedItem = item.startsWith("the ") ? item.substring(4) : item;

            if (item.startsWith(val) || item.includes(normalizedVal) || normalizedItem.includes(val)) {
                if (a.childElementCount >= maxResults) {
                    break; // Exit loop if maximum results reached
                }

                b = document.createElement("DIV");
                var startIndex = arr[i].toLowerCase().indexOf(normalizedVal);
                var matchLength = normalizedVal.length;

                if (startIndex >= 0) {
                    b.innerHTML = arr[i].substring(0, startIndex) + "<strong>" + arr[i].substring(startIndex, startIndex + matchLength) + "</strong>" + arr[i].substring(startIndex + matchLength);
                } else {
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                }

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
