function addcart() {
    let data1 = {};
    data1['product_id'] = $('#productId').val();
    data1['color'] = $('input[name="color"]:checked').val()
    data1['size'] = $('input[name="size"]:checked').val()
    data1['name'] = $('#productname').text()
    data1['price'] = $('#final_price b').text()

    if ($('input[name="color"]:checked').length > 0 && $('input[name="size"]:checked').length > 0) {
        // let final_data = JSON.stringify(data1)

        $.ajax({
            url: '/add/to/cart',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                cache: false

            },
            data: data1, // pass in json format 
        }).done(function(rs) {
            var cnts = parseInt($('#count_dtl').text());
            cnts = cnts + 1;
            $('#count_dtl').text(cnts)
            $('#cart_model').modal('hide')

            /* console.log('response', rs) */
        });
        //fin ajax 
    } else {
        console.log('please check feild')
    }
}

function wishlist() {
    $(".button").click(function() {
        $(this).toggleClass("animate");
        $(this).toggleClass("active");
        console.log('found');
    }).done(function(rs) {
        var wish = parseInt($('#wish_count').text());
        wish = wish + 1;
        $('$wish_count').text(wish);
    });
}


function productmodal(id) {
    $.ajax({
        url: '/product/modal/' + id,
        method: 'GET',

        success: function(response) {
            console.log(response)
        }

    });
}

//Increse Value From Cart
function addvalue(jqid, price) {
    var value = parseInt(document.getElementById(jqid).value);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById(jqid).value = value;
    var tp = price * value;
    //price=tp;
    $('#price' + jqid).text(tp)
    checkTotal()

    if (tp == 0) {
        this.tp = 0
    }

}
//decrese Value from Cart
function decresevalue(jqid, price) {
    var value = parseInt(document.getElementById(jqid).value);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    document.getElementById(jqid).value = value;
    checkTotal()
    var tp = price * value;
    $('#price' + jqid).text(tp)
    if (tp == 0) {
        this.tp = 0
    }
}



//Delete Item From Cart
function deletecartitem(cartid, cnts) {
    console.log('my delete id', cartid)
    $.get('remove-from-cart/' + cartid, function(res) {
        if (res.sts == 'deleted') {
            $('#deleteid' + cartid).remove();
            var cnts = parseInt($('#count_dtl').text());
            cnts = cnts - 1;
            $('#count_dtl').text(cnts)
        }
    })



}

function closemodal() {
    $('#checkout_model').modal('hide')
}

//Homepage AddTocart Modal 
function model_open(pid) {
    $.get('/product/modal/' + pid, (data) => {
        console.log(data)
        if (data.sts == true) {
            $('#productId').val(data.details.id)
                /*  $('#productColor').val(data.colors.id) */
            $('#productname').text(data.details.title)
            $('#mdl_desc').text(data.details.description)
            $('#productsummary').text(data.details.summary)
            $('#photo').text(data.details.photo)
            $('#size_name').empty()
            $.each(data.size, function(key, val) {
                $('#size_name').append('<input name="size" ' + '" type="radio" value="' + val.id + '">' + '<label >' + ' &nbsp; ' + val.name + ' &nbsp; ' + '</label>')
            })

            $('#color_name').empty()
            console.log(data.colors)
            $.each(data.colors, function(key, val) {
                if (val.name == 'White' || val.name == 'white') {

                    $('#color_name').append('<input name="color" ' + '" type="radio" value="' + val.id + '">' + '<label for="' + val.name + '" style="color:#adb5bd"> &nbsp; ' + val.name + ' &nbsp; </label>')
                        /*  $('#color_name').append('<p class="colorbox text-dark col-3" style="background-color:' + val.name + '">' + val.name + '</p>') */

                } else {

                    $('#color_name').append('<input name="color" ' + '" type="radio" value="' + val.id + '">' + '<label for="' + val.name + '  "style="color:' + val.name + '"> &nbsp; ' + val.name + ' &nbsp; </label>')
                }

            })
            if (data.details.discount != 0) {
                $('#final_price').empty()
                let final = parseInt(data.details.price) - (parseInt(data.details.price) * parseInt(data.details.discount) / 100)
                $('#discount_price_mdl').text(data.details.discount + '  %OFF')

                $('#final_price').append('<h5 class="col-12"> Price: <del class="col-6 text-muted">' + data.details.price + '</del> <b class="col-6">' + final + '</b>') + '</h5>'
            } else {
                $('#final_price').empty()
                $('#final_price').append('<span class="col-6">' + data.details.price + '</span>')
            }

            $('#price_mdl').val(data.details.price)

            $('#cart_model').modal('show')

        } else {

            $('#cart_model').modal('show')
        }
    })
}


//Close Modal
function closecartmodal() {
    $('#cart_model').modal('hide')
}

function readmore_modal() {
    $('#readmore').modal('show')
}



//Total_Sum
function totalsum() {

    var sum = 0;

    $('.tlprice').each(function() {
        sum += parseInt($(this).text());
    });
    $('#total').text(sum)
}

//Total Checkout
let checkout_data;

function checkTotal() {
    let data = [];
    let pid = '';
    $(".checkbox_cls:checked").each(function() {
        var pid = $(this).val()
        var pname = $('#productname' + pid).text()
        var amnt = $('#' + pid).val()
        var pcolor = $('#color' + pid).text()
        var psize = $('#size' + pid).text()

        tlamt = $('#price' + pid).text()
        if (data.includes(pid) == false) {
            data.push({ 'cid': pid, 'amt': amnt, 'tlamnt': tlamt, 'name': pname, 'Size': psize, 'Color': pcolor })
        }
        checkout_data = data;

    });
    window.localStorage.setItem('cart-data', JSON.stringify(checkout_data));
    let sum = 0;

    for (let i = 0; i < data.length; i++) {
        sum += parseInt(data[i]['tlamnt'])
    }
    console.log(data, sum, pid)
    $('#total').text(sum)
}


function mdd() {

    $('#checkout_model').modal('hide')
}

/* Checkout From Cart */
function checkout(e) {
    $.get("/logincheck", function(data) {
        console.log('logindata', checkout_data)
        if (data.sts == 'yes') {
            var cart_check_final = $('#total').text();
            $("body").removeClass("right-bar-enabled")
            model_check_data = JSON.parse(window.localStorage.getItem('cart-item'));
            $('#model_cart').empty()
            $.each(checkout_data, function(k, val) {

                $('#model_cart').append(
                    '<li class="list-group-item d-flex justify-content-between lh-condensed"><div class="row m-0"><span class="my-0 col-6  float-start p-0"> Name : ' + val['name'] + '(' + (val['amt']) + ')' + '</span>' +
                    '<span class="my-0 col-6  float-end p-0">Price : ' + '$' + val['tlamnt'] + '</span>' +
                    '<small class="col-6 float-start text-uppercase p-0"> Size : ' + val['Size'] +
                    ' </small><small class="col-6 p-0 text-uppercase  p-0 "> Color : ' + val['Color'] +
                    '</small>' + '<hr class="w-75">' + '</div>' + '</li>');
            })

            $('#model_cart').append(
                '<li class="list-group-item lh-condensed"><p class="text-end  text-uppercase text-danger">Total price : $' + cart_check_final + '</p></li>');
            $('#checkout_model').modal('show')
            e.preventDefault();

        } else {
            window.location.href = '/login'
        }

    });

    window.addEventListener('load', function() {
        console.log('All assets are loaded')
    })

}


//Shipping Customer Order
function orderplace(e) {
    let data2 = {};
    var data = window.localStorage.getItem("cart-data");
    parse_item = JSON.parse(data)
    data2['First_name'] = $('#customer_name').val();
    data2['contact'] = $('#mobile').val();
    data2['address'] = $('#address').val();
    data2['quantity'] = $('#quantity').val();
    data2['country'] = $('#country').val();
    data2['state'] = $('#state').val();
    data2['zip_code'] = $('#zip_code').val();
    data2['check_data'] = parse_item
    if ($(this).parent().find('input').is(':checked')) {
        something();
    }
    var total_price = 0;
    if (Object.keys(parse_item).length != 0) {
        Object.keys(parse_item).forEach(function(k) {
            total_price = total_price + parseInt(parse_item[k]['tlamnt']);

        });
        data2['total_price'] = total_price
    } else {
        data2['total_price'] = 0;
    }

    // data2['transaction_type'] = $('#transaction').text();

    console.log(['here ', data2])

    $.ajax({
        url: '/users/order/product',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data2, // pass in json format 
    }).done(function(rs) {
        console.log(rs.sts, 'response status');
        /*  console.log(this.rs, "this is reaponse") */
        if (rs.sts == true) {
            /*  $('#cart_model').modal('hide') */
            $('#checkout_model').modal('hide');
            console.log(rs.sts, 'Successfully Shipped');

        } else {
            console.log('Shipping Request is Not Successfully');

        }
    });
    window.location.href = '/users/order/list';
}



function like(id) {
    $.get('/like/' + id, function(res) {

        if (res.sts === true) {
            console.log('Like', res)
            var value = parseInt($('#like' + id).text()) + 1;
            $('#like' + id).text(value)
        }

    })
}

function dislike(id) {
    $.get('/dislike/' + id, function(res) {
        if (res.sts === true) {
            console.log('Dislike', res)
            var newval = parseInt($('#dislike' + id).text()) + 1;
            $('#dislike' + id).text(newval)
        }
    })
}


//Clear Cart
function CartClear() {
    $(".clear-cart").click(function() {
        $(this).parent().remove();
        console.log(this);
    });
}


/* Add To Cart Icon Start */
// ************************************************
// Shopping Cart API
// ************************************************
// =============================
// Public methods and propeties
// =============================
$(document).ready(function() {
    //create variable



    var counts = parseInt($('.count_prod').length);

    $('#count_dtl').text(counts)
    $(".addtocart").click(function() {
        $('#count_dtl').text(counts);
        //to number and increase to 1 on each click
        counts += 1;
        $(".cart-counter").animate({
            //show span with number
            opacity: 1
        }, 300, function() {
            //write number of counts into span
            $('#count_dtl').text(counts);
        });
    });
});

/* Add To Cart Icon End */
function catemodal() {
    $('#category_modal').modal('show')
    console.log('category_Update');
}


/* Adding cart refresh function */
function cartrefresh() {
    $("#clicktorefresh").load(location.href + " #clicktorefresh");
    console.log("clicked and reloaded clicktorefresh");
}