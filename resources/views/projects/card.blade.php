<div class="card" style="height:200px">

    <h2 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-500 pl-4">
      <a href="{{ $project->path() }}">{{ $project->title }} </a>
    </h2>
    <div class="text-gray-500 font-normal text-sml">{{ Str::limit($project->description, 100) }}</div>
  </div>
