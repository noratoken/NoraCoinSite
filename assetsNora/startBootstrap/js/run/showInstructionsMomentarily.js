/***
nextButton.js
Contributor: Tony M
show instructions momentarily

***/

$("#instructions").show(300);
$("#instructions").addClass("y");
setTimeout(function(){
  $("#instructions").hide(300);
  $("#instructions").removeClass("y");
},4000)
