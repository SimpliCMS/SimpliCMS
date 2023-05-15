<div class="card">
    <div class="card-body">
        <div class="card-text font-weight-bold fs-5">Bio</div>
        <p class="card-text">{{ $profile->person->bio }}</p>
        @auth
        @if (Auth::user()->id == $user->id)
        <a href="{{ route('profile.settings') }}" class="btn btn-primary">Edit Profile</a>
        @endif
        @endauth
    </div>
</div>
