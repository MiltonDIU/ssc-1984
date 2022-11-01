@extends('alumni.layouts.registration')
@section('content')
    <!-- ---------------------- login end ---------------------- -->
    <section id="registration_page_2" class="mtn_white_box">
        <div class="container">
            <div class="registration_box white_box">
                <p class="font_22 text_center">Complete Your Registration</p>

                <form action="">
                    <div class="input_box">
                        <div class="input_group">
                            <div class="input_wrap">
                                <div class="gender_input">
                                    <label for="gender" class="font_14">Gender</label>
                                    <select class="form-select gender_select" aria-label="Default select example" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="birth_date_input">
                                    <label for="birth_date" class="font_14">Date of birth</label>
                                    <input type="date" id="birth_date" name="birth_date">
                                </div>
                            </div>
                        </div>

                        <div class="input_group">
                            <label for="current_address" class="font_14">Current Address</label>
                            <input type="text" name="current_address" id="current_address" placeholder="House No#20 (3rd Floor) Road 17, Nikunja 2">
                        </div>

                        <div class="input_group">
                            <div class="input_wrap">
                                <div class="area_input">
                                    <label for="area" class="font_14">Area</label>
                                    <input type="text" name="area" id="area" placeholder="Dhanmondi">
                                </div>

                                <div class="city_input">
                                    <label for="city" class="font_14">City</label>
                                    <select class="form-select" aria-label="Default select example" name="city">
                                        <option selected>Dhaka</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input_group">
                            <div class="parmanent_address_top input_wrap">
                                <label for="parmanent_address" class="font_14">Parmanent Address</label>
                                <div class="wraper">
                                    <input type="checkbox" class="checkbox_input" id="partmanent_current" name="partmanent_current" value="">
                                    <label for="partmanent_current" class="font_14">Same as present</label>
                                </div>
                            </div>
                            <input type="text" name="parmanent_address" id="parmanent_address" placeholder="House No#20 (3rd Floor) Road 17, Nikunja 2">
                        </div>

                        <div class="input_group">
                            <div class="input_wrap">
                                <div class="area_input">
                                    <label for="area" class="font_14">Area</label>
                                    <input type="text" name="area" id="area" placeholder="Dhanmondi">
                                </div>

                                <div class="city_input">
                                    <label for="city" class="font_14">City</label>
                                    <select class="form-select" aria-label="Default select example" name="city">
                                        <option selected>Dhaka</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input_box">
                        <div class="input_group">
                            <label for="work_info" class="font_14">Work Information</label>
                            <select class="form-select" aria-label="Default select example" name="work_info">
                                <option selected>Field of work</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div class="input_group">
                            <label for="organization" class="font_14">Organization</label>
                            <input type="text" name="organization" id="organization" placeholder="Organization">
                        </div>

                        <div class="input_group">
                            <label for="designation" class="font_14">Designation</label>
                            <input type="text" name="designation" id="designation" placeholder="Designation">
                        </div>

                        <div class="input_group">
                            <div class="wraper">
                                <input type="checkbox" class="checkbox_input" id="partmanent_current" name="partmanent_current" value="" checked>
                                <label for="partmanent_current" class="font_14">Currently working here</label>
                            </div>
                        </div>

                        <p class="more_info">Add more working info</p>

                        <div class="btn_group">
                            <a href="{{ route('alumni.registration1') }}" class="back_btn">Back</a>
                            <a href="{{ route('alumni.profile') }}" class="done_btn">Done</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ---------------------- login end ---------------------- -->

@endsection
