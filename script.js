let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".fa-magnifying-glass");
closeBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
});
searchBtn.addEventListener("click", () => {
  // Sidebar open when you click on the search iocn
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
});



// This is for the fa-bars. But it can't work
function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the icons
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the icons
  }
}