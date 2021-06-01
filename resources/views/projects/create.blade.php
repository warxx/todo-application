@extends('layouts.main-layout')

@section('content')
<div class="container c-project">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="c-project__title">
                <h1>Create new project</h1>
            </div>
            <form action="/projects" method="POST" >
                @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description">
              </div>
              <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection