// Define variables
var lookupSelector = '#itemName'; // The ID selector to use for the autocomplete function
var lookupInput = $(lookupSelector);

var itemQtyPriceSelectors = '#itemQty, #itemPrice'; // The ID's used for the Price and Qty binding for updating price
var filePath;

/*
 First, set the path to fetch items from database
 Initialize the lookup for the first input on the page
 */
mioInvoice.setPathValue('/invoice/inventory');
mioInvoice.fetchItems(lookupInput);

/*
 Create an Array to for adding row in table. You'll want to make sure you have the same number of columns
 You will also want to make sure that your inputs match what's in the html current row.
 Also, be sure you have the correct id's for each input.
 */
var rowTemp = [
    '<tr class="item-row">',
    '<td><i id="deleteRow" class="fa fa-times"></i></td>',
    '<td><input id="itemId" name="itemId[]" type="hidden" value="" />' + // Hidden value to post to DB
    '<input id="itemName" required="required" name="itemName[]" type="text" class="form-control input-sm" value="" /> </td>',
    '<td><input id="itemDesc" name="itemDesc[]" type="text" class="form-control input-sm" value="" readonly="readonly" /></td>',
    '<td><input id="itemQty" required="required" name="itemQty[]" type="text" class="form-control input-sm" value="" /></td>',
    '<td><div class="input-group"><span class="input-group-addon">$</span>' +
    '<input id="itemPrice" required="required" name="itemPrice[]" class="form-control input-sm" type="text"></div></td>',
    '<td><div class="input-group"><span class="input-group-addon">$</span>' +
    '<input id="itemLineTotal" name="itemLineTotal[]" class="form-control input-sm" type="text" readonly="readonly"></div></td>',
    '</tr>'
].join('');

/*
 We are overriding the autocomplete UI menu styles to create our own.
 You can add information from the returned json array as needed
 Just be sure that your array contains the correct value when returned
 You'll want to modify the ajax-services/fetch-inventory.php file for the returned values
 */
$.ui.autocomplete.prototype._renderItem = function (ul, item) {
    return $("<li></li>")
        .data("item.autocomplete", item)

        // This is the autocomplete list that is generated
        .append("<a class='additionalInfo'>" + item.itemName + " - " + item.itemDesc + " " +

            // This is the hover box that is generated when you hover over an item in the list
        "<span class='additionalInfoColor'>" +
        "<div><h4>Item Information</h4></div>" +
        "<div><strong>Item Code:</strong> " + item.itemName + "</div>" +
        "<div><strong>Qty on Hand:</strong> " + item.qtyOnHand + "</div>" +
        "<div><strong>Price:</strong> $" + item.itemPrice + "</div>" +
        "</span> </a>")

        .appendTo(ul);
};

/*
 Here's where we start adding rows to the invoice
 Add row to list and allow user to use autocomplete to find items.
 */
$(document).ready(function(){
    //mioInvoice.addRow(lookupSelector);
});
$("#addRowBtn").on('click', function (e) {
    mioInvoice.addRow(lookupSelector);
    e.preventDefault();

});

/*
 Update invoice total when item Qty or Price inputs have been updated
 */
$(itemQtyPriceSelectors).on('keyup', function () {
    mioInvoice.updatePrice(this);
});

/*
 Update invoice total when invoice tax input has changed
 */
$("input#tax").on('keyup', function () {
    mioInvoice.updateTotal();
});


/*
 Remove row when clicked
 */
$(document).on('click', '#deleteRow', function () {
    mioInvoice.deleteRow(this);
});

$('#saveInvoiceBtn').on('click', function (e) {

    $(window).unbind("beforeunload");


    /*  Use this to save the post data to the database using ajax */

//    var postData = $("#invoiceForm").serialize();
//
//    alert(postData);
//
//    $.post("ajax-services/post-data.php", { data: postData })
//        .done(function (data) {
//            alert("Post Data: " + data);
//        });
//
//    e.preventDefault();

});

/*
 We don't want the user to leave the page if they have started working with it so we set the
 onbeforeload method
 */
$('body').on("focus", lookupSelector, function () {
    $(window).bind('beforeunload', function () {
        return "You haven't saved your data.  Are you sure you want to leave this page without saving first?";
    });
});


/*
 Helpers
 */

var deleteConfirm = function (msg) {
    var a = confirm(msg);
    return !!a;
};


// Show loader when PDF is being generated.
$(document).on("click", '#genPDFbtn', function () {
    $("#loader").show();
});

/*
 Destroy the modal content ** WE NEED THIS ** This prevents the modal from having the same information
 loaded when opening it when separate information.
 */
$(document.body).on('hidden.bs.modal', function () {
    $('#myModal').removeData('bs.modal')
});


/*

 Allow for inline editing

 */

/*
 This saves the values to the hidden input for the inout we are modifying.
 */
$(document).on("keyup", 'input.editbox', function () {
    // Get the value for the selected input on every key up
    var thisValue = $(this, 'input').val();
    var selectedName = $(this, 'input').attr('id');
    $("input[name="+selectedName+"]").val(thisValue);
});


function divClicked() {
    var divHtml = $(this).html();
    var selectName = $(this).attr("id");
    var editableText = $('<input id="'+selectName+'" class="form-control input-sm editbox" type="text">');
    editableText.val(divHtml);
    $(this).replaceWith(editableText);
    editableText.focus();

    // setup the blur event for this new input area
    editableText.blur(function(){
        var html = $(this).val();
        var viewableText = $('<div class="edit" id="'+selectName+'">');
        viewableText.html(html);
        $(this).replaceWith(viewableText);
        // setup the click event for this new div
        viewableText.click(divClicked);
    });
}


$(document).ready(function () {
    $("div.edit").click(divClicked);

    $('.invoice-nav').click(function (e) {

        $.ajax({
            url: "/newInvoice",
            context: document.body
        }).done(function (fragment) {
            $(".invoice-panel").html(fragment);
        });

    });
});