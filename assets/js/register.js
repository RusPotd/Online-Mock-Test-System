$("#close_register").click(function(){
    $("#register").addClass("hide");
    $("#log_in").removeClass("hide");
});
$("#close_signin").click(function(){
    $("#signin").addClass("hide");
});
$("#btn_register").click(function(){
    $("#log_in").addClass("hide");
    $("#register").removeClass("hide");
});