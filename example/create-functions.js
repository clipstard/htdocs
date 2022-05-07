
const nameInput = $('#name-input');
const priceInput = $('#price-input');
const producerInput = $('#producer-input');
const descriptionInput = $('#description-input');


function errorInput(input, text, specialCondition = undefined) {
    let value = input.val();
    if (specialCondition !== undefined) {
        value = specialCondition(value);
    }

    if (!value) {
        const prepend = input.parent().find('.input-group-prepend');
        prepend.addClass('is-invalid');
        prepend.parent('.input-group').append(`<div class="invalid-feedback">${text}</div>`);
        input.addClass('is-invalid');
    }

    return !!value;
}

function clearError(input) {
    const prepend = input.parent().find('.input-group-prepend');
    prepend.removeClass('is-invalid');
    input.removeClass('is-invalid');
    prepend.parent().find('.invalid-feedback').remove();
}

function validateDelivery() {
    const count = $('.delivery-item').length;
    const range = [...Array(count)].map((_, index) => index);
    let valid = true;
    range.forEach(number => {
        const cityInput = $(`#delivery-city-select${number}`);
        const iconInput = $(`#delivery-icon-select${number}`);
        const nameInput = $(`#delivery-name-input${number}`);
        clearError(cityInput);
        clearError(iconInput);
        clearError(nameInput);
        const required = [cityInput, iconInput, nameInput].some(item => item.val());

        if (required) {
            valid = errorInput(cityInput, 'City is required') && valid;
            valid = errorInput(iconInput, 'Icon is required') && valid;
            valid = errorInput(nameInput, 'Name is required') && valid;
        }
    });

    return valid;
}

function removeEmptyDelivery() {
    const count = $('.delivery-item').length;
    const range = [...Array(count)].map((_, index) => index);
    range.forEach(number => {
        const cityInput = $(`#delivery-city-select${number}`);
        const iconInput = $(`#delivery-icon-select${number}`);
        const nameInput = $(`#delivery-name-input${number}`);
        const required = [cityInput, iconInput, nameInput].some(item => item.val());

        if (!required) {
            cityInput.closest('.delivery-item').remove();
        }
    });
}

$('#submit-button').on('click', function () {
    let valid = true;
    function validatePrice(price) {
        let asNum = parseFloat(price);
        return !isNaN(asNum) && asNum > 0;
    }

    clearError(nameInput);
    clearError(priceInput);
    clearError(descriptionInput);
    clearError(producerInput);

    valid = errorInput(nameInput, 'Name is required') && valid;
    valid = errorInput(priceInput, 'Price is required and should be greater than 0', validatePrice) && valid;
    valid = errorInput(descriptionInput, 'Description is required') && valid;
    valid = errorInput(producerInput, 'Producer is required') && valid;

    valid = validateDelivery() && valid;

    if (valid) {
        removeEmptyDelivery();
        $('form').submit();
    }
});
