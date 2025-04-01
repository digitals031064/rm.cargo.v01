<x-front-layout>
    <div class="bg-gray-100">
        <div class=" flex overflow-visible">
            <div class="container mx-auto p-6">
                <h2 class="text-2xl font-semibold text-center mb-6">Shipping Rate Calculator</h2>
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Column 1: Shipping Calculator Form -->
                    <div class="p-6 rounded-lg">
                        <h4 class="text-lg font-medium mb-4">Calculate Shipping Cost</h4>
                        
                        <form class="bg-white max-w m-8 p-8 w-96 rounded-xl shadow-xl" id="shippingForm">
                            <h2 class="text-xl text-black mb-6">Shipping Rate Calculator</h2>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-8 group">
                                    <input type="number" name="length" id="length" step="0.01" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="length" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Length(CM)</label>
                                </div>
                                <div class="relative z-0 w-full mb-8 group">
                                    <input type="number" name="width" id="width" step="0.01" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="width" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Width(CM)</label>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-8 group">
                                    <input type="number" name="height" id="height" step="0.01" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="height" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Height(CM)</label>
                                </div>
                                <div class="relative z-0 w-full mb-8 group">
                                    <input type="number" name="weight" id="weight" step="0.01" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="weight" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Weight(KG)</label>
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-8 group">
                                    <input type="number" name="quantity" id="quantity" step="0.01" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="quantity" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quantity</label>
                                </div>
                                <div class="relative z-0 w-full mb-8 group">
                                    <input type="number" name="value" id="value" step="0.01" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label for="value" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Declared Value(PHP)</label>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-8 group">
                                <div class="flex items-center mb-4">
                                    <input id="pickupCheckbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="pickupCheckbox" class="ms-2 text-sm font-medium text-gray-900">Door to Pier</label>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-8 group hidden" id="Pickup">
                                <select id="pickupDropdown" onchange="updatePickup()" class="mb-2">
                                    <option value="">--Choose--</option>
                                    <option value="manila">Manila, Philippines</option>
                                    <option value="zamboanga">Zamboanga City, Philippines</option>
                                </select>
                                <select id="subPickup">
                                    <option value="">--Choose--</option>
                                </select>
                            </div>
                            <div class="relative z-0 w-full mb-8 group">
                                <div class="flex items-center mb-4">
                                    <input id="dropoffCheckbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="dropoffCheckbox" class="ms-2 text-sm font-medium text-gray-900">Pier to Door</label>
                                </div>
                            </div>
                            <div class="relative z-0 w-full mb-8 group hidden" id="Dropoff">
                                <select id="dropoffDropdown" onchange="updateDropoff()" class="mb-2">
                                    <option value="">--Choose--</option>
                                    <option value="manila">Manila, Philippines</option>
                                    <option value="zamboanga">Zamboanga City, Philippines</option>
                                </select>
                                <select id="subDropoff">
                                    <option value="">--Choose--</option>
                                </select>
                            </div>
                            <button type="submit" class="text-white bg-gray-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500">Submit</button>
                            <div class="text-center text-xs pt-3">*Discounts unaccounted for, pricing may slightly differ.</div>
                        </form>
        
                    </div>
        
                    <!-- Column 2: Display Calculation Result -->
                    <div class="max-w m-8 p-8 w-96 rounded-xl">
                        <h4 class="text-lg font-medium mb-4">Calculation Result</h4>
                        <div id="result" class="bg-white rounded-xl mt-4 text-center text-lg max-w m-8 p-8 w-96 rounded-xl shadow-xl hidden">
                            <!-- The calculated shipping rate will be displayed here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script>
        /* document.getElementById('shippingForm').addEventListener('submit', function (e) {
          e.preventDefault();
    
         
          const length = parseFloat(document.getElementById('length').value);
          const width = parseFloat(document.getElementById('width').value);
          const height = parseFloat(document.getElementById('height').value);
          const weight = parseFloat(document.getElementById('weight').value);
          const value = parseFloat(document.getElementById('value').value);
    
          
          const formula1 = ((length/100) * (width/100) * (height/100)) * 3360;
          const formula2 = weight * 10;
          const formula3 = value * 0.08;
    
          
          const highestRate = Math.max(formula1, formula2, formula3);
    
          
          const resultDiv = document.getElementById('result');
          resultDiv.innerHTML = `Your Shipment will cost: PHP${highestRate.toFixed(2)}`;
          resultDiv.classList.remove('hidden');

          
        }); */
        const subLocations = {
            manila: ["Binondo", "Ermita", "Intramuros", "Malate", "Paco", "Pandacan", "Port Area", "Quiapo", "Sampaloc", "San Andres", "San Miguel", "San Nicolas", "Santa Ana", "Santa Cruz", "Santa Mesa", "Tondo"],
            zamboanga: ["Baliwasan", "Canelar", "Pasonanca", "Putik", "Santa Maria", "Tetuan", "Tugbungan", "Zambowood"]
        };

        function updatePickup() {
            const mainLocation = document.getElementById("pickupDropdown").value;
            const subLocationSelect = document.getElementById("subPickup");
            
            subLocationSelect.innerHTML = '<option value="">--Choose--</option>';
            
            if (subLocations[mainLocation]) {
                subLocations[mainLocation].forEach(sub => {
                    let option = document.createElement("option");
                    option.value = sub.toLowerCase();
                    option.textContent = sub;
                    subLocationSelect.appendChild(option);
                });
            }
        }

        function updateDropoff() {
            const mainLocation = document.getElementById("dropoffDropdown").value;
            const subLocationSelect = document.getElementById("subDropoff");
            
            subLocationSelect.innerHTML = '<option value="">--Choose--</option>';
            
            if (subLocations[mainLocation]) {
                subLocations[mainLocation].forEach(sub => {
                    let option = document.createElement("option");
                    option.value = sub.toLowerCase();
                    option.textContent = sub;
                    subLocationSelect.appendChild(option);
                });
            }
        }

        const subLocationFees = 
        {
    // Fees per sub-location
        binondo: 50, ermita: 60, intramuros: 55, malate: 70, paco: 65,
        pandacan: 75, "port area": 80, quiapo: 50, sampaloc: 65, "san andres": 55,
        "san miguel": 60, "san nicolas": 70, "santa ana": 50, "santa cruz": 55,
        "santa mesa": 65, tondo: 80,
        
        baliwasan: 90, canelar: 85, pasonanca: 100, putik: 95, "santa maria": 80,
        tetuan: 85, tugbugan: 70, zambowood: 75
        };

        document.getElementById('shippingForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const length = parseFloat(document.getElementById('length').value);
            const width = parseFloat(document.getElementById('width').value);
            const height = parseFloat(document.getElementById('height').value);
            const weight = parseFloat(document.getElementById('weight').value);
            const value = parseFloat(document.getElementById('value').value);
            const quantity = parseFloat(document.getElementById('quantity').value);
            const pickupSubLocation = document.getElementById('subPickup').value.toLowerCase();
            const dropoffSubLocation = document.getElementById('subDropoff').value.toLowerCase();

            // Calculate base shipping rates
            const formula1 = (((length / 100) * (width / 100) * (height / 100))* quantity) * 3360;
            const formula2 = weight * 10;
            const formula3 = value * 0.08;

            let highestRate = Math.max(formula1, formula2, formula3);

            // Get pickup and dropoff fees if applicable
            const pickupCharge = subLocationFees[pickupSubLocation] || 0;
            const dropoffCharge = subLocationFees[dropoffSubLocation] || 0;

            // Add pickup and dropoff charges
            highestRate += pickupCharge + dropoffCharge;


            // Display result
            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML =
             `<p><strong>Your Shipment will cost: PHP ${highestRate.toFixed(2)}</strong></p>
             <p>Price Breakdown</p>
             <p><strong>Base Fee: ${highestRate}</strong></p>
             <p><strong>Pickup Charge ${pickupCharge}</strong></p>
             <p><strong>Dropoff Charge ${dropoffCharge}</strong></p>`;
            resultDiv.classList.remove('hidden');
        });

        const checkbox = document.getElementById('pickupCheckbox');
        const hiddenContent = document.getElementById('Pickup');

        checkbox.addEventListener('change', function () {

        if (this.checked) {
            hiddenContent.classList.remove('hidden');
        }
        else {
            hiddenContent.classList.add('hidden');
        }
        });

        const checkbox1 = document.getElementById('dropoffCheckbox');
        const hiddenContent1 = document.getElementById('Dropoff');

        checkbox1.addEventListener('change', function () {

        if (this.checked) {
            hiddenContent1.classList.remove('hidden');
        }
        else {
            hiddenContent1.classList.add('hidden');
        }
        });

      </script>
</x-front-layout>