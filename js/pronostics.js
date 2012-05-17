$(window).load(function(){
  $(".collapse").collapse();
  setTimeout(function(){
    $($('.collapse')[0]).collapse('show');
    }, 1000);
});