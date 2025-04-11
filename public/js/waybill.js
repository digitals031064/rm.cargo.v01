// Function to fetch the next waybill number for the given location
function fetchNextWaybillNumber(locationId) {
    return fetch(`/locations/next-waybill/${locationId}`)
        .then(response => response.json())
        .then(data => {
            if (data.next_waybill_no) {
                return data.next_waybill_no;
            } else {
                
                console.error('No next waybill number available');
                return null;
            }
        })
        .catch(error => {
            console.error('Error fetching next waybill number:', error);
            return null;
        });
}
