<div id="cover-photo" class="cover-photo">
    <img id="cover" src="https://i.imgur.com/pkhWxWu.jpeg" alt="User Cover">
    <img id="avatar" src="{{ $profile->getProfileAvatar() }}" alt="User Avatar">
    <div class="basic-info">
        <h4>{{ $user->name }}</h4>

    </div>
    <button id="cover-edit" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Cover</button>
    @include('profile::partials.show._nav')
</div>

