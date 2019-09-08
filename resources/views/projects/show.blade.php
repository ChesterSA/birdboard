@extends ('layouts.app')
@section('content')
<header class="flex items-center mb-3">
  <div class="flex justify-between w-full items-center">
    <p class="text-gray-600 text-sml font-normal">
      <a href="/projects">My Projects</a> / {{ $project->title }}
    </p>

    <a href="{{ $project->path() . '/edit'}}" class="button">Edit Project</a>
  </div>
</header>

<main>
  <div class="lg:flex -mx-3">
    <div class="lg:w-3/4 px-3 mb-6">
      <div class="mb-8">
        <h2 class="text-gray-600 text-sml font-normal text-base mb-3">Tasks</h2>

        @foreach($project->tasks as $task)
          <div class="card mb-3">
            <form method="POST" action="{{ $task->path() }}">
              @method('PATCH')
              @csrf

              <div class="flex">
                <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-500' : '' }}" />
                <input name = "completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}/>
              </div>

            </form>
          </div>
        @endforeach

        <div class="card mb-3">
          <form method="POST" action="{{ $project->path() . '/tasks' }}">
            @csrf
            <input placeholder="Add a Task..." class="w-full" name="body"/>
          </form>
        </div>
      </div>
      <div>
        <h2 class="text-gray-600 text-sml font-normal text-base mb-3">General Notes</h2>

        <form method="POST" action="{{ $project->path() }}">
          @csrf
          @method('PATCH')
          <textarea
           class="card w-full mb-4"
           placeholder="Anything you want to note down?"
           style="min-height:150px"
           name="notes">{{$project->notes}}</textarea>
          <button type="submit" class="button">Save</button>
        </form>
        @include ('errors')

      </div>

    </div>
    <div class="lg:w-1/4 px-3">
      @include('projects.card')
      @include('projects.activity.card')
    </div>
  </div>
</main>

@endsection
