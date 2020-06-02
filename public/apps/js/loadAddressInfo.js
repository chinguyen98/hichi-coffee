const citySelection = document.querySelector('select[name="city"]');

const loadCities = async () => {
    const data = await fetch('/api/cities').then(res => res.json());
    let exportHtml = '<option value="-1" selected>Chọn thành phố</option>';
    exportHtml += data.map(city => {
        return `
            <option value="${city.ID}">${city.Title}</option>
        `;
    })
    citySelection.innerHTML = exportHtml;
}

window.addEventListener('load', loadCities);