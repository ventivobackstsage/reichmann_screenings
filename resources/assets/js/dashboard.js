
var useOnComplete = false,
    useEasing = true,
    useGrouping = true,
    options = {
        useEasing: useEasing, // toggle easing
        useGrouping: useGrouping, // 1,000,000 vs 1000000
        separator: ',', // character to use as a separator
        decimal: '.' // character to use as a decimal
    };

var demo = new CountUp("myTargetElement2", $('#myTargetElement2').data('min'), $('#myTargetElement2').data('max'), 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement3", $('#myTargetElement3').data('min'), $('#myTargetElement3').data('max'), 0, 6, options);
demo.start();
var demo = new CountUp("myTargetElement4", $('#myTargetElement4').data('min'), $('#myTargetElement4').data('max'), 0, 6, options);
demo.start();
$(document).ready(function () {
    var composeHeight = $('#calendar').height() + 21 - $('.adds').height();
    $('.list_of_items').slimScroll({
        color: '#A9B6BC',
        height: composeHeight + 'px',
        size: '5px'
    });
});
