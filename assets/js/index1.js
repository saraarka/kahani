    var rightButton = $("#right-btn");
    var leftButton = $("#left-btn");
    var container = $("#StoryCont");
    var slideCont = $("#story-slider");
    if($("#story-slider > div").length<5){
      $('#right-btn').css('visibility','hidden');
      $('#left-btn').css('visibility','hidden');
    }
    var maxcount=$("#story-slider > div").length;
    var marLeft = 0, maxX = maxcount*210, diff = 0 ;
    
    function slide() {
    marLeft-=218;
    if( marLeft < -maxX ){ 
      marLeft = -maxX+183 ;
    }
      slideCont.animate({"margin-left" : marLeft + "px"}, 400);
    }
    
    function slideBack() {
      marLeft +=218;
      if ( marLeft > 0 ) { marLeft = 0 ;}
      slideCont.animate({"margin-left" : marLeft + "px"}, 400);
    }
    rightButton.click(slide);
    leftButton.click(slideBack);
    
    /*touch code from here*/
    
    $(container).on("mousedown touchstart", function(e) {
      
      var startX = e.pageX || e.originalEvent.touches[0].pageX;
      diff = 0;
    
      $(container).on("mousemove touchmove", function(e) {
        
          var xt = e.pageX || e.originalEvent.touches[0].pageX;
          diff = (xt - startX) * 100 / window.innerWidth;
        if( marLeft == 0 && diff > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeft == -maxX && diff < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(container).on("mouseup touchend", function(e) {
      $(container).off("mousemove touchmove");
      if(  marLeft == 0 && diff > 4 ) { 
          sliderCont.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeft == -maxX  && diff < 4 ){
           sliderCont.animate({"margin-left" : -maxX  + "px"},100);  
       } else {
          if (diff < -10) {
            slide();
          } else if (diff > 10) {
            slideBack();
          } 
      }
    });


//<!-- END STORIES -->


var rightButtonls = $("#right-btnls");
var leftButtonls = $("#left-btnls");
var containerls = $("#StoryContls");
var slideContls = $("#story-sliderls");
if($("#story-sliderls > div").length<5){
  $('#right-btnls').css('visibility','hidden');
  $('#left-btnls').css('visibility','hidden');
}
var maxcountls=$("#story-sliderls > div").length;
var marLeftls = 0, maxXls = maxcountls*210, diffls = 0 ;

function slidels() {
marLeftls-=218;
if( marLeftls < -maxXls ){ 
  marLeftls = -maxXls+183 ;
}
  slideContls.animate({"margin-left" : marLeftls + "px"}, 400);
}

function slideBackls() {
  marLeftls +=218;
  if ( marLeftls > 0 ) { marLeftls = 0 ;}
  slideContls.animate({"margin-left" : marLeftls + "px"}, 400);
}
rightButtonls.click(slidels);
leftButtonls.click(slideBackls);

/*touch code from here*/

$(containerls).on("mousedown touchstart", function(e) {
  
  var startXls = e.pageX || e.originalEvent.touches[0].pageX;
  diffls = 0;

  $(containerls).on("mousemove touchmove", function(e) {
    
      var xtls = e.pageX || e.originalEvent.touches[0].pageX;
      diffls = (xtls - startXls) * 100 / window.innerWidth;
    if( marLeftls == 0 && diffls > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftls == -maxXls && diffls < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containerls).on("mouseup touchend", function(e) {
  $(containerls).off("mousemove touchmove");
  if(  marLeftls == 0 && diffls > 4 ) { 
      sliderContls.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftls == -maxXls  && diffls < 4 ){
       sliderContls.animate({"margin-left" : -maxXls  + "px"},100);  
   } else {
      if (diffls < -10) {
        slidels();
      } else if (diffls > 10) {
        slideBackls();
      } 
  }
});


//<!-- END LATEST SERIES -->

//<!-- TOP STORIES -->

var rightButtonts = $("#right-btnts");
var leftButtonts = $("#left-btnts");
var containerts = $("#StoryContts");
var slideContts = $("#story-sliderts");
if($("#story-sliderts > div").length<5){
  $('#right-btnts').css('visibility','hidden');
  $('#left-btnts').css('visibility','hidden');
}
var maxcountts=$("#story-sliderts > div").length;
var marLeftts = 0, maxXts = maxcountts*210, diffls = 0 ;

function slidets() {
marLeftts-=218;
if( marLeftts < -maxXts ){ 
  marLeftts = -maxXts+183 ;
}
  slideContts.animate({"margin-left" : marLeftts + "px"}, 400);
}

function slideBackts() {
  marLeftts +=218;
  if ( marLeftts > 0 ) { marLeftts = 0 ;}
  slideContts.animate({"margin-left" : marLeftts + "px"}, 400);
}
rightButtonts.click(slidets);
leftButtonts.click(slideBackts);

/*touch code from here*/

$(containerts).on("mousedown touchstart", function(e) {
  
  var startXts = e.pageX || e.originalEvent.touches[0].pageX;
  diffts = 0;

  $(containerts).on("mousemove touchmove", function(e) {
    
      var xtts = e.pageX || e.originalEvent.touches[0].pageX;
      diffts = (xtts - startXts) * 100 / window.innerWidth;
    if( marLeftts == 0 && diffts > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftts == -maxXts && diffts < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containerts).on("mouseup touchend", function(e) {
  $(containerts).off("mousemove touchmove");
  if(  marLeftts == 0 && diffts > 4 ) { 
      sliderContts.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftts == -maxXts  && diffts < 4 ){
       sliderContts.animate({"margin-left" : -maxXts  + "px"},100);  
   } else {
      if (diffts < -10) {
        slidets();
      } else if (diffts > 10) {
        slideBackts();
      } 
  }
});

//<!-- END TOP STORIES -->

//<!-- LATEST STORIES -->
var rightButtontsl = $("#right-btntsl");
var leftButtontsl = $("#left-btntsl");
var containertsl = $("#StoryConttsl");
var slideConttsl = $("#story-slidertsl");
if($("#story-slidertsl > div").length<5){
  $('#right-btntsl').css('visibility','hidden');
  $('#left-btntsl').css('visibility','hidden');
}
var maxcounttsl=$("#story-slidertsl > div").length;
var marLefttsl = 0, maxXtsl = maxcounttsl*210, diffls = 0 ;

function slidetsl() {
marLefttsl-=218;
if( marLefttsl < -maxXtsl ){ 
  marLefttsl = -maxXtsl+183 ;
}
  slideConttsl.animate({"margin-left" : marLefttsl + "px"}, 400);
}

function slideBacktsl() {
  marLefttsl +=218;
  if ( marLefttsl > 0 ) { marLefttsl = 0 ;}
  slideConttsl.animate({"margin-left" : marLefttsl + "px"}, 400);
}
rightButtontsl.click(slidetsl);
leftButtontsl.click(slideBacktsl);

/*touch code from here*/

$(containertsl).on("mousedown touchstart", function(e) {
  
  var startXtsl = e.pageX || e.originalEvent.touches[0].pageX;
  difftsl = 0;

  $(containertsl).on("mousemove touchmove", function(e) {
    
      var xttsl = e.pageX || e.originalEvent.touches[0].pageX;
      difftsl = (xttsl - startXtsl) * 100 / window.innerWidth;
    if( marLefttsl == 0 && difftsl > 10 ) { 
      event.preventDefault() ;
    } else if (  marLefttsl == -maxXtsl && difftsl < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containertsl).on("mouseup touchend", function(e) {
  $(containertsl).off("mousemove touchmove");
  if(  marLefttsl == 0 && difftsl > 4 ) { 
      sliderConttsl.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLefttsl == -maxXtsl  && difftsl < 4 ){
       sliderConttsl.animate({"margin-left" : -maxXtsl  + "px"},100);  
   } else {
      if (difftsl < -10) {
        slidetsl();
      } else if (difftsl > 10) {
        slideBacktsl();
      } 
  }
});

//<!-- END Latest STORIES -->

//<!-- TOP Life Events-->
var rightButtonl = $("#right-btnl");
var leftButtonl = $("#left-btnl");
var containerl = $("#StoryContl");
var slideContl = $("#story-sliderl");
if($("#story-sliderl > div").length<3){
  $('#right-btnl').css('visibility','hidden');
  $('#left-btnl').css('visibility','hidden');
}
var maxcountl=$("#story-sliderl > div").length;
var marLeftl = 0, maxXl = maxcountl*267, diffl = 0 ;

function slidel() {
marLeftl-=284;
if( marLeftl < -maxXl ){ 
  marLeftl = -maxXl+250 ;
}
  slideContl.animate({"margin-left" : marLeftl + "px"}, 500);
}

function slideBackl() {
  marLeftl +=284;
  if ( marLeftl > 0 ) { marLeftl = 0 ;}
  slideContl.animate({"margin-left" : marLeftl + "px"}, 500);
}
rightButtonl.click(slidel);
leftButtonl.click(slideBackl);

/*touch code from here*/

$(containerl).on("mousedown touchstart", function(e) {
  
  var startXl = e.pageX || e.originalEvent.touches[0].pageX;
  diffl = 0;

  $(containerl).on("mousemove touchmove", function(e) {
    
      var xtl = e.pageX || e.originalEvent.touches[0].pageX;
      diffl = (xtl - startXl) * 100 / window.innerWidth;
    if( marLeftl == 0 && diffl > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftl == -maxXl && diffl < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containerl).on("mouseup touchend", function(e) {
  $(containerl).off("mousemove touchmove");
  if(  marLeftl == 0 && diffl > 4 ) { 
      sliderContl.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftl == -maxXl  && diffl < 4 ){
       sliderContl.animate({"margin-left" : -maxXl  + "px"},100);  
   } else {
      if (diffl < -10) {
        slidel();
      } else if (diffl > 10) {
        slideBackl();
      } 
  }
});

//<!-- // Top Life Events-->

//<!-- Latest Life Events-->

var rightButtonll = $("#right-btnll");
var leftButtonll = $("#left-btnll");
var containerll = $("#StoryContll");
var slideContll = $("#story-sliderll");
if($("#story-sliderll > div").length<3){
  $('#right-btnll').css('visibility','hidden');
  $('#left-btnll').css('visibility','hidden');
}
var maxcountll=$("#story-sliderll > div").length;
var marLeftll = 0, maxXll = maxcountll*267, diffll = 0 ;

function slidell() {
marLeftll-=284;
if( marLeftll < -maxXll ){ 
  marLeftll = -maxXll+250 ;
}
  slideContll.animate({"margin-left" : marLeftll + "px"}, 500);
}

function slideBackll() {
  marLeftll +=284;
  if ( marLeftll > 0 ) { marLeftll = 0 ;}
  slideContll.animate({"margin-left" : marLeftll + "px"}, 500);
}
rightButtonll.click(slidell);
leftButtonll.click(slideBackll);

/*touch code from here*/

$(containerll).on("mousedown touchstart", function(e) {
  
  var startXll = e.pageX || e.originalEvent.touches[0].pageX;
  diffll = 0;

  $(containerll).on("mousemove touchmove", function(e) {
    
      var xtll = e.pageX || e.originalEvent.touches[0].pageX;
      diffll = (xtll - startXll) * 100 / window.innerWidth;
    if( marLeftll == 0 && diffll > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftll == -maxXll && diffll < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containerll).on("mouseup touchend", function(e) {
  $(containerll).off("mousemove touchmove");
  if(  marLeftll == 0 && diffll > 4 ) { 
      sliderContll.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftll == -maxXll  && diffll < 4 ){
       sliderContll.animate({"margin-left" : -maxXll  + "px"},100);  
   } else {
      if (diffll < -10) {
        slidell();
      } else if (diffll > 10) {
        slideBackll();
      } 
  }
});

//<!-- //Latest Life Events-->

//<!-- Nano -->

var rightButtonn = $("#right-btnn");
var leftButtonn = $("#left-btnn");
var containern = $("#StoryContn");
var slideContn = $("#story-slidern");
if($("#story-slidern > div").length<4){
  $('#right-btnn').css('visibility','hidden');
  $('#left-btnn').css('visibility','hidden');
}
var maxcountn=$("#story-slidern > div").length;
var marLeftn = 0, maxXn = maxcountn*267, diffn = 0 ;

function sliden() {
marLeftn-=284;
if( marLeftn < -maxXn ){ 
  marLeftn = -maxXn+250 ;
}
  slideContn.animate({"margin-left" : marLeftn + "px"}, 500);
}

function slideBackn() {
  marLeftn +=284;
  if ( marLeftn > 0 ) { marLeftn = 0 ;}
  slideContn.animate({"margin-left" : marLeftn + "px"}, 500);
}
rightButtonn.click(sliden);
leftButtonn.click(slideBackn);

/*touch code from here*/

$(containern).on("mousedown touchstart", function(e) {
  
  var startXn = e.pageX || e.originalEvent.touches[0].pageX;
  diffn = 0;

  $(containern).on("mousemove touchmove", function(e) {
    
      var xtn = e.pageX || e.originalEvent.touches[0].pageX;
      diffn = (xtn - startXn) * 100 / window.innerWidth;
    if( marLeftn == 0 && diffn > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftn == -maxXn && diffn < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containern).on("mouseup touchend", function(e) {
  $(containern).off("mousemove touchmove");
  if(  marLeftn == 0 && diffn > 4 ) { 
      sliderContn.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftn == -maxXn  && diffn < 4 ){
       sliderContn.animate({"margin-left" : -maxXn  + "px"},100);  
   } else {
      if (diffn < -10) {
        sliden();
      } else if (diffn > 10) {
        slideBackn();
      } 
  }
});

//<!-- END NANO STORIES -->

//<!-- Writers -->

    var rightButtonw = $("#right-btnw");
    var leftButtonw = $("#left-btnw");
    var containerw = $("#StoryContw");
    var slideContw = $("#story-sliderw");
    if($("#story-sliderw > div").length<3){
      $('#right-btnw').css('visibility','hidden');
      $('#left-btnw').css('visibility','hidden');
    }
    var maxcountw=$("#story-sliderw > div").length;
    var marLeftw = 0, maxXw = maxcountw*267, diffw = 0 ;
    
    function slidew() {
    marLeftw-=284;
    if( marLeftw < -maxXw ){ 
      marLeftw = -maxXw+250 ;
    }
      slideContw.animate({"margin-left" : marLeftw + "px"}, 500);
    }
    
    function slideBackw() {
      marLeftw +=284;
      if ( marLeftw > 0 ) { marLeftw = 0 ;}
      slideContw.animate({"margin-left" : marLeftw + "px"}, 500);
    }
    rightButtonw.click(slidew);
    leftButtonw.click(slideBackw);
    
    /*touch code from here*/
    
    $(containerw).on("mousedown touchstart", function(e) {
      
      var startXw = e.pageX || e.originalEvent.touches[0].pageX;
      diffw = 0;
    
      $(containerw).on("mousemove touchmove", function(e) {
        
          var xtw = e.pageX || e.originalEvent.touches[0].pageX;
          diffw = (xtw - startXw) * 100 / window.innerWidth;
        if( marLeftw == 0 && diffw > 10 ) { 
          event.preventDefault() ;
        } else if (  marLeftw == -maxXw && diffw < -10 ) {
           event.preventDefault();   
        }
      });
    });
    
    $(containerw).on("mouseup touchend", function(e) {
      $(containerw).off("mousemove touchmove");
      if(  marLeftw == 0 && diffw > 4 ) { 
          sliderContw.animate({"margin-left" :  0 + "px"},100);
       } else if (  marLeftw == -maxXw  && diffw < 4 ){
           sliderContw.animate({"margin-left" : -maxXw  + "px"},100);  
       } else {
          if (diffw < -10) {
            slidew();
          } else if (diffw > 10) {
            slideBackw();
          } 
      }
    });

//<!-- //Writers -->

//<!-- YOUR NETWORKS -->
var rightButtonyn = $("#right-btnyn");
var leftButtonyn = $("#left-btnyn");
var containeryn = $("#StoryContyn");
var slideContyn = $("#story-slideryn");
if($("#story-slideryn > div").length<5){
  $('#right-btnyn').css('visibility','hidden');
  $('#left-btnyn').css('visibility','hidden');
}
var maxcountyn=$("#story-slideryn > div").length;
var marLeftyn = 0, maxXyn = maxcountyn*210, diffyn = 0 ;

function slideyn() {
marLeftyn-=218;
if( marLeftyn < -maxXyn ){ 
  marLeftyn = -maxXyn+183 ;
}
  slideContyn.animate({"margin-left" : marLeftyn + "px"}, 400);
}

function slideBackyn() {
  marLeftyn +=218;
  if ( marLeftyn > 0 ) { marLeftyn = 0 ;}
  slideContyn.animate({"margin-left" : marLeftyn + "px"}, 400);
}
rightButtonyn.click(slideyn);
leftButtonyn.click(slideBackyn);

/*touch code from here*/

$(containeryn).on("mousedown touchstart", function(e) {
  
  var startXyn = e.pageX || e.originalEvent.touches[0].pageX;
  diffyn = 0;

  $(containeryn).on("mousemove touchmove", function(e) {
    
      var xtyn = e.pageX || e.originalEvent.touches[0].pageX;
      diffyn = (xtyn - startXyn) * 100 / window.innerWidth;
    if( marLeftyn == 0 && diffyn > 10 ) { 
      event.preventDefault() ;
    } else if (  marLeftyn == -maxXyn && difftyn < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containeryn).on("mouseup touchend", function(e) {
  $(containeryn).off("mousemove touchmove");
  if(  marLeftyn == 0 && diffyn > 4 ) { 
      sliderContyn.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLeftyn == -maxXyn  && diffyn < 4 ){
       sliderContyn.animate({"margin-left" : -maxXyn  + "px"},100);  
   } else {
      if (diffyn < -10) {
        slideyn();
      } else if (diffyn > 10) {
        slideBackyn();
      } 
  }
});

//<!-- END YOUR NETWORKS -->

//<!-- ADMIN CHoise -->

var rightButtona = $("#right-btna");
var leftButtona = $("#left-btna");
var containera = $("#StoryConta");
var slideConta = $("#story-slidera");

var maxcounta=$("#story-slidera > div").length;
var marLefta = 0, maxXa = maxcounta*210, diffa = 0 ;

function slidea() {
marLefta-=218;
if( marLefta < -maxXa ){ 
  marLefta = -maxXa+183 ;
}
  slideConta.animate({"margin-left" : marLefta + "px"}, 400);
}

function slideBacka() {
  marLefta +=218;
  if ( marLefta > 0 ) { marLefta = 0 ;}
  slideConta.animate({"margin-left" : marLefta + "px"}, 400);
}
rightButtona.click(slidea);
leftButtona.click(slideBacka);

/*touch code from here*/

$(containera).on("mousedown touchstart", function(e) {
  
  var startXa = e.pageX || e.originalEvent.touches[0].pageX;
  diffa = 0;

  $(containera).on("mousemove touchmove", function(e) {
    
      var xta = e.pageX || e.originalEvent.touches[0].pageX;
      diffa = (xta - startXa) * 100 / window.innerWidth;
    if( marLefta == 0 && diffa > 10 ) { 
      event.preventDefault() ;
    } else if (  marLefta == -maxXa && diffta < -10 ) {
       event.preventDefault();   
    }
  });
});

$(containera).on("mouseup touchend", function(e) {
  $(containera).off("mousemove touchmove");
  if(  marLefta == 0 && diffa > 4 ) { 
      sliderConta.animate({"margin-left" :  0 + "px"},100);
   } else if (  marLefta == -maxXa  && diffa < 4 ){
       sliderConta.animate({"margin-left" : -maxXa  + "px"},100);  
   } else {
      if (diffa < -10) {
        slidea();
      } else if (diffa > 10) {
        slideBacka();
      } 
  }
});
//<!-- END Admin choice -->

    function genericSocialShare(url){
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }
    function copylinkshare(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
    }