
$(function() {

$(".number-rows").click( function() {

  var $button = $(this);
  var counter=0;
  if ($button.text() == "+") {
	  counter = $("#test").val();
	  counter++;
	  ($("#test").val(counter));
	} 
	else {

	
    if (counter > 0){
      counter = $("#test").val();
	  counter--;
	  ($("#test").val(counter));
	} 

  }


});
});