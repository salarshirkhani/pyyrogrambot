// diagram dashborad ba-ham
var xValues = ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهار شنبه", "پنج شنبه", "جمعه"];
var yValues = [100, 49, 44, 25, 0];
var barColors = ["red", "green","blue","orange","brown"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    }
  }
});
///menu-bar-mobile js
const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
        
let showMenu = false;
        
menuBtn.addEventListener('click', toggleMenu);
        
function toggleMenu() {
  if (!showMenu) {
    menu.classList.add('show');
    showMenu = true;
  } 
  else {
    menu.classList.remove('show');
    showMenu = false;
  }
}
//   
const viewportWidth = screen.width;
if (viewportWidth >= 1000) {
  $('#side').stick_in_parent(); 
}     
