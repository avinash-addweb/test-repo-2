<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <table class="table-fixed w-full ">
                <tr>
                    <td class="border px-4 py-2">
                        <form wire:submit="search">
                            <input type="text" wire:model="query" placeholder="Enter Permission" class="rounded-md">
                            <button class="px-4 py-2 bg-red-500 text-gray-900 cursor-pointer rounded-md">Search Permission</button>
                            <input type="reset" value="Reset" wire:click="cleanFilter()"  class="px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer rounded-md"/>
                        </form>
                    </td>
                    <td class="border px-4 py-2 text-right">
                        <button wire:click="create()" class="my-4 inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
                            Create Permission
                        </button>
                    </td>
                </tr>
            </table>
            
            <br /><hr/>
            @if($isModalOpen)
                @include('livewire.admin.permissions.create')
            @endif
            <br /><br />
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        @foreach ($columns as $c)
                            <th class="px-4 py-2" wire:click="sort('{{ $c }}')">
                                <button>
                                    {{ ucwords($c) }}
                                    @if ($sortColumn == $c)
                                        @if ($sortDirection == 'asc')
                                            &uarr;
                                        @else
                                            &darr;
                                        @endif
                                    @endif
                                </button>
                            </th>
                        @endforeach
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissionList as $permission)
                    <tr>
                        <td class="border px-4 py-2">{{ $permission->id }}</td>
                        <td class="border px-4 py-2">{{ $permission->name }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $permission->id }})"
                                class="px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer rounded-md">Edit</button>
                            <button onclick="confirm('Confirm delete?') || event.stopImmediatePropagation()" wire:click="delete({{ $permission->id }})"
                                class="px-4 py-2 bg-red-100 text-gray-900 cursor-pointer rounded-md">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $permissionList->links() }}
            
        </div>
    </div>
</div>