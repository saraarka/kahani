<!-- WRITERS, LIFE EVENTS, NANO -->

function carousel2(rgtbtnoo, lftbtnoo, storycontoo, storyslideoo, storyslide) {
    var rightButtonl = $(rgtbtnoo);
    var leftButtonl = $(lftbtnoo);
    var containerl = $(storycontoo);
    var slideContl = $(storyslideoo);
    var maxcountl = document.getElementById(storyslide).childElementCount;
    if(maxcountl < 4) {
        $(rightButtonl).css('visibility','hidden');
        $(leftButtonl).css('visibility','hidden');
    }
    var marLeftl = 0, maxXl = maxcountl*267, diffl = 0;
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
}
carousel2("#right-btnw", "#left-btnw", "#StoryContw", "#story-sliderw", "story-sliderw")
carousel2("#right-btnl", "#left-btnl", "#StoryContl", "#story-sliderl", "story-sliderl")
carousel2("#right-btnll", "#left-btnll", "#StoryContll", "#story-sliderll", "story-sliderll")
carousel2("#right-btnn", "#left-btnn", "#StoryContn", "#story-slidern", "story-slidern")

<!-- // END WRITERS, LIFE EVENTS, NANO-->

<!-- ADMIN CHOICE,STORIES,SERIES -->
function carousel1(rgtbtnoo, lftbtnoo, storycontoo, storyslideoo, storyslide) {
    var rightButtona = $(rgtbtnoo);
    var leftButtona =$(lftbtnoo);
    var containera = $(storycontoo);
    var slideConta = $(storyslideoo);
    var maxcounta = document.getElementById(storyslide).childElementCount;
    if(maxcounta < 5){
        $(rightButtona).css('visibility','hidden');
        $(leftButtona).css('visibility','hidden');
    }
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
}
carousel1("#right-btna", "#left-btna", "#StoryConta", "#story-slidera", "story-slidera")
carousel1("#right-btn", "#left-btn", "#StoryCont", "#story-slider", "story-slider")
carousel1("#right-btnls", "#left-btnls", "#StoryContls", "#story-sliderls", "story-sliderls")
carousel1("#right-btnts", "#left-btnts", "#StoryContts", "#story-sliderts", "story-sliderts")
carousel1("#right-btntsl", "#left-btntsl", "#StoryConttsl", "#story-slidertsl", "story-slidertsl")
carousel1("#right-btnyn", "#left-btnyn", "#StoryContyn", "#story-slideryn", "story-slideryn")
<!-- END Admin choice, series,stories -->

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
    $('#snackbar').text('Link Copied to clipboard...').addClass('show');
    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
}