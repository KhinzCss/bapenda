function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
function myFunction2(){
    document.getElementById("myDropdown2").classList.toggle("show");
}
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(e) {
    if (!e.target.matches('.dropbtn')) {
    var myDropdown = document.getElementById("myDropdown");
    var myDropdown2 = document.getElementById("myDropdown2");
      if (myDropdown.classList.contains('show'),1000 & myDropdown2.classList.contains('show'),1000) {
        myDropdown.classList.remove('show');
        myDropdown2.classList.remove('show');
      }
    }
  }

  