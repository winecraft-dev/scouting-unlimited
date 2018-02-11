
$(function() {

$(".integer-numberrows").click( function() {
  var value = $(this).parent().find("input").val();
	
  if ($(this).text().includes("+")) {
	  console.log("a");
	  value++;	
	} 
	
	else {
    if (value >0){
	  console.log('f');
	  value--; 
	} 
	else{
	value=0;
	console.log("g");
	}
	
  }

	$(this).parent().find("input").val(value);

});
});