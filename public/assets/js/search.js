document.querySelector("#basicToastBtn").onclick = function() {
        new bootstrap.Toast(document.querySelector('#basicToast')).show();
    }
    //Start pagination For HomePage
$(document).ready(function() {
        size_li = loadMoreSetup();
        x = 8;
        $('#productList .checkPrice').hide();

        $('#productList .checkPrice:lt(' + x + ')').show();


        $('#loadMore').click(function() {
            x = (x + 8 <= size_li) ? x + 8 : size_li;
            var datas = $('#productList .checkPrice:lt(' + x + ')').show();
            console.log('dts', datas)

        });
        $('#showLess').click(function() {
            if (x != 8) {
                x = (x - 8 < 0) ? 8 : x - 8;
                $('#productList .checkPrice').not(':lt(' + x + ')').hide();
            }
        });
    })
    //End pagination For HomePage

function loadMoreSetup() {
    let size = $('#productList').children().length;
    return size;
}


$(".button").click(function() {
    $(this).toggleClass("animate");
    $(this).toggleClass("active");
});



//Filter in Price Range
function showProducts(minPrice, maxPrice) {
    $("#productList .checkPrice").hide().filter(function() {
        var price = parseInt($(this).data("price"), 10);

        return price >= minPrice && price <= maxPrice;
    }).show();
}

//Filetr in Price Range With Name
function shouProductByName(name) {
    $("#productList .checkPrice").hide().filter(function() {
        nm = $(this).data("name");
        //let final=nm.match('/['+name+']/')  
        data = nm.includes(name)
        if (data == true) {
            return nm;
        }
        //return price >= minPrice && price <= maxPrice;
    }).show();
}


var prices = $('#productList .checkPrice').map(function() {
    return $(this).data('price');
}).get();
var names = $('#productList .checkPrice').map(function() {
    let nm = $(this).data('name');
    return nm
}).get();

$('input[name=textSearch]').on('keyup', function() {
    let name = $('#textSearch').val()
    console.log(name);
    shouProductByName(name);
});

//price range on change value change
$('.mall-slider-handles').each(function() {
    var el = this;
    noUiSlider.create(el, {
        start: [el.dataset.start, el.dataset.end],
        connect: true,
        tooltips: true,
        range: {
            min: [parseFloat(el.dataset.min)],
            max: [parseFloat(el.dataset.max)]
        },
        pips: {
            mode: 'range',
            density: 20
        }
    }).on('change', function(values) {

        showProducts(values[0], values[1]);
    });
})