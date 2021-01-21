jQuery.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Only alphabetical characters");



jQuery.validator.addMethod("filesize_max", function (value, element, param) {
    var isOptional = this.optional(element),
        file;

    if (isOptional) {
        return isOptional;
    }

    if ($(element).attr("type") === "file") {

        if (element.files && element.files.length) {

            file = element.files[0];

            if (file.size && file.size <= param) {

                var reader = new FileReader();
                reader.onload = function (e) {

                    //$('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                return true;
            }

        }
    }
    return false;
}, "Maximum allowed file size is 500kb");



$.validator.setDefaults({
    submitHandler: function (form, event) {
        event.preventDefault();

        $.ajax({
            url: "php/",
            type: "POST",
            data: new FormData(form),
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend: function () { $('#' + form.id).find("button[type='submit']").next('p').remove(); $('#' + form.id).find("button[type='submit']").addClass('fa fa-spinner disabled'); },
            complete: function () { $('#' + form.id).find("button[type='submit']").removeClass('fa fa-spinner disabled'); },
            success: function (data, textStatus, jqXHR) {
                $('#' + form.id).find("button[type='submit']").after('<p>' + data.msg + '</p>');

                if (data.code == 1) {
                    $(':input', '#' + form.id).not(':button, :submit, :reset, :hidden, :radio').val('').removeAttr('checked').removeAttr('selected');

                    if (form.id == 'loginfrm')
                        window.location.href = data.redirect_to;

                }


                setTimeout(function () { $('#' + form.id).find("button[type='submit']").next('p').remove(); }, 20000);





            },
            error: function (jqXHR, exception) {
                $('#' + form.id).find("button[type='submit']").after('<p>' + exception + '</p>');


            }
        });


        return false;
    },


    invalidHandler: function (form, validator) {

        if (!validator.numberOfInvalids())
            return;

        $('html, body').animate({
            scrollTop: $(validator.errorList[0].element).offset().top - 50
        }, 1000);

    }
});

$().ready(function () {


    $("#loginfrm").validate({
        focusInvalid: false,
        rules: {
            uname:
            {
                required: true

            },

            psw: {
                required: true


            },
            email: {
                required: true,
                email: true
            },


            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },

            address_1: {
                required: true,
                maxlength: 2000

            },
            address_2: {
                required: true,
                maxlength: 2000

            },
            city: {
                required: true,
                maxlength: 200

            },
            state: {
                required: true
            },
            pin_code: {
                required: true
            },
            logo: {
                required: true,
                accept: "image/jpeg,image/png",
                extension: "jpg|jpeg|png",
                filesize_max: '500000'
            },
            image: {
                required: true,
                accept: "image/jpeg,image/png",
                extension: "jpg|jpeg|png",
                filesize_max: '500000'
            },
            project: {
                required: true
            }

        },
        messages: {
            txtfname: {
                required: "Please enter your name",

            },

            txtemail: {
                required: "Please enter your email",
                email: "Please enter a valid email"

            },

            txtmn: {
                required: "Please enter your mobile no",
                digits: "Please enter only digits",
                minlength: "Please  enter the valid mobile number",
                maxlength: "Please  enter the valid mobile number"

            },

            txtmsg: {
                required: "Please enter your message",

            }


        }
    });


});

