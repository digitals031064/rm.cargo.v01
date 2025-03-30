<x-app-layout>
    <div class="py-12">
        <section class="bg-gray-50 p-3 sm:p-5 antialiased">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="mb-4">
                    <table class="w-full text-sm text-left mb-4 text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-4">Name</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">User Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{$user->name}}</th>
                                <td class="px-4 py-3">{{$user->email}}</td>
                                <td class="px-4 py-3">{{$user->usertype}}</td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links('pagination::tailwind') }}
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-4">Waybill Number</th>
                                <th scope="col" class="px-4 py-3">User</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Action</th>
                                <th scope="col" class="px-4 py-3">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                            <tr class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{$log->waybill->waybill_no}}</th>
                                <td class="px-4 py-3">{{$log->user->name}}</td>
                                <td class="px-4 py-3">{{$log->status}}</td>
                                <td class="px-4 py-3">{{$log->action}}</td>
                                <td class="px-4 py-3">{{$log->updated_at}}</td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $logs->links('pagination::tailwind') }}
            </div>
        </section>
        
    </div>
</x-app-layout>