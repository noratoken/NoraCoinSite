/***
nextButton.js
Contributor: Tony M
validates that inputs are not empty.
hides and shows next buttons


***/
// next button
var next,n,l,c,s,p;
next = 1;
$(".next").click(function(){
  n = $("#participant").val();
  l = $("#facebook_link").val();
  c = $("#city").val();
  s = $("#state").val();
  p = $("#product").val();

  if(next == 1){
    if(n == ""){
      $("#participant").removeClass("fill");
      $("#participant").addClass("fill");
      return false;
    }else{
      $("#participant").removeClass("fill");
    }
    $("#participant").hide();
    $("#facebook_link").show(300);

    next = 2;
    $("#r").html(n+"<br/>")
  }else if (next == 2){
    if(l == ""){
      $("#facebook_link").addClass("fill");
      return false;
    }else{
      $("#facebook_link").removeClass("fill");
    }
    $("#facebook_link").hide();
    $("#city").show(300);
    $("#r").html(n+"<br/>"+l+"<br/>")
    next = 3;
  }else if (next == 3){
    if(c == ""){
      $("#city").addClass("fill");
      return false;
    }else{
      $("#city").removeClass("fill");
    }
    $("#city").hide();
    $("#state").show(300);
    $("#r").html(n+"<br/>"+l+"<br/>"+c+"<br/>")
    next = 4;
  }else if (next == 4){
    if(s == ""){
      $("#state").addClass("fill");
      return false;
    }else{
      $("#state").removeClass("fill");
    }
    $("#state").hide();
    $("#product").show(300);
    next = 5;
    $("#r").html(n+"<br/>"+l+"<br/>"+c+"<br/>"+s+"<br/>")
  }else if (next == 5){
    if(p == ""){
      $("#product").addClass("fill");
      return false;
    }else{
      $("#product").removeClass("fill");
    }
    $("#product").hide();
    next = 1;
    $("#r").html(n+"<br/>"+l+"<br/>"+c+"<br/>"+s+"<br/>"+p)
    $(".next").hide();
    $("#addParticipant").show(300);
  }
})
