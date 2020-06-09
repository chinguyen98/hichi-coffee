const citySelection = document.querySelector('select[name="id_city"]');
const districtSelection = document.querySelector('select[name="id_district"]');
const wardSelection = document.querySelector('select[name="id_ward"]');

const exportListOption = (lists) => {
    return lists.map(item => {
        return `
            <option value="${item.ID}">${item.Title}</option>
        `;
    });
}

const loadCities = async () => {
    const data = await fetch('/api/cities').then(res => res.json());
    let exportHtml = '<option value="" disabled selected>Chọn thành phố</option>';
    exportHtml += exportListOption(data);
    citySelection.innerHTML = exportHtml;
}

const loadDistricts = async (id) => {
    const data = await fetch(`http://127.0.0.1:8000/api/cities/${id}/districts`).then(res => res.json());
    let exportHtml = '<option value="" disabled selected>Chọn quận/huyện</option>';
    exportHtml += exportListOption(data);
    districtSelection.innerHTML = exportHtml;
}

const loadWards = async (id) => {
    const data = await fetch(`http://127.0.0.1:8000/api/districts/${id}/wards`).then(res => res.json());
    let exportHtml = '<option value="" disabled selected>Chọn phường/xã</option>';
    exportHtml += exportListOption(data);
    wardSelection.innerHTML = exportHtml;
}

citySelection.addEventListener('change', (e) => { loadDistricts(e.target.value) });
districtSelection.addEventListener('change', (e) => { loadWards(e.target.value) });
window.addEventListener('load', loadCities);