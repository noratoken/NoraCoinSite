/***
nextButton.js
Contributor: Tony M
insert participant sql


***/
$("#addParticipant").click(function(){

  var participant, facebook_link, city, state, product;
  participant = $("#participant").val();
  facebook_link = $("#facebook_link").val();
  city = $("#city").val();
  state = $("#state").val();
  product = $("#product").val();
  $.ajax({
    url:"addParticipant.php",
    method: "post",
    dataType: "text",
    data: {participant:participant, facebook_link:facebook_link, city:city, state:state, product:product},
    success: function(e){
      $("#r").html(e);
      $("#addParticipant").hide();
      $("#next_1").show(300);
      $("#participant").show(300);
      $("#form").show(300);
      $("#table").hide();
      $(".in").val("")
      $(".nextInput").hide();

    }
  })
})
