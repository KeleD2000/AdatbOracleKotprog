function openTab(evt, tabName) {
    var i, x, tablinks;
    x = document.getElementsByClassName("content-tab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tab");
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" tab-is-active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " tab-is-active";
}

function openModal(button) {
    console.log(button)
    var src = button.getAttribute("src");
    document.getElementById("modal-img").setAttribute("src", src);

    document.getElementById("modal1")
        .classList.add("is-active");
}
document.querySelectorAll(
    '.modal-background, .modal-close,.modal-card-head .delete, .modal-card-foot .button'
).forEach(($el) => {
    const $modal = $el.closest('.modal');
    $el.addEventListener('click', () => {
        $modal.classList.remove("is-active");
    });
});