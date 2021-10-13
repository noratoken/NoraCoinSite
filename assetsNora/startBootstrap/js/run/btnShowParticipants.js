/***
nextButton.js
Contributor: Tony M
hides other tabs.
pulls participant data


***/
// next button
$("#showTable").click(function(){
  $("#table").show(300);
  $("#form").hide();
  $("#instructions").hide();
  $("#instructions").removeClass("y");
  $(".div").hide();

  $.ajax({
    url:"seeParticipant.php",
    success: function(e){
      $("#allParticipants").html(e);
    }
  })
})
