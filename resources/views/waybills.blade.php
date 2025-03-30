<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Modal toggle -->
                    <button data-modal-target="createModal" data-modal-toggle="createModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Create Waybill
                    </button>
                    
                    <!-- Main modal -->
                    <div id="createModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full rounded-lg">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="bg-blue-500 flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                    <h3 class="text-lg font-semibold text-white">
                                        Create New Waybill
                                    </h3>
                                    <button type="button" class="text-white bg-transparent hover:bg-white hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createModal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form class="p-4 md:p-5" method="POST" action="{{ route('waybills.store') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2">
                                            <label for="waybill_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waybill Number</label>
                                            <input type="text" name="waybill_no" id="waybill_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Waybill Number" required="">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="consignee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consignee</label>
                                            <input type="text" name="consignee" id="consignee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Consignee" required="">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="consignee_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consignee #</label>
                                            <input type="text" name="consignee_no" id="consignee_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Phone #" required="">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="shipper" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipper</label>
                                            <input type="text" name="shipper" id="shipper" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Shipper" required="">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="shipper_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipper #</label>
                                            <input type="text" name="shipper_no" id="shipper_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Phone #" required="">
                                        </div>
                                        <div class="col-span-2">
                                            <label for="shipment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipment</label>
                                            <input type="text" name="shipment" id="shipment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Shipment" required="">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="cbm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CBM</label>
                                            <input type="number" name="cbm" id="cbm" max="999999.99" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="CBM" required="">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                            <input type="number" name="price" id="price" max="999999.99" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="PHP" required="">
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
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                        Add new product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="my-8">                      
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-blue-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Waybill Number
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Consignee
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($waybills as $waybill)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-blue-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$waybill->waybill_no}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$waybill->consignee->name}}
                                        </td>
                                        <td class="px-6 py-4">
                                            PHP{{$waybill->price}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$waybill->status}}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{route('waybills.edit', ['waybill' => $waybill])}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- <div id="editModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full rounded-lg">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="bg-blue-500 flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                        <h3 class="text-lg font-semibold text-white">
                                            Update New Waybill
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-4 md:p-5" method="POST" action="{{route('waybills.update'), [$waybills->waybills]}}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2">
                                                <label for="waybill_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waybill Number</label>
                                                <input type="text" name="waybill_no" id="waybill_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybills->waybill_no}}" required="">
                                            </div>
                                            <div class="col-span-2">
                                                <label for="consignee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consignee</label>
                                                <input type="text" name="consignee" id="consignee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybills->consignee}}" required="">
                                            </div>
                                            <div class="col-span-2">
                                                <label for="shipper" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipper</label>
                                                <input type="text" name="shipper" id="shipper" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybills->shipper}}" required="">
                                            </div>
                                            <div class="col-span-2">
                                                <label for="shipment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipment</label>
                                                <input type="text" name="shipment" id="shipment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybills->shipment}}" required="">
                                            </div>
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                                <input type="number" name="price" id="price" max="999999.99" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$waybills->price}}" required="">
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
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                            Update Waybill
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>