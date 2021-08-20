define([
        "jquery",
        "mage/translate"
    ], function ($, $t) {
        "use strict";
        return function (config, element) {
            var countDownDate = new Date(config.releaseDate).getTime();
            var x = setInterval(function () {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                var counterString = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                var fullString = $t('The product will be available after: %1').replace('%1', counterString);

                document.getElementById("counter").innerHTML = fullString;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("counter").innerHTML = "EXPIRED";
                }
            }, 1000);
        }
    }
)
