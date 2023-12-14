@extends('projects.layouts.main')

@section('container')
<div class="form-signin">
    <h1>Add User to Project:</h1>
    <form method="POST" action="{{ route('projects.add_user_store', ['projects' => $projects->id]) }}">
      @csrf
      <div class="mb-3">
        <label for="disabledSelect" class="form-label">List User</label>
        <select id="user_id" class="form-select" name="user_id" required>
          @foreach ($availableUsers as $user)
          <option value="{{ $user->id }}">{{ $user->username }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-success">Add User</button>
    </form>
</div>


@endsection