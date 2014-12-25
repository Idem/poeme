    setInterval(function(){refresh_verse('1');}, 17000);
    setInterval(function(){refresh_verse('2');}, 18000);
    setInterval(function(){refresh_verse('3');}, 19000);
    setInterval(function(){refresh_verse('4');}, 20000);
    setInterval(function(){refresh_verse('5');}, 21000);

    $(window).bind("resize", function(){update_pos();});

    function refresh_verse(id)
    {
        var p = document.getElementById("verse" + id);
        p.src = "verse.php?id=" + id + "&" + Date.parse(new Date());
    }

    function update_pos(){
            var window_width=$(window).width();
            var d = $(".detail");
            d.width(window_width / 2);
            d.css("left", (window_width) / 4);
            var window_height=$(window).height();
            var detail_height=d.height();
            d.css("top", (window_height - detail_height) / 2);
        }
    function toggle_detail(showOrHide){
        if (showOrHide !== false) {
            showOrHide = 250;
        }
        $('#detail').toggle(showOrHide);
        $('#overlay').toggle(showOrHide);
    }
    function full_screen(hide){
        p = $('#verses');
        if (p.hasClass('full_screen') | hide === false){
            p.removeClass('full_screen');
            p.addClass('verses');
        } else {
            p.addClass('full_screen');
            p.removeClass('verses');
        }
    }
    $(document).bind ('keyup.detail', function (k) {
        if (k.keyCode == 27) {
            toggle_detail(false);
            full_screen(false);
        }
    });
    update_pos();
    full_screen();
