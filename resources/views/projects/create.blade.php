@extends ('layouts.app')
@section('content')
  <h1>Create A Project</h1>

  <form method="POST" action="/projects">
    @csrf
    <div class="field">
      <label class="label" for="title">Title</label>

      <div class="control">
        <input type="text" class="input" name="title" placeholder="Title">
      </div>
    </div>

    <div class="field">
      <label class="label" for="description">Description</label>

      <div class="control">
        <textarea name="description" class="textarea"></textarea>
      </div>
    </div>

    <div class="field">

      <div class="control">
        <button type="submit" class="button is-link">Create</button>
        <a href="/projects">Cancel</a>
      </div>
    </div>
  </form>
@endsection
