/*
Andrew Deal
Secret Shelf All Pages Shared JS
DUE DATE
*/

"use strict";

//Sign Out : Primarily used on Collection and Account pages
function signOut() {
    localStorage.removeItem("username");
    location.reload();
}