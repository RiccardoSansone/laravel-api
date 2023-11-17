@extends('layouts.admin')

@section('content')



<div class="col-6 mx-auto">
    <h1 class="text-center mt-4">EDIT YOUR PROJECT</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{ route('project.update', $project) }}" method="post" enctype="multipart/form-data">

        @csrf

        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control p-2" name="title" id="title" aria-describedby="helpId" placeholder="write a title" value="{{ old('title') }}">
            <small id="titleHelper" class="form-text text-muted">write a title for ypur project</small>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control p-2" name="description" id="description" aria-describedby="helpId" placeholder="write description" value="{{ old('description') }}">
            <small id="descriptionHelper" class="form-text text-muted">write a description for your project</small>
        </div>

        <div class="mb-3">
            <label for="authors" class="form-label">Authors</label>
            <input type="text" class="form-control p-2" name="authors" id="authors" aria-describedby="help" placeholder="Write authors" value="{{ old('authors') }}">
            <small id="authorsHelper" class="form-text text-muted">write the authors of your project</small>
        </div>

        <div class="mb-3">
            <label for="githublink" class="form-label">Link Github</label>
            <input type="url" class="form-control" name="githublink" id="githublink" aria-describedby="helpId" placeholder="Scrivi una descrizione per il tuo progetto" value="{{ old('githublink', $project->githublink) }}">
            <small id="githublinkHelper" class="form-text text-muted">Scrivi un link Github per il tuo progetto</small>
        </div>

        <div class="mb-3">
            <label for="projectlink" class="form-label">Link Progetto</label>
            <input type="url" class="form-control" name="projectlink" id="projectlink" aria-describedby="helpId" placeholder="Scrivi una descrizione per il tuo progetto" value="{{ old('projectlink', $project->projectlink) }}">
            <small id="projectlinkHelper" class="form-text text-muted">Scrivi un link Github per il tuo progetto</small>
        </div>

        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <select multiple class="form-select" name="technologies[]" id="technologies">
                <option disabled>Select one</option>

                <!-- TODO: Improve validation outputs -->
                @foreach ($technologies as $technology )
                <option value="{{$technology->id}}" {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>{{$technology->name_tech}}</option>
                @endforeach


            </select>
        </div>
        @error('technologies')
        <div class="text-danger">{{$message}}</div>
        @enderror
        
        <div class="mb-3">
            <label for="type_id" class="form-label">typologies</label>
            <select class="form-select @error('type_id') is-invalid  @enderror" name="type_id" id="type_id">
                <option selected disabled>Select a typologies</option>
                <option value="">Untyped</option>
        
                @forelse ($types as $type)
                <option value="{{$type->id}}" {{ $type->id == old('type_id') ? 'selected' : '' }}>{{$type->type}}</option>
                @empty
        
                @endforelse
        
        
            </select>
        </div>
        @error('type_id')
        <div class="text-danger">{{$message}}</div>
        @enderror
        
        <div class="mb-3">
            <label for="thumb" class="form-label">Scegli una immagine</label>
            <input type="file" class="form-control" name="thumb" id="thumb" placeholder="Scegli una immagine per il tuo progetto" aria-describedby="thumb_helper" value="{{ old('thumb') }}">
            <div id="thumb_helper" class="form-text">Inserisci una immagine</div>
        </div>

        <button type="submit" class="btn btn-primary 3">Update Project</button>
    </form>
</div>


@endsection