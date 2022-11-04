@extends('member.layouts.registration')
@section('content')
    <!-- ---------------------- login end ---------------------- -->
    <section id="registration_page_1" class="mtn_white_box">
        <div class="container">
            <div class="registration_box white_box">
                <p class="font_22 text_center">Complete Your Registration</p>

                <form action="">
                    <div class="input_box">
                        <div class="input_group">
                            <label for="email" class="font_14">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter email or phone number">
                        </div>

                        <div class="input_group">
                            <label for="firstname" class="font_14">First Name</label>
                            <input type="text" name="firstname" id="firstname" placeholder="Enter username">
                        </div>

                        <div class="input_group">
                            <label for="lasttname" class="font_14">Last Name</label>
                            <input type="text" name="lastname" id="lastname" placeholder="Enter username">
                        </div>

                        <div class="input_group">
                            <label for="mobile" class="font_14">Mobile Number</label>
                            <input type="number" name="mobile" id="mobile" placeholder="+880">
                        </div>

                        <div class="input_group input_password">
                            <div class="password_box toggle_box">
                                <label for="password" class="font_14">Password</label>
                                <input type="password" name="password" id="password" placeholder="Enter password">
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                            </div>

                            <div class="password_box">
                                <label for="confirm_password" class="font_14">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Re-type password">
                            </div>
                        </div>
                    </div>

                    <div class="input_box">
                        <div class="input_group">
                            <label for="photo-upload" class="font_14">Upload Profile Photo</label>
                            <div class="img_preview_box">
                                <div class="imgUp">
                                    <div class="img_group">
                                        <div class="imagePreview"></div>
                                        <i class="bi bi-x del"></i>
                                        <p class="font_14">image src here</p>
                                    </div>

                                    <div class="upload_btn_group">
                                        <label class="btn btn-primary">Upload
                                            <input type="file" class="uploadFile img" value="Upload Photo" name="photo-upload" accept="image/png, image/jpeg">
                                        </label>
                                        <p class="font_14">File Format:</p>
                                        <p class="font_14">jpg, png only</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="input_group">
                            <label for="school-name" class="font_14">School Name</label>
                            <select class="form-select" aria-label="Default select example" name="school-name">
                                <option selected>School Name</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>

                        <div class="input_group">
                            <div class="input_address">
                                <label class="font_14">School Address</label>
                                <div class="address_options">
                                    <select class="form-select" aria-label="Default select example" name="school-name">
                                        <option selected>Upazila/PS</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>

                                    <select class="form-select" aria-label="Default select example" name="school-name">
                                        <option selected>District</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('member.reg.step2') }}" class="btn_green_large">Next</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ---------------------- login end ---------------------- -->
@endsection
