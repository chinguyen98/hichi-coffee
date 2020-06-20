const cityHiddenInput = document.querySelector('input[name="id_city"]');
const districtHiddenInput = document.querySelector('input[name="id_district"]');
const wardHiddenInput = document.querySelector('input[name="id_ward"]');
const addressHiddenInput = document.querySelector('input[name="address"][type="hidden"]');
const combinedAddressArea = document.querySelector('.combinedAddress');

const renderCombinedAddress = async () => {
    const id_city = cityHiddenInput.value;
    const id_district = districtHiddenInput.value;
    const id_ward = wardHiddenInput.value;
    const address = addressHiddenInput.value;

    const city = await fetch(`api/cities/${id_city}`).then(res => res.json());
    const district = await fetch(`api/districts/${id_district}`).then(res => res.json());
    const ward = await fetch(`api/wards/${id_ward}`).then(res => res.json());

    const combinedAddress = `Địa chỉ: ${address}, ${ward.Title}, ${district.Title}, ${city.Title}`;
    combinedAddressArea.innerHTML = combinedAddress;
}

window.addEventListener('load', renderCombinedAddress)
