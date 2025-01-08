// Handle category filter click
document.querySelectorAll('.category-filter').forEach(item => {
    item.addEventListener('click', function () {
        const category = this.getAttribute('data-category');
        document.getElementById('categoryInput').value = category;
        document.getElementById('filter-form').submit();
    });
});

// Update price range
function updatePriceRange() {
    document.getElementById('filter-form').submit();
}

// Toggle locality list based on selected city
function toggleLocalityList(cityName) {
    document.querySelectorAll('.locality-list').forEach(function (list) {
        list.style.display = 'none';
    });
    const localityList = document.getElementById('locality-' + cityName);
    localityList.style.display = 'block';
    document.getElementById('city-input').value = cityName === 'all' ? '' : cityName;
    document.getElementById('locality-input').value = '';
    document.getElementById('filter-form').submit();
}

// Submit filter form with city and locality
function submitFilter(city, locality) {
    document.getElementById('city-input').value = city === 'all' ? '' : city;
    document.getElementById('locality-input').value = locality === 'all' ? '' : locality;
    document.getElementById('filter-form').submit();
}

// Handle sort dropdown change
// document.getElementById('sortDropdown').addEventListener('change', function () {
//     const sortValue = this.value;
//     const adsContainer = document.getElementById('adsContaine');
//     const ads = Array.from(adsContainer.querySelectorAll('.ad-ite'));

//     ads.sort((a, b) => {
//         const priceA = parseFloat(a.querySelector('.price').textContent.replace('PKR', '').replace(',', '').trim());
//         const priceB = parseFloat(b.querySelector('.price').textContent.replace('PKR', '').replace(',', '').trim());

//         if (sortValue === 'lowToHigh') {
//             return priceA - priceB; // Ascending order
//         } else if (sortValue === 'highToLow') {
//             return priceB - priceA; // Descending order
//         } else {
//             return 0; // Default order
//         }
//     });

//     // Clear the container and append sorted ads
//     adsContainer.innerHTML = '';
//     ads.forEach(ad => adsContainer.appendChild(ad));
// });
document.getElementById('sortDropdown').addEventListener('change', function () {
    const sortValue = this.value;

    // Detect active tab (grid or list)
    const activeTab = document.querySelector('.tab-pane.active');
    const adsContainer = activeTab.querySelector('#adsContaine'); // Ensure correct container is selected
    const ads = Array.from(adsContainer.querySelectorAll('.ad-ite')); // Get all ad items

    // Sort ads based on the selected value
    ads.sort((a, b) => {
        const priceA = parseFloat(a.querySelector('.price').textContent.replace('PKR', '').replace(',', '').trim());
        const priceB = parseFloat(b.querySelector('.price').textContent.replace('PKR', '').replace(',', '').trim());

        if (sortValue === 'lowToHigh') {
            return priceA - priceB; // Ascending order
        } else if (sortValue === 'highToLow') {
            return priceB - priceA; // Descending order
        } else {
            return 0; // Default order
        }
    });

    // Clear the container and append sorted ads
    adsContainer.innerHTML = '';
    ads.forEach(ad => adsContainer.appendChild(ad));
});

