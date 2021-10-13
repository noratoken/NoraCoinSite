/***
nextButton.js
Contributor: Tony M
close btn

***/

  $(".close").click(function(){
    $(".div").hide();
    $("#form").hide(300);
    $("#table").hide(300);
    $("#instructions").hide(300);
    $(".offers").hide();
  })
  // offer close button
  $("#closeOffer").click(function(){
    $("#mainMenu").show(300);
    $(".offers").hide();
    $(".div").hide();

  })
