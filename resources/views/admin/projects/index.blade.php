@extends('layouts.admin')

@section('content')

@if(session('messaggio'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Congratulazioni!</strong> {{session('messaggio')}}
</div>
@endif

<div class="table-responsive mt-5">
    
    <form class="mx-2" action="{{route("project.create")}}">
        <button class="bg-primary mb-3 border-0p-1 rounded" type="submit">Add new project</button>
    </form>

        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Authors</th>
                    {{-- <th scope="col">Project link</th> --}}
                    {{-- <th scope="col">Github link</th> --}}
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td><img width="100" src="{{ asset('storage/' . $project->thumb) }}"></td>
                        <td class="text-wrap" scope="row">{{$project->title}}</td>
                        <td class="text-wrap">{{$project->description}}</td>
                        <td class="text-wrap">{{$project->authors}}</td>
                        {{-- <td class="text-wrap"><a class="text-wrap" href="{{$project->projectlink}}">{{$project->projectlink}}</a></td>
                        <td class="text-wrap"><a class="text-wrap" href="{{$project->githublink}}">{{$project->githublink}}</a></td> --}}
                        <td>
                            <div class="d-flex">
                                <form action="{{route("project.show", [$project->id])}}">
                                    <button class="bg-success border-0 py-1 px-4 rounded" type="submit"><i class="fa-solid fa-eye"></i></button>
                                </form>
                            
                                <form class="mx-2" action="{{route("project.edit", [$project->id])}}">
                                    <button class="bg-warning border-0 py-1 px-4 rounded" type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>
        
                                <form action="{{route("project.destroy", [$project->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-danger border-0 py-1 px-4 rounded" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
    
            </tbody>
        </table>
   
    {{$projects->links('pagination::bootstrap-5')}}

</div>
@endsection