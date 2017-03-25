$(document).ready(function () {
    $('.btn-data').click(function (e) {
        // e.preventDefault();
        // if (confirm('Please save your progress before adding new data')) {
        //
        // }
        var modal = $(this).attr('id');
        $(modal).modal('show');

    });

    // Toggle Function
    $('.toggle').click(function () {
        // Switches the Icon
        $(this).children('i').toggleClass('fa-pencil');
        // Switches the forms
        $('.form').animate({
            height: "toggle",
            'padding-top': 'toggle',
            'padding-bottom': 'toggle',
            opacity: "toggle"
        }, "slow");
    });
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover().on('show.bs.popover', function () {
        if (window.activePopover) {
            $(window.activePopover).popover('hide')
        }
        window.activePopover = this;
    })
        .on('hide.bs.popover', function () {
            window.activePopover = null;
        });

    //deleting alert
    $('.delete').click(function(e){
        var loc =$(this).attr('href');
        swal({
            title:'Deleting...',
            text:'Are you sure?',
            type:'warning',
            showCancelButton:true,
            confirmButtonColor:'#DD6B55',
            confirmButtonText:'Yes, Do it!',
            closeOnConfirm:false,
            allowOutsideClick:false
        },function(){
            swal('Delete action successful');
            if(loc !=undefined)
                window.location.href=loc;
        });
        e.preventDefault();
    });

    // show active tab on reload
    if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');

    // remember the hash in the URL without jumping
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        if (history.pushState) {
            history.pushState(null, null, '#' + $(e.target).attr('href').substr(1));
            $('.cv-edit-form').find('input[name=curPage]').val(location.hash);
        } else {
            location.hash = '#' + $(e.target).attr('href').substr(1);
            $('.cv-edit-form').find('input[name=curPage]').val(location.hash);
        }
    });

    $('.nav-item').on('click', function (e) {
        //store hash
        var target = this.hash;
        // e.preventDefault();
        $('body').scrollTo(target, 800, {offset: -70, 'axis': 'y'});
    });

    $('input[type=text],input[type=time],input[type=date],input[type=password],input[type=email],textarea,select').addClass('form-control');

    //format currency inputs
    $('.amount').on('blur', function () {
        var cur = $(this).val();
        var am = numeral(cur).format('0.00');
        $(this).val(am);
    });


});
/**
 * validates currency
 * @param amount
 * @returns {boolean}
 */
function validCurrency() {
    var amount = $('input[name=amount]').val();

    var regex = /^\d+(?:\.\d{0,2})$/;
    if (regex.test(amount)) {//curreny is ok
        if (amount == '0.00') {
            alert('Amount entered must be greater than zero');
            return false;
        }
        return true;
    } else {
        alert('Amount entered is invalid');
        return false;
    }
}