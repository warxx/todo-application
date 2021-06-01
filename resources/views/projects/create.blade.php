@extends('layouts.main-layout')

@section('content')
<div>
    <h1>Create new project</h1>
</div>
<form>
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="description">
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection