<x-app-layout>
    <div class="py-12">
        <section class="bg-gray-50 p-3 sm:p-5 antialiased">
            <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                <div class="">
                    <div class="columns-2 mx-4">
                        <h2>User List</h2>
                        <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button" id="createUserModalButton" data-modal-target="createUserModal" data-modal-toggle="createUserModal" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add New User
                            </button>
                        </div>
                    </div>
                    <!-- Main modal -->
                    <div id="createUserModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Add User
                                    </h3>
                                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="createUserModal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <div class="px-4">
                                    <form class="space-y-4" action="{{route('staff-account.store')}}" method="POST">
                                        @csrf
                                        <div class="columns-2">
                                            <div>
                                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                            </div>
                                            <div>
                                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                            </div>
                                        </div>
                                        <div class="columns-2">
                                            <div>
                                                <label for="office" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Office</label>
                                                <select name="office" id="office" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option value="ZAM">ZAM</option>
                                                    <option value="CEB">CEB</option>
                                                    <option value="MNL">MNL</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required required minlength="8" />
                                            </div>
                                        </div>
                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add User</button>
                                            <button data-modal-hide="createUserModal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left my-4 text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-4">Name</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">User Type</th>
                                <th scope="col" class="px-4 py-3">Office</th>
                                <th scope="col" class="px-4 py-3">Action</th>
                            </tr>
                        </thead>
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ session('success') }}</span>
                            </div>
                        @endif
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="border-b">
                                <form method="POST" action="{{ route('user.updateOffice', $user->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{$user->name}}</th>
                                    <td class="px-4 py-3">{{$user->email}}</td>
                                    <td class="px-4 py-3">{{$user->usertype}}</td>
                                    <td class="px-4 py-3">
                                        <select name="office" class="border border-gray-300 rounded-xl px-2 py-1">
                                            @foreach (['ZAM', 'CEB', 'MNL'] as $office)
                                            <option value="{{ $office }}" {{ $user->office === $office ? 'selected' : '' }}>
                                                    {{$office}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-4 py-3"><button type="submit" class="font-medium text-blue-600 hover:underline">Update</button></td>
                                </form>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links('pagination::tailwind') }}
                    <table class="w-full text-sm text-left text-gray-500 my-4">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">User</th>
                                <th scope="col" class="px-4 py-3">Office</th>
                                <th scope="col" class="px-4 py-4">Waybill Number</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Action</th>
                                <th scope="col" class="px-4 py-3">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                            <tr class="border-b">
                                <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{$log->user->name}}</th>
                                <td class="px-4 py-3">{{$log->user->office}}</td>
                                <td class="px-4 py-3">{{$log->waybill->waybill_no}}</td>
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