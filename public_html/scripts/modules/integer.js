
$(function() {

$(".number-rows").click( function() {
	
  var value = parseInt(document.getElementById('test').value, 10);
  var counter=0;
  if ($(this).text() == "+") {
	  value++;
	  document.getElementById('test').value = value;
	} 
	
	
	else {
	
    if (counter >= 0){
	  value--;
	  document.getElementById('test').value = value;
	} 

  }


});
});