/*!Main Css v1.54 by @Prem */

var owl = $('#feature')
owl.owlCarousel({
    margin: 20,
    dots: true,
    nav: true,
    loop: true,
    responsive: {
        0: {
            dots: true,
            items: 1
        },
        600: {
            dots: true,
            items: 3
        },
        1000: {
            dots: true,
            items: 3
        }
    }
})

var owl1 = $('.feature-main .owl-carousel')
owl1.owlCarousel({
    margin: 20,
    dots: true,
    loop: true,
    center: true,
    responsive: {
        0: {
            dots: true,
            items: 1
        },
        600: {
            dots: true,
            items: 3
        }
    }
})

// header
$(window).scroll(function() {
    var scroll = $(window).scrollTop()

    if (scroll >= 300) {
        $('header').addClass('darkHeader')
    } else {
        $('header').removeClass('darkHeader')
    }
})

$(window).scroll(function() {
    var scrollDeep = $(window).scrollTop()

    if (scrollDeep >= 500) {
        $('header').addClass('darkHeader-2')
    } else {
        $('header').removeClass('darkHeader-2')
    }
})

var owl = $('#FrameWork')
owl.owlCarousel({
    margin: 20,
    dots: true,
    nav: false,
    loop: false,
    responsive: {
        0: {
            dots: true,
            items: 2
        },
        600: {
            dots: true,
            items: 3
        },
        // 1400: {
        //     dots: true,
        //     items: 4
        // }
    }
})

// Initiate the wowjs animation library

new WOW().init()

// Adding css class for rowspan in table contents
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.article__main-content')
    if(container) {
        const nodes = container.querySelectorAll('table td[rowspan]:first-of-type')

        if(nodes && nodes.length > 1) {
            nodes.forEach((node, index) => {
                if ((index + 1) % 2 === 0) {
                    node.classList.add('hasBg')
                }
            })
        }
    }
})

