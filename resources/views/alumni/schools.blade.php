@extends('alumni.layouts.master')
@section('top_content')
    <div class="dashboard_search">
        <input type="search" placeholder="Search among 3032 Schools">
        <i class="bi bi-search"></i>
    </div>
@endsection
@section('content')


    <div class="data_table">
        <table class="table table-borderless table-hover">
            <thead class="datalist_heading">
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">School Name</th>
                <th scope="col">Location</th>
                <th scope="col">Number of students</th>
                <th scope="col">View</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <th scope="row">
                    <div class="data_profile_img">
                        <img src="images/gray.png" alt="">
                    </div>
                </th>
                <td class="data_name">School Full Name</td>
                <td>Upozila, Zila</td>
                <td>2343432</td>
                <td class="view_profile"><a href="#">View School.</a></td>
            </tr>

            <tr>
                <th scope="row">
                    <div class="data_profile_img">
                        <img src="images/gray.png" alt="">
                    </div>
                </th>
                <td class="data_name">School Full Name</td>
                <td>Upozila, Zila</td>
                <td>2343432</td>
                <td class="view_profile"><a href="{{ route('alumni.schoolProfile',['name']) }}">View School.</a></td>
            </tr>

            <tr>
                <th scope="row">
                    <div class="data_profile_img">
                        <img src="images/gray.png" alt="">
                    </div>
                </th>
                <td class="data_name">School Full Name</td>
                <td>Upozila, Zila</td>
                <td>2343432</td>
                <td class="view_profile"><a href="#">View School.</a></td>
            </tr>

            <tr>
                <th scope="row">
                    <div class="data_profile_img">
                        <img src="images/gray.png" alt="">
                    </div>
                </th>
                <td class="data_name">School Full Name</td>
                <td>Upozila, Zila</td>
                <td>2343432</td>
                <td class="view_profile"><a href="#">View School.</a></td>
            </tr>

            <tr>
                <th scope="row">
                    <div class="data_profile_img">
                        <img src="images/gray.png" alt="">
                    </div>
                </th>
                <td class="data_name">School Full Name</td>
                <td>Upozila, Zila</td>
                <td>2343432</td>
                <td class="view_profile"><a href="#">View School.</a></td>
            </tr>

            <tr>
                <th scope="row">
                    <div class="data_profile_img">
                        <img src="images/gray.png" alt="">
                    </div>
                </th>
                <td class="data_name">School Full Name</td>
                <td>Upozila, Zila</td>
                <td>2343432</td>
                <td class="view_profile"><a href="#">View School.</a></td>
            </tr>

            <tr>
                <th scope="row">
                    <div class="data_profile_img">
                        <img src="images/gray.png" alt="">
                    </div>
                </th>
                <td class="data_name">School Full Name</td>
                <td>Upozila, Zila</td>
                <td>2343432</td>
                <td class="view_profile"><a href="#">View School.</a></td>
            </tr>

            <tr>
                <th scope="row">
                    <div class="data_profile_img">
                        <img src="images/gray.png" alt="">
                    </div>
                </th>
                <td class="data_name">School Full Name</td>
                <td>Upozila, Zila</td>
                <td>2343432</td>
                <td class="view_profile"><a href="#">View School.</a></td>
            </tr>
            </tbody>
        </table>

        <nav aria-label="...">
            <ul class="pagination pagination-sm justify-content-end">
                <li class="page-item active" aria-current="page">
                    <span class="page-link">1</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#">6</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">12</a></li>
                <li class="page-item"><a class="page-link" href="#">13</a></li>
            </ul>
        </nav>
    </div>
@endsection
@section('scripts')
    @parent

@endsection
