/* STATUS CONSTANTS */
var KSTATUS_SUCCESS = "success";
var KSTATUS_ERROR = "error";
var KSTATUS_WARNING = "warning";
var KSTATUS_INFO = "info";

$(document).ready(function() {
    /* TOASTR INIT SETTINGS */
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
});

function showToast(type, title, message) {
    toastr[type](message, title);
}

function postForm(url, form, btn = false, btnValue = false, callback) {
    let fd = new FormData();
    if (btn) {
        disableBtn(btn);
    }

    if ($('input[type="file"]')) {
        //check if form has file in it.
        //  // for multiple files
        let length = $('input[type="file"]').length;
        for (let i = 0; i < length; i++) {
            if ($('input[type="file"]')[i]) {
                let uploadedFiles = $('input[type="file"]')[i];
                let file_data = uploadedFiles.files;
                for (let j = 0; j < file_data.length; j++) {
                    fd.append(uploadedFiles.name, file_data[j]);
                }
            }
        }
    }
    let other_data = $(form).serializeArray();
    $.each(other_data, function(key, input) {
        fd.append(input.name, input.value);
    });

    $.ajax({
        type: "POST",
        url: url,
        data: fd,
        processData: false,
        contentType: false,
        error: function(xhr, textStatus, errorThrown) {
            showToast(
                KSTATUS_ERROR,
                "Unable to connect.",
                "Unable to connect to the server :("
            );
            if (btn) {
                enableBtn(btn, btnValue);
            }
        },
        success: function(data, status) {
            if (btn) {
                enableBtn(btn, btnValue);
            }
            callback(data, status);
        },
    });
}

function postRequest(data, btn = false, callback) {
    if (btn) {
        disableBtn(btn);
    }

    $.ajax({
        type: "POST",
        url: data.url,
        data: data.params,
        error: function(xhr, textStatus, errorThrown) {
            showToast(
                KSTATUS_ERROR,
                "Unable to connect.",
                "Unable to connect to the server :("
            );
            if (btn) {
                enableBtn(btn);
            }
        },
        success: function(data, status) {
            if (btn) {
                enableBtn(btn);
            }
            callback(data, status);
        },
    });
}

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

function setDataTables(id) {
    $(document).ready(function() {
        $(id).DataTable({
            rowReorder: {
                selector: "td:nth-child(2)",
            },
            responsive: true,
            paging: true,
            info: false,
            searching: true,
            columnDefs: [{
                orderable: false,
                targets: "no-sort",
            }, ],
            order: [],
        });
    });
}

function disableBtn(btn) {
    btn.prop("disabled", true);
    btn.val("Wait..");
}

function enableBtn(btn, text = false) {
    btn.prop("disabled", false);
    if (text) {
        btn.val(text);
    }
}


/*
 * Indian Money Format
 */

function formatMoney(money) {
    money = money.toString();
    let afterPoint = "";
    if (money.indexOf(".") > 0)
        afterPoint = money.substring(money.indexOf("."), money.length);
    money = Math.floor(money);
    money = money.toString();
    let lastThree = money.substring(money.length - 3);
    let otherNumbers = money.substring(0, money.length - 3);
    if (otherNumbers !== "") lastThree = "," + lastThree;
    return (
        otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint
    );
}

// Get current date
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

String.prototype.toWord = (function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
})

$('.input-number').on('keypress', function(e) {
    return e.metaKey || // cmd/ctrl
        e.which <= 0 || // arrow keys
        e.which == 8 || // delete key
        /[0-9.]/.test(String.fromCharCode(e.which)); // numbers
})