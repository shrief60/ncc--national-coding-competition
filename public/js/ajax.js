/** Serialize Form as JSON */
(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        if (o.hasOwnProperty('_token')) {
            let token = o['_token'];
            if (Array.isArray(token)) {
                o['_token'] = token[0];
            }
        }
        return o;
    };
})(jQuery);
/** Serialize Form as JSON */


/** Animate CSS */
(function ($) {
    $.fn.extend({
        animateCss: function (animationName, callback) {
            var animationEnd = (function (el) {
                var animations = {
                    animation: 'animationend',
                    OAnimation: 'oAnimationEnd',
                    MozAnimation: 'mozAnimationEnd',
                    WebkitAnimation: 'webkitAnimationEnd',
                };

                for (var t in animations) {
                    if (el.style[t] !== undefined) {
                        return animations[t];
                    }
                }
            })(document.createElement('div'));

            this.addClass('animated ' + animationName).one(animationEnd, function () {
                $(this).removeClass('animated ' + animationName);

                if (typeof callback === 'function') callback();
            });

            return this;
        },
    });
})(jQuery);
/** Animate CSS */

const convertImgToSvg = img => {
    // Perf tip: Cache the image as jQuery object so that we don't use the selector muliple times.
    var $img = jQuery(img);
    // Get all the attributes.
    var attributes = $img.prop("attributes");
    // Get the image's URL.
    var imgURL = $img.attr("src");
    // Fire an AJAX GET request to the URL.
    $.get(imgURL, function (data) {
        // The data you get includes the document type definition, which we don't need.
        // We are only interested in the <svg> tag inside that.
        var $svg = $(data).find('svg');
        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');
        // Loop through original image's attributes and apply on SVG
        $.each(attributes, function () {
            $svg.attr(img.name, img.value);
        });
        // Replace image with new SVG
        $img.replaceWith($svg);
    });
}

function CSRFToken() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function displayErrors(errors) {

    for (const error in errors) {

        let id = `error-${error}`;

        if (exists('#' + id)) continue;

        let input = $(`[name="${error}"]`);

        let type = input.attr('type');

        if (type === 'hidden' && !input.hasClass('show')) continue;

        let small = `<small class='feedback' id="${id}" style="color: #ec250d"> ${errors[error]} </small>`;

        if (type === 'checkbox' || type === 'radio') {

            let parent = $(`[parent=${error}]`) || input.parents('.form-group');;

            parent.append(small);
        } else if (input.parent().hasClass('input-group')) {

            input.parent().after(small);

        } else if (input.next().hasClass('note-editor')) {

            input.next('.note-editor').after(small);
        } else {

            input.after(small);
        }

        input.addClass('form-control-danger');
        input.closest('.form-group').addClass('has-danger');

    }
}

$('form.file-ajax').submit(function (e) {

    e.preventDefault();

    submitFileForm(this);
});

$('form.ajax').submit(function (e) {

    e.preventDefault();

    submitForm($(this));
});

$('input, textarea').attr('autocomplete', 'off');

$(document).on('keyup', 'input, textarea', function () {

    let name = $(this).attr('name');

    $(this).removeClass('form-control-danger');
    $(this).closest('.form-group').removeClass('has-danger');

    if (name === undefined || name.includes('[]')) return;

    let error = `#error-${name}`;

    $(error).remove();
});

$(document).on('change', 'select, input[type=radio], input[type=checkbox]', function () {

    let name = $(this).attr('name');

    if (name === undefined || name.includes('[]')) return;

    $(`#error-${name}`).remove();

    $(this).removeClass('form-control-danger');
    $(this).closest('.form-group').removeClass('has-danger');
});

let currentForm;

const submitForm = function (form, successCallback = defaultSuccess, errorCallback = defaultError) {

    currentForm = form;

    let hiddenMethod = form.find('input[name="_method"]').val();

    let method = (hiddenMethod === undefined) ? form.attr('method') : hiddenMethod;

    let data = form.serializeFormJSON();

    let action = form.attr('action');

    if (method.toUpperCase() !== 'GET') {
        CSRFToken();
    }

    $.ajax({
        type: method,
        url: action,
        data: data,
        success: successCallback,
        error: errorCallback
    });
}

const submitFileForm = function (form, successCallback = defaultSuccess, errorCallback = defaultError) {

    let formEl = $(form);

    currentForm = formEl;

    let hiddenMethod = formEl.find('input[name="_method"]').val();

    let method = (hiddenMethod === undefined) ? formEl.attr('method') : hiddenMethod;

    let data = new FormData(form);

    let action = formEl.attr('action');

    loadingIcon(formEl);

    if (method.toUpperCase() !== 'GET') {
        CSRFToken();
    }

    if (method.toUpperCase() === 'PUT') {
        method = 'POST'
    }

    $.ajax({
        type: method,
        url: action,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: successCallback,
        error: errorCallback,
    });
}

const defaultSuccess = function (response) {

    if (response.redirect) {

        window.location = response.redirect;

    } else {

        toastr.success('Data Updated Successfully');
    }
}

const defaultError = function (response, status, err, form) {

    if (response.responseJSON) {

        let errors = response.responseJSON.errors;

        if (errors) {
            displayErrors(errors);
        }
    }
}

const exists = function (selector) {
    return $(selector).length > 0;
}

$(document).on('click', '.btn-draft', function (e) {

    e.preventDefault();

    let $form = $(this).closest('form');

    $('input[name="published"]').val(0);

    submitForm($form);
});

$(document).on('click', '.btn-publish', function (e) {

    e.preventDefault();

    let $form = $(this).closest('form');

    $('input[name="published"]').val(1);

    submitForm($form);
});

$(document).on('click', '.delete', function () {

    let action = $(this).attr('action');

    let method = 'DELETE';

    let btn = $(this);

    swal({
        title: 'Are you sure?',
        text: "Once deleted, you will not be able to recover it!",
        type: "warning",
        customClass: 'swal-delete',
        background: "#222",
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Keep',
        confirmButtonColor: '#CF000F',
        cancelButtonColor: '#f3b715',
        focusCancel: true
    }).then(result => {

        if (result.value) {

            CSRFToken();

            $.ajax({

                type: method,
                url: action,
                success: function (response) {

                    if (response.status) {

                        if (btn.attr('target')) {

                            $(btn.attr('target')).remove();

                        } else {

                            btn.parents('tr').remove();
                        }

                        if (btn.parents('table')) {

                            btn.parents('table').DataTable()
                        }
                    }
                }
            });
        }
    });
});

const loadingIcon = function (form) {

    /* if (exists('#loading-icon')) return;

    let submitButton = form.find('.btn-submit');

    let loading = `<i class="ml-2 fas fa-circle-notch fa-spin" id="loading-icon"></i>`;

    submitButton.append(loading); */
}

const showFormData = function (formData) {

    for (var pair of formData.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
    }
}
