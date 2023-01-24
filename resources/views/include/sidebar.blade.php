<section class="col-lg-3 sidebar d-flex flex-column">
    <!-- Search Tab Starts here -->
    <form action="" class="search-box-wrapper d-flex align-items-center my-3">
        <input type="text" name="search" class="search" placeholder="ISBN, Title, Author or Keywords" />
        <button class="search-btn" type="submit">
            <i class="fa fa-search"></i>
        </button>
    </form>
    <!-- Search tab ends here -->
    <!-- Popular books categories info start -->
    <div class="sidebar-bk-ctgs-container d-lg-block d-sm-flex justify-content-end">
        <div class="sidebar-heading d-lg-block d-sm-inline-block bg-danger">
            <h2 class="text-white d-inline-block pop-ctgs-heading">
                Popular Categories
            </h2>
            <span class="sidebar-head-nav d-lg-none d-sm-inline-block">
                <i class="fa-solid fa-bars text-white"></i>
            </span>
        </div>
    </div>
    <!-- Popular books categories info end -->
    <ul id="bk-ctgs" class="bk-ctgs tabs">
        @foreach($categories as $category)

        <li class="d-flex justify-content-between selection-categories align-items-center tab {{ Request::is('category/'.$category->slug) ? 'active' : '' }}">
            <a class="bk-ctg text-decoration-none" href='{{ url('category/'.$category->slug) }}' >
                {{ Str::headline($category->category) }}
            </a>
            <div class="right-arrow">
                <i class="fa fa-chevron-right"></i>
            </div>
        </li>
        @endforeach
    </ul>
</section>

{{-- {{ Request::is('category/'.$category->slug) ? 'active' : '' }} --}}