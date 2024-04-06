let cells = document.querySelectorAll(".gallery-cell");
let flkty = document.querySelector(".gallery").flickity();
flkty.on("select", function () {
  cells.forEach(function (cell) {
    cell.classList.remove("is-selected");
  });
  cells[flkty.selectedIndex].classList.add("is-selected");
});
