/***
nextButton.js
Contributor: Tony M
hides other tabs.
show add participant input


***/
$("#add").click(function(){
  $("#instructions").hide();
  $("#addParticipant").hide();
  $("#next_1").show(300);
  $("#participant").show(300);
  $("#form").show(300);
  $("#table").hide();
  $(".in").val("")
  $(".nextInput").hide();
  $("#instructions").removeClass("y");
  $(".div").hide();
})
