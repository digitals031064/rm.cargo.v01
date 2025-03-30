<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto items-center sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 justify-center">
                        <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                            <!-- Modal content -->
                            <div class="bg-white rounded-lg shadow-xl justify-center dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="bg-blue-500 flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                    <h3 class="text-xl font-bold text-white">
                                        Update New Waybill
                                    </h3>
                                </div>
                                <!-- Modal body -->
                                <form class="p-4 md:p-5" method="POST" action="{{route('waybills.update', ['waybill' => $waybill])}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid gap-4 mb-8 grid-cols-2">
                                        <div class="col-span-2">
                                            <label for="waybill_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waybill Number</label>
                                            <input type="text" name="waybill_no" id="waybill_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybill->waybill_no}}" required="">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="consignee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consignee</label>
                                            <input type="text" name="consignee" id="consignee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybill->consignee}}" required="">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="shipper" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipper</label>
                                            <input type="text" name="shipper" id="shipper" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybill->shipper}}" required="">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="shipment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipment</label>
                                            <input type="text" name="shipment" id="shipment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybill->shipment}}" required="">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="cbm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CBM</label>
                                            <input type="number" name="cbm" id="cbm" max="999999.99" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybill->cbm}}" required="">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                            <input type="number" name="price" id="price" max="99999999.99" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybill->price}}" required="">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                            <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                                <option selected="SS">Select status</option>
                                                <option value="arrivedVanYard">Arrived at Van Yard</option>
                                                <option value="arrivedOriginPort">Arrived at Origin Port</option>
                                                <option value="departedOriginPort">Departed from Origin Port</option>
                                                <option value="arrivedDestinationPort">Arrived at Destination Port</option>
                                                <option value="delivery">Out for Delivery</option>
                                                <option value="delivery">Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <a type="button" href="/waybills" class="font-medium text-blue-600 mx-4 dark:text-blue-500 hover:underline">Cancel</a>
                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 my-4 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                        Update Waybill
                                    </button>
                                    
                                </form>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>