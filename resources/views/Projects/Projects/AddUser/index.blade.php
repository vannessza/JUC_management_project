<div class="add-person-form" id="team-members">
    @foreach($team as $user)
    <div class="row g-0">
      <div class="col-md-4">
          <div class="d-flex align-items-center" style="width: 65px; height: 65px;">
              <img src="{{ asset('storage/profiles/' . $user->profile->image) }}" class="img-fluid rounded-circle" alt="{{ $user->username }}">
              <h5 class="card-title ml-3 m-2">{{ $user->username }}</h5>
          </div>
      </div>
    </div>
   @endforeach
</div>