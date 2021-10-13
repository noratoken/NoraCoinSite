/***
nextButton.js
Contributor: Tony M
close btn

***/

  $("#btnFinancialGoals").click(function(){
    $("#form").hide(300);
    $("#table").hide(300);
    $("#instructions").hide(300);
    $("#financialGoalsDiv").show(300);

    $.ajax({
      url:"financialGoalsGet.php",
      success: function(e){
        $("#goalsDiv").show(300);
        $("#financialGoalsDiv").html(e);
      }
    })
  })
