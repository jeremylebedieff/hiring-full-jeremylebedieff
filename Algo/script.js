var i = 1;
var contenu = "";
$(function(){
  fizzBuzz(i);
  $(document).on("scroll", scrolled);
});
function scrolled(){
  if($(document).scrollTop() + $(window).height() >= $(document).height()){
    i+=100;
    fizzBuzz(i);
  }
}
function fizzBuzz(j){
  for(var i=j; i<=j+99; i++){
    contenu += (i%3 == 0) ? "fizz " : "";
    contenu += (i%5 == 0) ? "buzz" : "";
    contenu += (contenu == "") ? i : "";
    classe = contenu + " col"
    $("#contenu").append("<div class='"+classe+"'>"+contenu+"</div>");
    contenu = "";
  }
}