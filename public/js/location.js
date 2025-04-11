document.addEventListener('DOMContentLoaded', function () {
    const locationPicker = document.getElementById('location-picker');
    const waybillInput = document.getElementById('waybill_no'); // Waybill number input field

    // Check if a location is already selected in localStorage
    const selectedLocation = localStorage.getItem('selected_location');
    if (selectedLocation) {
        locationPicker.value = selectedLocation;
    }

    // Event listener for when the location changes
    locationPicker.addEventListener('change', function () {
        const locationId = locationPicker.value;

        // Fetch last number for the selected location
        if (locationId) {
            fetchNextWaybillNumber(locationId).then(nextWaybillNo => {
                if (nextWaybillNo) {
                    waybillInput.value = nextWaybillNo;
                }
            });
        }
    });
});
