function buildIcons(value) {
    return `<option value=""${!value ? ' selected' : ''}></option>
            <option value="glovo"${value === 'glovo' ? ' selected' : ''}>Glovo</option>
            <option value="aliexpress"${value === 'aliexpress' ? ' selected' : ''}>Aliexpress</option>
            <option value="fedex"${value === 'fedex' ? ' selected' : ''}>Fedex</option>
            <option value="tnt"${value === 'tnt' ? ' selected' : ''}>TNT</option>
            <option value="dhl"${value === 'dhl' ? ' selected' : ''}>DHL</option>
            <option value="posta-moldovei"${value === 'posta-moldovei' ? ' selected' : ''}>Posta moldovei</option>`;
}

function buildCities(value) {
    return `<option value=""${!value ? ' selected' : ''}></option>
            <option value="chisinau"${value === 'chisinau' ? ' selected' : ''}>Chisinau</option>
            <option value="balti"${value === 'balti' ? ' selected' : ''}>Balti</option>
            <option value="orhei"${value === 'orhei' ? ' selected' : ''}>Orhei</option>
            <option value="soroca"${value === 'soroca' ? ' selected' : ''}>Soroca</option>
            <option value="nisporeni"${value === 'nisporeni' ? ' selected' : ''}>Nisporeni</option>
            <option value="ungheni"${value === 'ungheni' ? ' selected' : ''}>Ungheni</option>`;
}

function buildDeliveryItem(index, data) {
    if (!data) {
        data = {};
    }

    data.name = data.name || '';
    data.icon = data.icon || '';
    data.city = data.city || '';

    return `
            <div class="row delivery-item">
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="delivery-name-input${index}" class="input-group-text" id="delivery-name-addon${index}">Name</label>
                    </div>
                    <input type="text" class="form-control" id="delivery-name-input${index}" value="${data.name}" name="delivery[${index}][name]" aria-describedby="delivery-name-addon${index}">
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="delivery-icon-select${index}" class="input-group-text" id="delivery-icon-addon${index}">Icon</label>
                    </div>
                    <select class="form-select" id="delivery-icon-select${index}" aria-describedby="delivery-icon-addon${index}" name="delivery[${index}][icon]">
                        ${buildIcons(data.icon)}
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label for="delivery-city-select${index}" class="input-group-text" id="delivery-city-addon${index}">City</label>
                    </div>
                    <select class="form-select" id="delivery-city-select${index}" aria-describedby="delivery-city-addon${index}" name="delivery[${index}][city]">
                    ${buildCities(data.city)}
                    </select>
                </div>
            </div>
        </div>`;
}

function insertInDomDeliveryItem(data = null) {
    const count = $('.delivery-item').length;
    $(buildDeliveryItem(count, data)).insertBefore($('#submit-row'));
}