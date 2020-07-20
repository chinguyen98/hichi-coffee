const idDistrictSelect = document.querySelector('select[name="id_district"]');
const idWardSelect = document.querySelector('select[name="id_ward"]');

async function renderDistrictsSelectInfo(){
    const districts = await fetch(`/api/cities/4/districts`).then(res => res.json());
    let exportDistrictsHtml = '<option value="-1" disabled selected>Chọn quận/huyện</option>';
    exportDistrictsHtml += districts.map(district => {
        return `
            <option value="${district.ID}">${district.Title}</option>
        `;
    }).join('');
    idDistrictSelect.innerHTML = exportDistrictsHtml;
}

async function renderWardsSelectInfo(id_district) {
    const wards = await fetch(`/api/districts/${id_district}/wards`).then(res => res.json());
    let exportWardsHtml = '<option value="-1" disabled selected>Chọn xã/phường</option>';
    exportWardsHtml = wards.map(ward => {
        return `
            <option value="${ward.ID}">${ward.Title}</option>
        `;
    }).join('');
    idWardSelect.innerHTML = exportWardsHtml;
}

idDistrictSelect.addEventListener('change', (e) => { renderWardsSelectInfo(e.target.value) });
window.addEventListener('load', () => {
    renderDistrictsSelectInfo();
});