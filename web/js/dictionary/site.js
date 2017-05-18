var activeBtn;
var audio;
var audioMass = [];

$('.search_but').on('click',function () {
    var del = $(this).attr('data-id');

    $.ajax({
        'data' : {'meaning_id': del},
        'dataType' : 'json',
        'success' : function(data) {

        },
        'type' : 'post',
        'url' : ''
    });
});



$('#canvas').on('click', '.all_play', function(){
    var btnPlay = $(this);
    if (!btnPlay.hasClass('disable')) {
        audioMass = [];
        activeBtn = btnPlay;
        activeBtn.addClass('active');
        $('.all_play').addClass('disable');

        btnPlay.parents('.word').find('.audio-src').each(function(i){
            if ($(this).attr('data-src') != "") {
                var audio = new Audio($(this).attr('data-src'));
                audio.load();
                audioMass[i] = audio;
            }
        });
        if (audioMass.length > 0) {
            playSound(0);
        }
    } else if (btnPlay.hasClass('disable') && !btnPlay.hasClass('active')) {
        audioMass = [];
        audio.pause();
        activeBtn.removeClass('active');
        $('.all_play').removeClass('disable');
        activeBtn = btnPlay;
        activeBtn.addClass('active');
        $('.all_play').addClass('disable');

        btnPlay.parents('.word').find('.audio-src').each(function(i){
            var audio = new Audio($(this).attr('data-src'));
            audio.load();
            audioMass[i] = audio;
        });
        if (audioMass.length > 0) {
            playSound(0);
        }
    }
});

function playSound(num){
    audio = audioMass[num];
    if (audio == undefined) {
        num++;
        if (num < audioMass.length) {
            playSound(num);
        } else {
            activeBtn.removeClass('active');
            $('.all_play').removeClass('disable');
        }
    }
    audio.play();

    audioMass[num].addEventListener('ended',function(){
        num++;
        if (num < audioMass.length) {
            playSound(num);
        } else {
            activeBtn.removeClass('active');
            $('.all_play').removeClass('disable');
        }
    });
}






$body = $('body');
/* Lang animate */
    var $langBtn = $('.mobile-btn'), $langBlock = $('.mobile-block');
    $langBtn.on('click', function() {
        if ( !$langBtn.hasClass('active') ) {
            $langBtn.toggleClass('active');
            $body.css({'overflow': 'hidden'});
            $langBlock.toggleClass('visible').stop().animate({'right': '0'}, {duration: 300});
        } else {
            $langBtn.toggleClass('active');
            $body.css({'overflow': 'visible'});
            $langBlock.toggleClass('visible').stop().animate({'right': '-100%'}, {duration: 300});
        }
    });
    if (window.innerWidth < 581) {
        $('.mobile-block .lang-link a').on('click', function() {
            $body.css({'overflow': 'visible'});
        });
    }
    $(document).on({
        swipeleft: function(e) {
            e.preventDefault();
            console.log('swipe');
            if ( !$langBtn.hasClass('active') && window.innerWidth < 581) {
                $langBtn.click();
            }
        }, swiperight: function(e) {
            e.preventDefault();
            if ( $langBtn.hasClass('active') && window.innerWidth < 581 ) {
                $langBtn.click();
            }
        }
    });
    $(window).resize(function() {
        if (window.innerWidth < 581) {
            $('.mobile-block .lang-link a').on('click', function() {
                $body.css({'overflow': 'visible'});
            });
        } else {
            $body.css({'overflow': 'visible'});
            if ($langBtn && $langBlock) {
                $langBtn.removeClass('active');
                $langBlock.removeClass('visible').css({'right': '-100%'});
            }
        }
    });




        var fixadent = $("#head"), pos = fixadent.offset();
        if (window.innerWidth < 581) {
            $(window).scroll(function() {
              if($(this).scrollTop() > (pos.top)+80 && (fixadent.css('position') == 'fixed' || fixadent.css('position') == 'relative')) {
                fixadent.addClass('fixed mob');
              }
              else if($(this).scrollTop() <= (pos.top)+80 && fixadent.hasClass('fixed')){
                fixadent.removeClass('fixed mob');
              }
            })
        }


        $(window).resize(function(){
            if (window.innerWidth < 581) {
                $(window).scroll(function() {
                    if($(this).scrollTop() > (pos.top)+80 && (fixadent.css('position') == 'fixed' || fixadent.css('position') == 'relative')) {
                      fixadent.addClass('fixed mob');
                    }
                    else if($(this).scrollTop() <= (pos.top)+80 && fixadent.hasClass('fixed')){
                      fixadent.removeClass('fixed mob');
                    }
                })
            }
        });


        $('#canvas').on(
        {
            focus: function() {
                $('.wrap').append('<div class="search-bg"></div>');
            }, blur: function() {
                $('.search-bg').remove();
            }
        }, '.search_form .form-control');
        $('.content-body').ajaxSuccess(function() {
            $('.search-bg').remove();
        });
