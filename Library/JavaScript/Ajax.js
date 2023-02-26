function checkUsername(){
   
    jQuery.ajax({
        url: "../SignUp/CheckAvailability.php",
        data: 'name='+$("#username").val(),
        type: "POST",
        success:function(data){
            $("#userNameSpan").html(data);
        },
        error:function(){}
    });
}

function checkEmail(){
   
    jQuery.ajax({
        url: "../SignUp/CheckAvailability.php",
        data: 'email='+$("#email").val(),
        type: "POST",
        success:function(data){
            $("#emailSpan").html(data);
        },
        error:function(){}
    });
}
function loadDoc() {
    // postavljanje objekta
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "GetData.php");
  
    // kod koji ce se izvrsiti nakon ucitavanja datoteke podaci.php
    xhttp.onload = function() {
      // nakon ucitavanja podaci.php, sav sadrzaj ce se umetnuti u div #demo
      document.getElementById('demo').innerHTML = this.responseText;
    }
  
    // slanje AJAX zahtjeva
    xhttp.send();
  }
