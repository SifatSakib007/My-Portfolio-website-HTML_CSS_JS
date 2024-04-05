var iSpeed = 40; // time delay of print out
var iScrollAt = 20; // start scrolling up at this many lines

function typewriter(destination, aText) {
    var iIndex = 0; // start printing array at this posision
    var iArrLength = aText[0].length; // the length of the text array
    var iTextPos = 0; // initialise text position
    var sContents = ''; // initialise contents variable
    var iRow; // initialise current row

    function type() {
        sContents = ' ';
        iRow = Math.max(0, iIndex - iScrollAt);

        while (iRow < iIndex) {
            sContents += aText[iRow++] + '<br />';
        }
        destination.innerHTML = sContents + aText[iIndex].substring(0, iTextPos) + "_";
        if (iTextPos++ == iArrLength) {
            iTextPos = 0;
            iIndex++;
            if (iIndex != aText.length) {
                iArrLength = aText[iIndex].length;
                setTimeout(type, 500);
            }
        } else {
            setTimeout(type, iSpeed);
        }
    }

    type();
}

// Intersection Observer
var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
        if (entry.intersectionRatio <= 0) return;

        var target = entry.target;
        var aText = JSON.parse(target.getAttribute('data-text'));
        var destination = target.querySelector('.typedtext');

        typewriter(destination, aText);
    });
}, { threshold: [0] });

// Target elements to watch
var targets = document.querySelectorAll('.input-text');

// Start observing an element
targets.forEach(function (target) {
    observer.observe(target);
});
