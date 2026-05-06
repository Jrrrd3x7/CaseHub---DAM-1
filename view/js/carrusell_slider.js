function initCarrusel() {
    const slider = document.getElementById("slider");
    const btnLeft = document.getElementById("btn-left");
    const btnRight = document.getElementById("btn-right");

    if (!slider || !btnLeft || !btnRight) return;

    const slideWidth = 420;

    btnLeft.onclick = () => {
        slider.scrollBy({ left: -slideWidth, behavior: "smooth" });
    };

    btnRight.onclick = () => {
        slider.scrollBy({ left: slideWidth, behavior: "smooth" });
    };
}
