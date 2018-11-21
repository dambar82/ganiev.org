(function() {
    var audio = [],
        img;

    $(document).ready(function() {
        audioSrc.forEach(function(src, i) {
            var aud = new Audio(src);
            aud.load();
            audio[i] = aud;
        });

        img = $(".card--img");

        $(".card--sound").click(function() {
            if (audio.length > 0) {
                playSound(0);
            }
        });
    });

    function playSound(i) {
        if (i == 0) {
            img.addClass("xsize");
        }

        if (audio[i] == undefined) {
            i++;
            if (i < audio.length) {
                playSound(i);
            }
            return;
        }
        audio[i].addEventListener("ended", function() {
            i++;
            if (i < audio.length) {
                playSound(i);
            }
        });
        audio[i].play();

        return;
    }
})();
