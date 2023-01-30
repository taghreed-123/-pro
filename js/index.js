function terms(type){
    if(type=="business"){
        document.getElementById('store-name').style.display="block";
        document.getElementById('user-terms').style.display="none";
        document.getElementById('business-terms').style.display="block";
    }else{
        document.getElementById('store-name').style.display="none";
        document.getElementById('user-terms').style.display="block";
        document.getElementById('business-terms').style.display="none";
    }
}
function allLetter()
      { 
      var letters = /^[A-Za-z]+$/;
      if(document.getElementById('paymentCardName').value.match(letters))
      {
      return true;
      }
      else
      {
        document.getElementById('paymentCardName').style.borderBlockColor="red";
      return false;
      }
      }