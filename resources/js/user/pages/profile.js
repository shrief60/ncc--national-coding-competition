import flatpickr from "flatpickr";
require("flatpickr/dist/themes/dark.css");

flatpickr('input[type="date"]', {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
});

$(document).on('click', '.edit', function () {

    // Cache Dom Element
    let $this = $(this);

    // Select the element that will be edited
    let editable = $this.attr('editable');
    let $editable = $(`[data-editable=${editable}]`);

    // Hide the icon and text
    $this.fadeOut();
    $(`[data-updatable='${editable}']`).fadeOut(() => {
        // Show the editable element
        $editable.fadeIn();
    });
});


$(document).on('click', '.editing form .save', function () {
    $(this).closest('form').submit();
});

$(document).on('click', '.editing form .cancel', function () {

    let $editable = $(this).closest('.editing');
    $editable.fadeOut(() => {
        let key = $editable.attr('data-editable');
        $(`[editable='${key}']`).fadeIn();
        $(`[data-updatable='${key}']`).fadeIn();
    });

});


$(document).on('submit', '.editing form, .password form', function (e) {
    e.preventDefault();
    submitForm($(this), profileUpdateSuccessCallback, profileUpdateErrorCallback);
});

$(document).on('submit', '.reflections form', function (e) {
    e.preventDefault();
    submitForm($(this), addReflectionSuccessCallback);
});


const profileUpdateSuccessCallback = response => {
    let editing = response.data;
    if (!editing) return;

    sweetAlert({
        icon: 'success',
        text: 'Data updated successfully'
    });

    for (const key in editing) {
        if (editing.hasOwnProperty(key)) {
            const value = editing[key];

            /**
             * SlideUp Form
             * @example <div data-editable="name">
             *
             * Update content
             * @example <div data-updatable="name">
             */


            $(`.editing[data-editable='${key}']`).slideUp();
            setTimeout(() => {
                $(`[data-updatable='${key}']`).text(value).fadeIn();
                // Show edit icon again
                $(`[editable='${key}']`).fadeIn();
            }, 300);


        }
    }
}


const profileUpdateErrorCallback = response => {

    if (response.responseJSON) {

        let errors = response.responseJSON.errors;
        for (const error in errors) {
            sweetAlert({
                icon: 'error',
                text: errors[error][0]
            })
        }
    }
}


$(document).on('change', '.profile input[type="file"]', function (e) {
    $(this).closest('form').submit();
});


const addReflectionSuccessCallback = () => {
    sweetAlert({
        icon: 'success',
        text: 'Data updated successfully'
    });
}
