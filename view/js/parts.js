fetch("../html/header.html")
    .then(res => res.text())
    .then(data => {
        document.getElementById("header").innerHTML = data;
        if (typeof initMenus === "function") initMenus();
        if (typeof initCarrusel === "function") initCarrusel();
});

fetch("../html/footer.html")
    .then(res => res.text())
    .then(data => {
        document.getElementById("footer").innerHTML = data;
});

