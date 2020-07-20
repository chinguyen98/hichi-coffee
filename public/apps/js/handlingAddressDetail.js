const idDistrictSelect = document.querySelector('select[name="id_district"]');
const idWardSelect = document.querySelector('select[name="id_ward"]');
const hidDistrict = document.querySelector('input[name="hid_district"]');
const hidWard = document.querySelector('input[name="hid_ward"]');

async function renderDistrictsSelectInfo() {
    const districts = await fetch(`/api/cities/4/districts`).then(res => res.json());
    let exportDistrictsHtml = '<option value="-1" disabled>Chọn quận/huyện</option>';
    exportDistrictsHtml += districts.map(district => {
        return `
            <option value="${district.ID}" ${hidDistrict.value == district.ID ? 'selected' : ''}>${district.Title}</option>
        `;
    }).join('');
    idDistrictSelect.innerHTML = exportDistrictsHtml;
}

async function renderWardsSelectInfo(id_district) {
    const wards = await fetch(`/api/districts/${id_district}/wards`).then(res => res.json());
    let exportWardsHtml = '<option value="-1" disabled>Chọn xã/phường</option>';
    exportWardsHtml = wards.map(ward => {
        return `
            <option value="${ward.ID}" ${hidWard.value == ward.ID ? 'selected' : ''}>${ward.Title}</option>
        `;
    }).join('');
    idWardSelect.innerHTML = exportWardsHtml;
}

idDistrictSelect.addEventListener('change', (e) => { renderWardsSelectInfo(e.target.value) });
window.addEventListener('load', () => {
    renderDistrictsSelectInfo();
    renderWardsSelectInfo(hidDistrict.value);
});