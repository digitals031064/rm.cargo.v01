<x-app-layout>
    <style>
        .draggable-header {
            display: flex;
            justify-content: space-between;
            align-items: center; 
            color: white;
            padding: 10px;
            cursor: grab;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .draggable-header:active {
            cursor: grabbing;
        }
        .highlight {
            @apply bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-semibold shadow-md transition-all;
            border-left: 4px solid #10b981; /* Green accent */
        }

        /* Dark mode support using media query */
        @media (prefers-color-scheme: dark) {
            .highlight {
                background-color: #374151; /* Tailwind gray-700 */
                color: white;
            }
        }
        .highlight th {
            color: #0f172a; /* Tailwind slate-900 for dark, defined text */
            dark:text-white; /* Maintain white text in dark mode */
            font-weight: 700; /* Extra bold for headers */
        }

        .tooltip {
            position: absolute;
            display: block;
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            pointer-events: none;
        }

    </style>
    <div class="py-12">
        <!-- Start block -->
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <!-- Start coding here -->                             
                @if(session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif


                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <!-- Tooltip Container -->
                        
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="search" name="search" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required=""
                                        value="{{ request('search') }}">
                                </div>
                            </form>
                        </div>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button" id="createWaybillModalButton" data-modal-target="createWaybillModal" data-modal-toggle="createWaybillModal" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Create Waybill
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                    @if($waybills->total() > 0)  {{-- Check if any results exist --}}
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-separate border-spacing-0" id="wb-table">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-4">
                                            Waybill Number
                                    </th>
                                    <th scope="col" class="px-4 py-3">Consignee<span class="inline-block ml-1">⇅</span></th>
                                    <th scope="col" class="px-4 py-3">Price<span class="inline-block ml-1">⇅</span></th>
                                    <th scope="col" class="px-4 py-3">Status<span class="inline-block ml-1">⇅</span></th>
                                    <th scope="col" class="px-4 py-3">Action<span class="inline-block ml-1">⇅</span></th>
                                </tr>
                            </thead>
                            <tbody id="waybill-table">
                                @foreach ($waybills as $waybill)
                                <tr                                             
                                    data-id="{{$waybill->id}}"
                                    data-waybill_no="{{$waybill->waybill_no}}"
                                    data-type="{{$waybill->type}}"
                                    data-van_no="{{$waybill->van_no}}"
                                    data-consignee_id="{{$waybill->consignee->id}}"
                                    data-consignee_name="{{$waybill->consignee->name}}"
                                    data-consignee_phone="{{$waybill->consignee->phone_number}}"
                                    data-billing_address="{{$waybill->consignee->billing_address}}"
                                    data-shipper_id="{{$waybill->shipper->id}}"
                                    data-shipper_name="{{$waybill->shipper->name}}"
                                    data-shipper_phone="{{$waybill->shipper->phone_number}}"
                                    data-shipping_address="{{$waybill->shipper->shipping_address}}"
                                    data-shipment="{{$waybill->shipment}}"
                                    data-cbm="{{$waybill->cbm}}"
                                    data-weight="{{$waybill->weight}}"
                                    data-declared_value="{{$waybill->declared_value}}"
                                    data-price="{{$waybill->price}}"
                                    data-status="{{$waybill->status}}"
                                    class="waybill-row border-b dark:border-gray-700 {{ $loop->first ? 'highlight' : '' }}"
                                >
                                    <td scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$waybill->waybill_no}}</th>
                                    <td class="px-4 py-3">{{$waybill->consignee->name}}</td>
                                    <td class="px-4 py-3">PHP{{$waybill->price}}</td>
                                    <td class="px-4 py-3">{{$waybill->status}}</td>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button type="button" data-modal-target="updateWaybillModal" data-modal-toggle="updateWaybillModal" class="update-Modal z-10 flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200" data-id="{{ $waybill->id }}">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                        </svg>
                                        Edit
                                        </button>
                                    </td>
                                </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                            
                        <div class="mt-4">
                            <!-- Pagination with Search Query Persisting -->
                            {{ $waybills->appends(['search' => request('search')])->links() }}                                        
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </section>
                    <!-- End block -->
        <!-- Create modal -->
        <div id="createWaybillModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Waybill</h3>
                        <button type="button" id="addCloseModal" name="addCloseModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-target="createWaybillModal" data-modal-toggle="createWaybillModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <!--<form id="addWaybilLForm" method="POST" action="{{ route('waybills.store') }}"> -->
                    <form id="addWaybilLForm" name="addWaybilLForm" class="waybill-form">
                        @csrf
                        @method('POST')
                        <!-- Waybill -->
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <div class="mb-2"></div>
                                <p class="text-sm text-gray-500 dark:text-white p-4">
                                    Waybill No: <span id="preview-waybill-no" class="font-semibold text-xl">Loading...</span>
                                </p>
                            </div>
                            <div>
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waybill Type</label>
                                <select name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    <option value="default">Default</option>
                                    <option value="cebu">Cebu</option>
                                </select>
                            </div>
                            <div>
                                <label for="van_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Van Number</label>
                                <input type="text" name="van_no" id="van_no" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Van Number">
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                            <!-- Consignee --> 
                            <div>
                                <div>
                                    <label for="consignee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consignee</label>
                                    <input type="text" name="consignee" id="add_consignee" class="form-field  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Consignee" required=""> 
                                    <div id="add_consignee_list" class="absolute z-10 bg-white shadow-md rounded-md w-full max-h-60 overflow-y-auto hidden"></div>
                                    <span class="text-xs text-red-600 text-left block" id="consignee_id_error"></span>
                                    <input type="hidden" name="consignee_id" id="add_consignee_id">

                                </div>
                                <div>
                                    <label for="consignee_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consignee #</label>
                                    <input type="text" name="consignee_no" id="add_consignee_no" class="form-field  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Phone #" required="">
                                </div>
                                <div>
                                    <label for="billingAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Billing Address</label>
                                    <input type="text" name="billingAddress" id="add_billing_address" 
                                        class="form-field  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        placeholder="Billing Address" required="">
                                </div>                                
                            </div>

                            <div> <!-- Shipper Information -->
                                <div>
                                    <label for="shipper" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipper</label>
                                    <input type="text" name="shipper" id="add_shipper" class="form-field  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Shipper" required="">
                                    <div id="add_shipper_list" class="absolute z-10 bg-white shadow-md rounded-md w-full max-h-60 overflow-y-auto hidden"></div>
                                    <span class="text-xs text-red-600 text-left block" id="shpper_id_error"></span>
                                    <input type="hidden" name="shipper_id" id="add_shipper_id">
                                </div>

                                <div>
                                    <label for="shipper_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipper #</label>
                                    <input type="text" name="shipper_no" id="add_shipper_no" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Phone #" required="">
                                </div>
                                <div>
                                    <label for="shippingAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipping Address</label>
                                    <input type="text" name="shippingAddress" id="add_shipping_address" 
                                        class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        placeholder="Shipping Address" required="">
                                </div>
                            </div>
                        </div>

                        <div> <!-- Shipment Information -->
                            <label for="shipment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipment</label>
                            <input type="text" name="shipment" id="shipment" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Shipment" required="">
                        </div>
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="cbm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CBM</label>
                                <input type="number" name="cbm" id="cbm" max="999999.99" step="any" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 cbm" placeholder="CBM">
                            </div>
                            <div>
                                <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight</label>
                                <input type="number" name="weight" id="weight" max="999999.99" step="0.01" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 weight" placeholder="Weight">
                            </div>
                            <div>
                                <label for="declared_value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Declared Value</label>
                                <input type="number" name="declared_value" id="declared_value" max="999999.99" step="0.01" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 declared" placeholder="PHP">
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 sm:grid-cols-3">
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="number" name="price" id="price" max="999999.99" step="0.01" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 price" placeholder="PHP">
                            </div>
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ $waybill->status == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>                                        
                            </div>
                        </div>
                        <button type="submit" name="submitAdd" id="submitAdd"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Create Waybill
                        </button>
                    </form>
                </div>
            </div>
        </div>
                    <!-- Update modal -->
        <div id="updateWaybillModal" name="updateWaybillModal" tabindex="-1" aria-hidden="true" 
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="modal-header draggable-header flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Waybill</h3>
                        <button type="button" id="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateWaybillModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form id="updateModalForm" name="updateModalForm" class="waybill-form">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="_method" value="PUT">
                        <div class="grid gap-4 mb-6">
                            <input type="hidden" id="update_waybill_id">
                            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                <div>
                                    <label for="waybill_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waybill Number</label>
                                    <input type="text" name="waybill_no" id="update_waybill_no" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Waybill Number"  required="" readonly> 
                                </div>
                                <div>
                                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Waybill Type</label>
                                    <select name="type" id="update_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                        <option value="default">Default</option>
                                        <option value="cebu">Cebu</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="van_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Van Number</label>
                                    <input type="text" name="van_no" id="update_van_no" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Van Number">
                                </div>
                            </div>
                            
                            <div class="grid gap-4 mb-6 sm:grid-cols-2">
                                <!--- Consignee -->
                                <div>
                                    <div>
                                        <label for="consignee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consignee</label>
                                        <input type="text" name="consignee" id="update_consignee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Consignee"  required=""> 
                                        <div id="consignee_list" class="absolute z-10 bg-white shadow-md rounded-md w-full max-h-60 overflow-y-auto hidden"></div>
                                        <span class="text-xs text-red-600 text-left block" id="consignee_id_error"></span>
                                        <input type="hidden" name="consignee_id" id="consignee_id">
                                    </div>
                                    <div>
                                        <label for="consignee_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Consignee #</label>
                                        <input type="text" name="consignee_no" id="update_consignee_no" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            placeholder="Phone #" required="" disabled>
                                    </div>

                                    <div>
                                        <label for="billingAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Billing Address</label>
                                        <input type="text" name="billingAddress" id="update_billing_address" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            placeholder="Billing Address" required="" disabled>
                                    </div>                                     
                                </div>
                                <!--- Shipper -->
                                <div>
                                    <div>
                                        <label for="shipper" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipper</label>
                                        <input type="text" name="shipper" id="update_shipper" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Shipper" required="">
                                        <div id="shipper_list" class="absolute z-10 bg-white shadow-md rounded-md w-full max-h-60 overflow-y-auto hidden"></div>
                                        <span class="text-xs text-red-600 text-left block" id="consignee_id_error"></span>
                                        <input type="hidden" name="shipper_id" id="shipper_id">                                            
                                    </div>

                                    <div>
                                        <label for="shipper_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipper #</label>
                                        <input type="text" name="shipper_no" id="update_shipper_no" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            placeholder="Phone #" required="" disabled>
                                    </div>
                                    <div>
                                        <label for="shippingAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipping Address</label>
                                        <input type="text" name="shippingAddress" id="update_shipping_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            placeholder="Shipping Address" required="" disabled>
                                    </div>                                    
                                </div>
                               
                            </div>

                            <!-- Shipment Information -->
                            <div>
                                <label for="shipment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipment</label>
                                <input type="text" name="shipment" id="update_shipment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Shipment" required="">
                            </div>
                            <!--- Shipment Details -->
                            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                <div>
                                    <label for="cbm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CBM</label>
                                    <input type="number" name="cbm" id="update_cbm" max="999999.99" step="any" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 cbm" placeholder="CBM">
                                </div>
                                <div>
                                    <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Weight</label>
                                    <input type="number" name="weight" id="update_weight" max="999999.99" step="0.01" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 weight" placeholder="Weight">
                                </div>
                                <div>
                                    <label for="declared value" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Declared Value</label>
                                    <input type="number" name="declared value" id="update_declared_value" max="999999.99" step="0.01" class="form-field bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 declared" placeholder="Declared Value">
                                </div>
                            </div>
                            <div class="grid gap-4 mb-6 sm:grid-cols-3">
                                <div>
                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                    <input type="number" name="price" id="update_price" max="999999.99" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 price" placeholder="PHP">
                                </div>    
                                <div>
                                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                    <select name="status" id="update_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ $waybill->status == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>                                        
                                </div>                                                            
                            </div>


                                    </div>
                        <div class="flex items-center space-x-4">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Update Waybill</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Consignee Modal -->
        <!-- Add New Consignee Form -->
        <div id="addConsigneeForm" class="hidden fixed inset-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                <h2 class="text-xl font-bold mb-4">Add New Consignee</h2>
                <label for="consigneeName" class="block text-sm font-semibold mb-2">Consignee Name</label>
                <input type="text" id="consigneeName" placeholder="Consignee Name" class="w-full p-2 mb-4 border border-gray-300 rounded" />
                <label for="consigneePhone" class="block text-sm font-semibold mb-2">Consignee Phone</label>
                <input type="text" id="consigneePhone" placeholder="Consignee Phone" class="w-full p-2 mb-4 border border-gray-300 rounded" />
                <input type="text" id="billingAddress" placeholder="Billing Address" class="w-full p-2 mb-4 border border-gray-300 rounded" />
                <div class="flex justify-between">
                    <button id="submitConsignee" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                    <button id="closeConsigneeForm" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Close</button>
                </div>
            </div>
        </div>

        <!-- Add New Shipper Form mod: March 30 shipping address and labels update-->
        <div id="addShipperForm" class="hidden fixed inset-0 flex justify-center items-center z-50 bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                <h2 class="text-xl font-bold mb-4">Add New Shipper</h2>
                <label for="shipperName" class="block text-sm font-semibold mb-2">Shipper Name</label>
                <input type="text" id="shipperName" placeholder="Shipper Name" class="w-full p-2 mb-4 border border-gray-300 rounded" />
                <label for="shipperPhone" class="block text-sm font-semibold mb-2">Shipper Phone #</label>
                <input type="text" id="shipperPhone" placeholder="Shipper Phone #" class="w-full p-2 mb-4 border border-gray-300 rounded" />
                <label for="shippingAddress" class="block text-sm font-semibold mb-2">Shipping Address</label>
                <input type="text" id="shippingAddress" placeholder="Shipping Address" class="w-full p-2 mb-4 border border-gray-300 rounded" />
                <div class="flex justify-between">
                    <button id="submitShipper" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                    <button id="closeShipperForm" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Close</button>
                </div>
            </div>
        </div>


        <div id="tooltip" class="tooltip"></div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function() {

    let addNewItem = null; // Store reference to the "Add new consignee" div

    const updateWaybillModal = document.getElementById('updateWaybillModal');
    const flowbiteUpdateModal = new Modal(updateWaybillModal);

    //document.getElementById("#waybill-table tr:first-child").classlist.add('highlight');
    document.querySelector("#waybill-table tr:first-child").classList.add("highlight");
    // 
    // Adding waybill
    /*
    * Add a new waybill to the table
    */
    const openModalButton = document.getElementById("createWaybillModalButton");
    const addForm = document.getElementById("addWaybilLForm");
    openModalButton.addEventListener("click", function (event) {
        addForm.reset();
        document.querySelectorAll('.waybill-row').forEach(row => {
            row.classList.remove('highlight');
        });
    });

    addForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent page reload

        const formData = new FormData(this);

        fetch('/waybills', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json()) // Convert response to JSON
        .then(data => {
            if (data.success) {
                // Close modal
                document.getElementById('addCloseModal').click()

                // Add the new waybill to the table
                addWaybillToTable(data.waybill);
                
                // Clear the form
                addForm.reset();
                window.location.reload();
            } else {
                alert('Failed to create waybill. Please try again.');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('An error occurred. Please try again.');
        });
    });


    //add row to DOM
    function addWaybillToTable(waybill) {
        let tableBody = document.querySelector('table tbody');

        // Create a new row element
        let newRow = document.createElement('tr');
        //newRow.className = "waybill-row border-b dark:border-gray-700";
        newRow.classList.add("highlight","waybill-row", "border-b", "dark:border-gray-700","highlight"); // Highlight the new row
        newRow.setAttribute("data-id", waybill.id);
        newRow.setAttribute("data-waybill_no", waybill.waybill_no);
        newRow.setAttribute("data-type", waybill.type);
        newRow.setAttribute("data-van_no", waybill.van_no);
        newRow.setAttribute("data-consignee_id", waybill.consignee_id);
        newRow.setAttribute("data-consignee_name", waybill.consignee_name);
        newRow.setAttribute("data-consignee_phone", waybill.consignee_phone);
        newRow.setAttribute("data-shipper_id", waybill.shipper_id);
        newRow.setAttribute("data-shipper_name", waybill.shipper_name);
        newRow.setAttribute("data-shipper_phone", waybill.shipper_phone);
        newRow.setAttribute("data-shipment", waybill.shipment);
        newRow.setAttribute("data-cbm", waybill.cbm);
        newRow.setAttribute("data-weight", waybill.weight);
        newRow.setAttribute("data-declared_value", waybill.declared_value);
        newRow.setAttribute("data-price", waybill.price);
        newRow.setAttribute("data-status", waybill.status);

        // Populate row with table cells
        newRow.appendChild(createTableCell(waybill.waybill_no, true)); // Waybill Number
        newRow.appendChild(createTableCell(waybill.consignee_name));   // Consignee Name
        newRow.appendChild(createTableCell(`PHP${waybill.price}`));    // Price
        newRow.appendChild(createTableCell(waybill.status));           // Status
        
        // Action Buttons Cell
        let actionCell = document.createElement('td');
        actionCell.className = "px-4 py-3 flex items-center justify-end";

        let editButton = document.createElement('button');
        editButton.type = "button";
        editButton.className = "update-Modal z-10 flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200";
        //editButton.setAttribute("data-modal-target", "updateWaybillModal");
        //editButton.setAttribute("data-modal-toggle", "updateWaybillModal");
        editButton.setAttribute("data-id", waybill.id);
        editButton.innerHTML = `
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
            </svg>
            Edit
        `;
       

        actionCell.appendChild(editButton);
        newRow.appendChild(actionCell);

        // Insert the new row at the top of the table
        tableBody.insertBefore(newRow, tableBody.firstChild);
        //addEditListener(editButton);
        editButton.addEventListener('click', function() {
            //addEditListener(this);
            console.log("Edit button clicked");
            
            document.getElementById('updateModalForm').reset();
            //remove highlight
            document.querySelectorAll('.waybill-row').forEach(row => {
                row.classList.remove('highlight');
            });
            const row = this.closest('.waybill-row');
            row.classList.add('highlight');
            const waybillId = this.getAttribute('data-id');

            // Fetch waybill data from table
            document.getElementById('update_waybill_id').value = waybillId;
            document.getElementById('update_waybill_no').value = row.dataset.waybill_no;
            document.getElementById('update_type').value = row.dataset.type;
            document.getElementById('update_van_no').value = row.dataset.van_no;
            document.getElementById('consignee_id').value = row.dataset.consignee_id;
            document.getElementById('update_consignee').value = row.dataset.consignee_name;
            document.getElementById('update_consignee_no').value = row.dataset.consignee_phone;
            document.getElementById('update_billing_address').value = row.dataset.billing_address;

            document.getElementById('shipper_id').value= row.dataset.shipper_id;
            document.getElementById('update_shipper').value = row.dataset.shipper_name;
            document.getElementById('update_shipper_no').value = row.dataset.shipper_phone;
            document.getElementById('update_shipping_address').value = row.dataset.shipping_address;
            document.getElementById('update_shipment').value = row.dataset.shipment;
            document.getElementById('update_cbm').value = row.dataset.cbm;
            document.getElementById('update_weight').value = row.dataset.weight;
            document.getElementById('update_declared_value').value = row.dataset.declared_value;
            document.getElementById('update_price').value = row.dataset.price;
            document.getElementById('update_status').value = row.dataset.status;

            //document.getElementById('updateWaybillModal').classList.remove('hidden');
            flowbiteUpdateModal.show();
        });
    }

    // Helper function to create a table cell
    function createTableCell(content, isHeader = false) {
        let cell = isHeader ? document.createElement('th') : document.createElement('td');
        cell.textContent = content;
        cell.className = "px-4 py-3";
        
        if (isHeader) {
            cell.setAttribute("scope", "row");
            cell.classList.add("font-medium", "text-gray-900", "whitespace-nowrap", "dark:text-white");
        }
        
        return cell;
    }



    const modal = document.getElementById('updateWaybillModal');
    const editButtons = document.querySelectorAll('.update-Modal');
    const closeModalButton = document.getElementById('closeModal');
    const editForm = document.getElementById('updateModalForm');

    // Open modal and fetch waybill data
    editListener(); // Add event listener to all edit buttons

    function addEditListener(button){
        button.addEventListener('click', function() {
            const waybillId = this.getAttribute('data-id');
            document.getElementById('updateModalForm').reset();
            //remove highlight
            document.querySelectorAll('.waybill-row').forEach(row => {
                row.classList.remove('highlight');
            });
            const row = this.closest('.waybill-row');
            row.classList.add('highlight');

            // Fetch waybill data from table
            document.getElementById('update_waybill_id').value = waybillId;
            document.getElementById('update_waybill_no').value = row.dataset.waybill_no;
            document.getElementById('update_type').value = row.dataset.type;
            document.getElementById('update_van_no').value = row.dataset.van_no;
            document.getElementById('consignee_id').value = row.dataset.consignee_id;
            document.getElementById('update_consignee').value = row.dataset.consignee_name;
            document.getElementById('update_consignee_no').value = row.dataset.consignee_phone;
            document.getElementById('update_billing_address').value = row.dataset.billing_address;
            document.getElementById('shipper_id').value= row.dataset.shipper_id;
            document.getElementById('update_shipper').value = row.dataset.shipper_name;
            document.getElementById('update_shipper_no').value = row.dataset.shipper_phone;
            document.getElementById('update_shipping_address').value = row.dataset.shipping_address; //march 29
            document.getElementById('update_shipment').value = row.dataset.shipment;
            document.getElementById('update_cbm').value = row.dataset.cbm;
            document.getElementById('update_weight').value = row.dataset.weight;
            document.getElementById('update_declared_value').value = row.dataset.declared_value;
            document.getElementById('update_price').value = row.dataset.price;
            document.getElementById('update_status').value = row.dataset.status;

        });//button event listener
    }

    function editListener(){
        document.querySelectorAll('button.update-Modal').forEach(button => {
            addEditListener(button);
        });//forEach button event listener
    }

    // Close modal
    closeModalButton.addEventListener('click', function() {
        modal.classList.add('hidden');
/*         document.querySelectorAll('.waybill-row').forEach(row => {
                row.classList.remove('highlight');
        }); */
    });

    // Handle form submission of the updateWaybillModal dialog
    /*
    ** Submit Handler of the Update Waybill Modal Dialog
    */
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const waybillId = document.getElementById('update_waybill_id').value;
        const formData = new FormData(this);
        formData.append('_method', 'PUT');  
        console.log('Form submit event triggered'); // 🔍 Debug Log
        fetch(`/waybills/${waybillId}/update`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modal = document.getElementById('updateWaybillModal'); // Replace with your modal's ID
                modal.classList.add('hidden');
                document.getElementById('closeModal').click();
                // Update the waybill in the table row
                const row = document.querySelector(`tr.waybill-row[data-id="${waybillId}"]`);

                window.location.reload();
            }else{
                alert('An error occurred while processing your request. Please try again.');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('An error occurred while processing your request. Please try again.');
        });
    });



        // Tooltip for tr hover
        let tooltip = document.getElementById("tooltip");

        document.querySelectorAll(".waybill-row").forEach(row => {

            row.addEventListener("mouseenter", function (event) {
                tooltip.textContent = this.dataset.details;
                tooltip.innerHTML = this.dataset.details;

                let details = `
                    <strong>Waybill No:</strong> ${this.dataset.waybill_no} <br>
                    <strong>Van No:</strong> ${this.dataset.van_no} <br>
                    <strong>Shipment:</strong> ${this.dataset.shipment} <br>
                    <strong>Status:</strong> ${this.dataset.status} <br>
                    <strong>Price:</strong> ${this.dataset.price} <br>
                    <strong>CBM:</strong> ${this.dataset.cbm} <br>
                    <strong>weight:</strong> ${this.dataset.weight} <br>
                    <strong>declared value:</strong> ${this.dataset.declared_value} <br>
                    <strong>Shipper:</strong> ${this.dataset.shipper_id} ${this.dataset.shipper_name} ${this.dataset.shipping_address} (${this.dataset.shipper_phone}) <br>
                    <strong>Consignee:</strong> ${this.dataset.consignee_id} ${this.dataset.consignee_name} ${this.dataset.billing_address} (${this.dataset.consignee_phone})
                `;

            tooltip.innerHTML = details;

                tooltip.style.display = "block";
            });

            row.addEventListener("mousemove", function (event) {            
                tooltip.style.left = event.pageX + 15 + "px";
                tooltip.style.top = event.pageY + 15 + "px";
            });

            row.addEventListener("mouseleave", function () {
                tooltip.style.display = "none";
            });
        });

/*
** Consignee Auto-Complete 
*/
    //auto-complete consignee for the updateWaybillModal
    const consigneeNameField = document.getElementById('update_consignee');
    const consigneeIdField = document.getElementById('consignee_id');
    const consigneeList = document.getElementById('consignee_list');
    const consigneeNoField = document.getElementById('update_consignee_no');
    const consigneeBillingAddress = document.getElementById('add_billing_address');

    let typingTimer;
    const doneTypingInterval = 200;

    //Trigger auto-complete on keyup event
    consigneeNameField.addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            if (consigneeNameField.value) {
                typingTimer = setTimeout(searchConsignees, doneTypingInterval);
            } else {
                consigneeList.innerHTML = '';
                consigneeList.classList.add('hidden');
            }
    });//consigneeNameField

    // Search consignees - used by consigneeNameField keyup event; Update Waybill Modal
    function searchConsignees() {
        const query = consigneeNameField.value.trim();

        // Don't search for empty queries
        if (query === '') {
            consigneeList.innerHTML = '';
            consigneeList.classList.add('hidden');
            return;
        }

        fetch(`/consignees/search?query=${query}`)
            .then(response => response.json())
            .then(data => {
                consigneeList.innerHTML = ''; // Clear previous list

                if (data.length > 0) {
                    // Populate the list with matching consignees
                    data.forEach(consignee => {
                        const item = document.createElement('div');
                        item.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer');
                        item.textContent = `${consignee.name} (${consignee.phone_number})`;

                        item.addEventListener('click', function() {
                            consigneeNameField.value = consignee.name;
                            consigneeIdField.value = consignee.id;
                            consigneeNoField.value = consignee.phone_number;
                            consigneeBillingAddress.value=consignee.billing_address;
                            document.getElementById('update_billing_address').value=consignee.billing_address;
                            consigneeList.classList.add('hidden');
                        });

                        consigneeList.appendChild(item);
                    });
                    consigneeList.classList.remove('hidden');
                } else {
                    // If no results found, show option to add new consignee
                    // Allow User to Add New Consignee
                    const addNewItem = document.createElement('div');
                    addNewItem.classList.add('p-2', 'text-blue-600', 'cursor-pointer', 'hover:bg-gray-100');
                    addNewItem.textContent = `Add new consignee: ${query}`;
                    
                    // Handle the "Add New Consignee" click event
                    addNewItem.addEventListener('click', function() {
                        addNewConsignee(query);
                    });

                    consigneeList.appendChild(addNewItem);
                    consigneeList.classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            }); //fetch /consignees/search?query
    }

/*
** Add New Consignee Form **
** Show the add consignee form when auto-complete does not return any results
*/
    const addConsigneeForm = document.getElementById('addConsigneeForm');
    const consigneePhoneField = document.getElementById('consigneePhone');
    const submitConsigneeButton = document.getElementById('submitConsignee');
    const closeConsigneeButton = document.getElementById('closeConsigneeForm');


    function addNewConsignee(query) { //show the add consignee form
        console.log('addNewConsignee called with:', query);

        // Select the form and show it
        const form = document.getElementById('addConsigneeForm');
        //clear the consigneePhone field
        consigneePhoneField.value = '';
        document.getElementById('billingAddress').value = '';

        if (form) {
            form.classList.remove('hidden'); // Show the form
            console.log('Form is now visible');

            // Optionally, set some form fields with the query value
            // Example: setting the consignee name field
            const consigneeNameField = document.getElementById('consigneeName');
            consigneeNameField.value = query;

        } else {
            console.error('Form not found');
        }
    }
    /**************end of addNewConsignee(query) *******/

    // Show Add New Consignee Form
    let previousModal = null; // Store the previous modal

    // Close Add New Consignee Form
    function closeAddConsigneeForm() {
        const addConsigneeForm = document.getElementById('addConsigneeForm');

        addConsigneeForm.classList.add('hidden'); // Hide the form

        // Only show updateWaybillModal if it was previously open
        if (previousModal) {
            previousModal.classList.remove('hidden');
        }
    }

    // Handler to close the form
    closeConsigneeButton.addEventListener('click', function() {
        closeAddConsigneeForm(); // Simply hide the form
    });

    //submit the AddConsigneeForm
    // Handle the Submit button click event
    document.getElementById('submitConsignee').addEventListener('click', function() {
        const consigneeName = document.getElementById('consigneeName').value.trim();
        const consigneePhone = document.getElementById('consigneePhone').value.trim();
        const billingAddress = document.getElementById('billingAddress').value.trim();
        // Validate the input
        if (!consigneeName || !consigneePhone) {
            alert("Please provide both name and phone number.");
            return;
        }

        // Get CSRF token from the meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log("CSRF Token:", csrfToken);
        // Perform the submit action, such as making a request to your server
        fetch('/consignees/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the request
            },
            body: JSON.stringify({
                name: consigneeName,
                phone_number: consigneePhone,
                billing_address: billingAddress // Add billing address if needed
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Consignee added:', data);

            // Hide the form after submission
            const addForm = document.getElementById('addConsigneeForm');
            addForm.classList.add('hidden');
            document.getElementById('consignee_id').value = data.newConsignee.id;
            document.getElementById('add_consignee_id').value = data.newConsignee.id;
            document.getElementById('add_consignee_no').value = data.newConsignee.phone_number;
            document.getElementById('update_consignee_no').value = data.newConsignee.phone_number;
            document.getElementById('update_billing_address').value = data.newConsignee.billing_address; //March 30
            document.getElementById('add_billing_address').value = data.newConsignee.billing_address; //March 30
            // Optionally, you can refresh the list of consignees or update the UI
                        // Remove the "Add New Consignee" div if it exists
            if (addNewItem) {
                addNewItem.remove();
                addNewItem = null; // Reset reference
            }
        })
        .catch(error => {
            console.error('Error adding consignee:', error);
            alert('There was an error adding the consignee.');
        });
    });


    const addShipperForm = document.getElementById('addShipperForm');
    const shipperPhoneField = document.getElementById('shipperPhone');
    const submitShipperButton = document.getElementById('submitShipper');
    const closeShipperButton = document.getElementById('closeShipperForm');

    function addNewShipper(query){
        const shipperNameField = document.getElementById('shipperName'); //the AddShipperForm field not the updateWaybillModal
        console.log('addNewShipper called with:', query);

        // Select the form and show it
        const form = document.getElementById('addShipperForm');
        //clear the consigneePhone field
        shipperPhoneField.value = '';
        document.getElementById('shippingAddress').value = '';

        if (form) {
            form.classList.remove('hidden'); // Show the form
            console.log('Add Shipper Form is now visible');

            //default shipperNameField to 
            shipperNameField.value = query;


        } else {
            console.error('Form not found');
        }        
    }

    //submit the AddShipperForm
    // Handle the Submit button click event
    document.getElementById('submitShipper').addEventListener('click', function() {
        const shipperName = document.getElementById('shipperName').value.trim(); //from the addShipperForm
        const shipperPhone = document.getElementById('shipperPhone').value.trim();

        // Validate the input
        if (!shipperName || !shipperPhone) {
            alert("Please provide both name and phone number.");
            return;
        }

        // Get CSRF token from the meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Perform the submit action, such as making a request to your server
        fetch('/shippers/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the request
            },
            body: JSON.stringify({
                name: shipperName,
                phone_number: shipperPhone,
                shipping_address: document.getElementById('shippingAddress').value, // Add shipping address if needed
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Shipper added:', data);

            // Hide the form after submission
            const addForm = document.getElementById('addShipperForm');
            addForm.classList.add('hidden');

            //Update createWaybillModal & updateWaybillModal from server data
            document.getElementById('shipper_id').value = data.newShipper.id;
            document.getElementById('add_shipper_id').value = data.newShipper.id;
            document.getElementById('update_shipper_no').value = data.newShipper.phone_number;
            document.getElementById('add_shipper_no').value = data.newShipper.phone_number;
            document.getElementById('update_shipping_address').value = data.newShipper.shipping_address; //March 30
            document.getElementById('add_shipping_address').value = data.newShipper.shipping_address; //March 30

            // Optionally, you can refresh the list of consignees or update the UI
                        // Remove the "Add New Shipper" div if it exists
            if (addNewItem) {
                addNewItem.remove();
                addNewItem = null; // Reset reference
            }
        })
        .catch(error => {
            console.error('Error adding consignee:', error);
            alert('There was an error adding the consignee.');
        });
    });


    /******************************** */


        // Hide consignee list when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target !== consigneeNameField && e.target !== consigneeList) {
                consigneeList.classList.add('hidden');
            }
     
        });

        //shipper auto-complete
        const shipperNameField = document.getElementById('update_shipper');
        const shipperList = document.getElementById('shipper_list');
        const shipperIdField = document.getElementById('shipper_id');
        const shipperNoField = document.getElementById('update_shipper_no');

        function searchShippers() {
            const query = shipperNameField.value;
            const shippingAddress=document.getElementById('update_shipping_address');

            fetch(`/shippers/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    shipperList.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(shipper => {
                            const item = document.createElement('div');
                            item.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer');
                            item.textContent = `${shipper.name} (${shipper.phone_number})`;
                            
                            //When user clicks from list - update Modal Form
                            item.addEventListener('click', function() {
                                shipperNameField.value = shipper.name;
                                shipperIdField.value = shipper.id;
                                shipperNoField.value = shipper.phone_number;
                                shippingAddress.value=shipper.shipping_address;
                                shipperList.classList.add('hidden');
                            });
                            
                            shipperList.appendChild(item);
                        });
                        shipperList.classList.remove('hidden');
                    } else {

                        // Create "Add New Shipper" button
                        addNewItem = document.createElement('div');
                        addNewItem.classList.add('p-2', 'text-blue-600', 'cursor-pointer', 'hover:bg-gray-100');
                        addNewItem.textContent = `Add new shipper: ${query}`;

                        // Handle click event to show the add shipper form
                        addNewItem.addEventListener('click', function() {
                            shipperList.classList.add('hidden'); // Hide dropdown list
                            document.getElementById("shipperPhone").value = '';
                            addNewShipper(query);
                        });

                        shipperList.appendChild(addNewItem); //add this div part of dropdown
                        shipperList.classList.remove('hidden'); // show dropdown

                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        shipperNameField.addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            if (shipperNameField.value) {
                typingTimer = setTimeout(searchShippers, doneTypingInterval);
            } else {
                shipperList.innerHTML = '';
                shipperList.classList.add('hidden');
            }
        });


        /* Auto Complete for the Add Waybill Form */

        const addConsigneeNameField = document.getElementById('add_consignee');
        const addConsigneeIdField = document.getElementById('add_consignee_id');
        const addConsigneeList = document.getElementById('add_consignee_list');
        const addConsigneeNoField = document.getElementById('add_consignee_no');
        const addBillingAddress = document.getElementById('add_billing_address');
        addConsigneeNameField.addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            if (addConsigneeNameField.value) {
                typingTimer = setTimeout(addSearchConsignees, doneTypingInterval);
            } else {
                addConsigneeList.innerHTML = '';
                addConsigneeList.classList.add('hidden');
            }
        });




    function addSearchConsignees() {
        const query = addConsigneeNameField.value.trim();
        if (!query) return; // Don't search for empty queries

        fetch(`/consignees/search?query=${query}`)
            .then(response => response.json())
            .then(data => {
                addConsigneeList.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(consignee => {
                        const item = document.createElement('div');
                        item.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer');
                        item.textContent = `${consignee.name} (${consignee.phone_number})`;

                        item.addEventListener('click', function() {
                            addConsigneeNameField.value = consignee.name;
                            addConsigneeIdField.value = consignee.id;
                            addConsigneeNoField.value = consignee.phone_number;
                            addBillingAddress.value = consignee.billing_address;

                            addConsigneeList.classList.add('hidden');
                        });

                        addConsigneeList.appendChild(item);
                    });
                } else {
                    // Create "Add New Consignee" button
                    addNewItem = document.createElement('div');
                    addNewItem.classList.add('p-2', 'text-blue-600', 'cursor-pointer', 'hover:bg-gray-100');
                    addNewItem.textContent = `Add new consignee: ${query}`;

                    // Handle click event to show the add consignee form
                    addNewItem.addEventListener('click', function() {
                        consigneeList.classList.add('hidden'); // Hide dropdown list
                        document.getElementById("consigneePhone").value = '';
                        document.getElementById("billingAddress").value = '';
                        addNewConsignee(query);
                        
                    });

                    

                    addConsigneeList.appendChild(addNewItem);
                }

                // Make sure the list is visible
                addConsigneeList.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }


        //auto complete for shipper in add waybill form
        const addShipperNameField = document.getElementById('add_shipper');
        const addShipperList = document.getElementById('add_shipper_list');
        const addShipperIdField = document.getElementById('add_shipper_id');
        const addShipperNoField = document.getElementById('add_shipper_no');
        const addShippingAddress = document.getElementById('add_shipping_address');
        function addSearchShippers() {
            const query = addShipperNameField.value;
            fetch(`/shippers/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    addShipperList.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(shipper => {
                            const item = document.createElement('div');
                            item.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer');
                            item.textContent = `${shipper.name} (${shipper.phone_number})`;
                            
                            item.addEventListener('click', function() {
                                addShipperNameField.value = shipper.name;
                                addShipperIdField.value = shipper.id;
                                addShipperNoField.value = shipper.phone_number;
                                addShippingAddress.value= shipper.shipping_address;

                                addShipperList.classList.add('hidden');
                            });
                            
                            addShipperList.appendChild(item);
                        });
                        //addShipperList.classList.remove('hidden');
                    } else {
                        // Create "Add New Shipper" button
                        // Create "Add New Consignee" button
                        addNewItem = document.createElement('div');
                        addNewItem.classList.add('p-2', 'text-blue-600', 'cursor-pointer', 'hover:bg-gray-100');
                        addNewItem.textContent = `Add new shipper: ${query}`;

                        // Handle click event to show the add consignee form
                        addNewItem.addEventListener('click', function() {
                            addShipperList.classList.add('hidden'); // Hide dropdown list
                            document.getElementById("add_shipper_no").value = '';
                            document.getElementById("shippingAddress").value = '';
                            addNewShipper(query);
                            
                        });

                        addShipperList.appendChild(addNewItem);
                            
                        }
                    addShipperList.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        addShipperNameField.addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            if (addShipperNameField.value) {
                typingTimer = setTimeout(addSearchShippers, doneTypingInterval);
            } else {
                addShipperList.innerHTML = '';
                addShipperList.classList.add('hidden');
            }
        });


    /*** Make Modal draggable  ***/
    // draggable modal
    const modalHeader = document.querySelector('.modal-header');

    let offsetX, offsetY, isDragging = false;

    // Mouse down - Start dragging
    modalHeader.addEventListener('mousedown', (e) => {
        isDragging = true;
        offsetX = e.clientX - modal.getBoundingClientRect().left;
        offsetY = e.clientY - modal.getBoundingClientRect().top;
    });

    // Mouse move - Track dragging
    document.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        modal.style.left = `${e.clientX - offsetX}px`;
        modal.style.top = `${e.clientY - offsetY}px`;
    });

    // Mouse up - Stop dragging
    document.addEventListener('mouseup', () => {
        isDragging = false;
    });    
    
     document.querySelectorAll('.waybill-form').forEach(form => {
    const cbmInput = form.querySelector('.cbm');
    const weightInput = form.querySelector('.weight');
    const declaredInput = form.querySelector('.declared');
    const priceInput = form.querySelector('.price');

    function computePrice() {
      const cbm = parseFloat(cbmInput.value);
      const weight = parseFloat(weightInput.value);
      const declared = parseFloat(declaredInput.value);

      if (cbm > 0 && weight > 0 && declared > 0) {
        const formula1 = cbm * 3360;
        const formula2 = weight * 10;
        const formula3 = declared * 0.08;
        const finalPrice = Math.max(formula1, formula2, formula3);
        priceInput.value = finalPrice.toFixed(2);
      } else {
        priceInput.value = '';
      }
    }

    [cbmInput, weightInput, declaredInput].forEach(input => {
      input.addEventListener('input', computePrice);
    });
  });

    const modalButton = document.getElementById('createWaybillModalButton');
    const previewSpan = document.getElementById('preview-waybill-no');
    const typeSelect = document.querySelector('select[name="type"]'); // dropdown selector

    function fetchNextWaybillNo(type) {
        console.log("Fetching next number for type:", type); // 🔍 Debug

        previewSpan.textContent = 'Loading...';

        fetch(`/waybills/next-number?type=${type}`)
        .then(res => res.json())
        .then(data => {
            console.log("Fetched data:", data); // 🔍 Debug
            previewSpan.textContent = data.next_waybill_no;
        })
        .catch(error => {
            console.error("Error fetching next number:", error);
            previewSpan.textContent = 'Error';
        });
    }

    // When modal button is clicked
    modalButton.addEventListener('click', function () {
        const selectedType = typeSelect.value;
        fetchNextWaybillNo(selectedType);
    });
    // When dropdown value changes
    typeSelect.addEventListener('change', function () {
        fetchNextWaybillNo(this.value);
    });

    const table = document.getElementById("wb-table");
    if (!table) return;

    const headers = table.querySelectorAll("thead th");
    let sortDirection = 1; // 1 = asc, -1 = desc
    let currentSortedColumn = null;

    headers.forEach((header, columnIndex) => {
        header.style.cursor = "pointer";
        header.addEventListener("click", () => {
            const tbody = table.querySelector("tbody");
            const rowsArray = Array.from(tbody.querySelectorAll("tr"));

            // Toggle sort direction if same column
            if (currentSortedColumn === columnIndex) {
                sortDirection *= -1;
            } else {
                sortDirection = 1;
                currentSortedColumn = columnIndex;
            }

            rowsArray.sort((a, b) => {
                const aText = a.children[columnIndex].textContent.trim();
                const bText = b.children[columnIndex].textContent.trim();

                // Numeric sort if both values are numbers
                const aNum = parseFloat(aText.replace(/[^0-9.-]+/g, ""));
                const bNum = parseFloat(bText.replace(/[^0-9.-]+/g, ""));
                const isNumeric = !isNaN(aNum) && !isNaN(bNum);

                if (isNumeric) {
                    return (aNum - bNum) * sortDirection;
                } else {
                    return aText.localeCompare(bText) * sortDirection;
                }
            });

            // Re-append rows in sorted order
            rowsArray.forEach(row => tbody.appendChild(row));
        });
    });

});
</script>

</x-app-layout>