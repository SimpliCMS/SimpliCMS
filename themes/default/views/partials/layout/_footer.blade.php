<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-muted">&copy; {{ now()->year }} {{ config('app.name', 'SimpliCMS') }}</p>
        <ul class="nav col-md-4 justify-content-end">
            @include('partials.menu.main', ['menuItems' => Core::getMenu('Footer Menu')])
        </ul>
    </footer>
</div>