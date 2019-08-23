jQuery.fn.jQueryEqualHeight = function(innerDiv) {
    if (innerDiv == undefined) {
        innerDiv = '.card';
    }
    var currentTallest = 0, currentRowStart = 0, rowDivs = new Array(), topPosition = 0;
    jQuery(this).each(function() {
        jQuery(this).find(innerDiv).height('auto')
        topPosition = jQuery(this).position().top;
        if (currentRowStart != topPosition) {
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].find(innerDiv).height(currentTallest);
            }
            rowDivs.length = 0;
            currentRowStart = topPosition;
            currentTallest = jQuery(this).find(innerDiv).height();
            rowDivs.push(jQuery(this));
        } else {
            rowDivs.push(jQuery(this));
            currentTallest = (currentTallest < jQuery(this).find(innerDiv).height()) ? (jQuery(this).find(innerDiv).height()) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].find(innerDiv).height(currentTallest);
        }
    });
};