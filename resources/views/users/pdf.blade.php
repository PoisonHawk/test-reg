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
