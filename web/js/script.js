$.fn.MovePlugin = function () {
    $(this)
        .mouseover(function () {

            $(this).on("mousemove", function (event) {
                let element = this
                if ($('.move-mouse.move').length > 0) return false;
                $(element).addClass('move')
                if (!$(element).hasClass('move') ) return false;
                move(element);
            });

        })

    function move(element){
        $(document).on("mousemove", function (event) {
            if (!$(element).hasClass('move')) return false;
            let x = event.pageX,
                y = event.pageY
            $(element).css({
                'position': 'fixed',
                'left': x,
                'top': y
            })
        }).on('click', function () {
            $(element).removeClass('move')
        })
    }

}

$('.move-mouse').MovePlugin();