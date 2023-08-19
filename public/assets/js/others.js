$(function() {
    $('.toggle-menu').click(function() {
        $('.exo-menu').addClass('display');
        $("#cross").css("display", "block");
        $("#cross1").css("display", "none");


    });
    $('.toggle-menu-remove').click(function() {


        $('.exo-menu').removeClass('display');
        $("#cross").css("display", "none");
        $("#cross1").css("display", "block");

    });

});



$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }
});

function list() {
    $.get('/product/like', function(res) {
        console.log(res)
        res.forEach(function(cc) {

            $('#cate').append(
                '<a href="' + cc.name + '">' + cc.name + '</a><br>'

            )

        })

    })

}

$('.slider').slick({
    autoplay: true,
    speed: 800,
    lazyLoad: 'progressive',
    arrows: true,
    dots: false,
    prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
    nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
}).slickAnimation();

$('.slick-nav').on('click touch', function(e) {
    e.preventDefault();
    let arrow = $(this);
    if (!arrow.hasClass('animate')) {
        arrow.addClass('animate');
        setTimeout(() => {
            arrow.removeClass('animate');
        }, 1600);
    }

});