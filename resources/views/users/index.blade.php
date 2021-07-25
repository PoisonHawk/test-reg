<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-end">
                        <a class="btn btn-blue mr-2" href="{{ route('users.create') }}">{{__('Register user')}}</a>
                        <a class="btn btn-blue" href="{{ URL::to('/users/pdf') }}">Export to PDF</a>                        
                    </div>
                    
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                <table class="table-fixed text-left">
                    <thead>
                        <tr>
                        <th class="w-1/4">Id</th>
                        <th class="w-1/4">Name</th>
                        <th class="w-1/4">Email</th>
                        <th class="w-1/4">Parent</th>
                        <th class="w-1/4">Company</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->parent->name}}({{$user->parent->email}})</td> 
                            <td>{{ $user->company->title}}</td>                                                     
                        </tr>
                    @endforeach
                    
                    </tbody>
                   
                </table>
                <div class="mt-5">
                    {{ $users->links() }}
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>