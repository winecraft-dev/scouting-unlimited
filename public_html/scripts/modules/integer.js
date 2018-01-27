$(document).ready(function() {
$(function() {
	
$(".numbers-row").append('<div class=".integer-arrowup">+</div>');

$(".integer-arrowup").on("click", function() {

  var $button = $(this);
  var oldValue = $button.parent().find("input[type==number1]").val();

	  var newVal = parseint(oldValue) + 1;

  $button.parent().find("value").val(newVal);

});
});
});