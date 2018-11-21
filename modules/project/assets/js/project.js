var audioSrc = ["http://balasuzlek.ru/files/audio/1/9MOhWf78uUuosdD84fXpebq7kJw3tp2B.mp3", "http://balasuzlek.ru/files/audio/1/827-oCjsHejsfYx5RqEelzbIJa4MF9Wp.mp3"];
(function() {
    var audio = [];

    $(document).ready(function() {
        audioSrc.forEach(function(src, i) {
            var aud = new Audio(src);
            aud.load();
            audio[i] = aud;
        });

        $(".card--sound").click(function() {
            if (audio.length > 0) {
                playSound(0);
            }
        });
    });

    function playSound(i) {
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
