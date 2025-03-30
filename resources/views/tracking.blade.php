<x-front-layout>
    <script>function showTable(){
        document.getElementById('waybillTable').style.display = 'block';
    } </script>
    <div class="px-12">
        <div class="mt-8 flex-col justify-center p-12 bg-gray-100 rounded-xl">
            <form class="max-w-md mx-auto" method="GET" action="{{route('logs.track')}}"> 
                @csrf
                @method('GET')  
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" id="default-search" name="waybill_no" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="insert waybill number ex. 123456" required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>               
            @if(request()->has('waybill_no'))
                @if ($logs)
                    <div class="justify-center items-center overflow-auto rounded-lg">
                        <table id="waybillTable" class="shadow-md w-full rounded-xl text-sm text-left rtl:text-right text-gray-500 my-8">
                            <thead class="bg-blue-400 text-xs text-gray-700 uppercase rounded-xl">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Waybill Number
                                    </th>
                                <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Updated at
                                    </th>
            
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr class="bg-white border-b rounded-xl">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{$log->waybill->waybill_no}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$log->status}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$log->updated_at}}
                                    </td>
                            
                                
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div> 
                @endif
            @endif
        </div>
    </div>

</x-front-layout>