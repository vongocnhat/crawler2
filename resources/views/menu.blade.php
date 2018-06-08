<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="{{ route('home') }}">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      @foreach($categories as $category)
      <li class="nav-item">
        <a class="nav-link" href="{{ route('categoryCus.show', $category->id) }}">{{ $category->name }}</a>
      </li>
      @endforeach
      <li class="nav-item">
        <a class="nav-link" href="{{ route('website.index') }}">Trang Quản Lý Admin</a>
      </li>
    </ul>
  </div>
</nav>