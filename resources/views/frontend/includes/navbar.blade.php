<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
    <div class="navbar-nav ml-auto">
        <a href="{{route('frontend.homepage')}}" class="nav-item nav-link active">Home</a>
        <div class="nav-item dropdown">
            <a href="{{route('frontend.menu')}}" class="nav-link dropdown-toggle" data-toggle="dropdown">Food Category</a>
            <div class="dropdown-menu">
                <a href="{{route('frontend.menu')}}" class="dropdown-item">Main Menu</a>

                @foreach($food_categories as $category)
                    <a href="" class="dropdown-item">{{$category->title}}</a>
                @endforeach
            </div>
        </div>
        <a href="about.html" class="nav-item nav-link">About</a>
        <a href="feature.html" class="nav-item nav-link">Feature</a>
        <a href="team.html" class="nav-item nav-link">Chef</a>
        <a href="menu.html" class="nav-item nav-link">Menu</a>
        <a href="{{route('frontend.booking')}}" class="nav-item nav-link">Booking</a>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
            <div class="dropdown-menu">
                <a href="blog.html" class="dropdown-item">Blog Grid</a>
                <a href="single.html" class="dropdown-item">Blog Detail</a>
            </div>
        </div>
        <a href="contact.html" class="nav-item nav-link">Contact</a>
    </div>
</div>
