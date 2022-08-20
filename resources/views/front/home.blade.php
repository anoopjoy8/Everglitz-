@extends('front.layout')
@section('title','{{$title}}')
@section('header-script')
<!----- Add custom scripts here --->
@endsection
@section('content')
<div class="banner">

    <div class="container">
        <div class="row m-0">
            <div class="col-lg-7 col-md-6 p-0 pe-md-2">
                <div class="carousel_cap">
                    <h2 data-aos="fade-right" data-aos-duration="500" data-aos-delay="100" class="aos-init aos-animate">Event &amp; Wedding Planner</h2>
                    <p data-aos="fade-right" data-aos-duration="500" data-aos-delay="100" class="aos-init aos-animate">
                        Based Out of Kerala, with Plush Surroundings Just Suited to Make Your Occasion Very Special, Memorable and Absolutely Personalized.
                    </p>
                </div>
            </div>

            <div class="col-lg-5 col-md-6 p-0 ps-md-2">
                <div class="row m-0 inq home_con">

                    <h2>Contact Us</h2>
                    <div class="col-md-12"><input name="fname" type="text" placeholder="Name" value="" required=""></div>
                    <div class="col-md-12"><input name="lname" type="text" placeholder="Location" value="" required=""></div>

                    <div class="col-md-12"><input name="email" type="text" placeholder="Email" value="" required=""></div>
                    <div class="col-md-12"><input name="phone" type="text" placeholder="Phone" value="" required=""></div>


                    <div class="col-md-12">
                        <textarea name="comment" cols="" rows="" placeholder="Message" required=""></textarea>
                    </div>

                    <div class="row m-0">
                        <div class="col-md-12">
                            <button name="send" type="submit" class="red_btn btn_com border-0 px-5">Send <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>
</div>

<div class="content01 py-5">
    <div class="container">

        <div class="text-center">
            <h2 class="com">Our Portifolio
                <hr>
            </h2>
        </div>
        <p data-aos="zoom-in" class="aos-init aos-animate">Everglitz Events is known for planning and designing beautiful events. We have created a planning experience that is as thorough as it is seamless, bringing a customized and tailored planning experience to those who value
            the of hosting, and desire to create an approachable, detail rich, wedding celebration. </p>


        <div class="row">

            <div class="col-md-4">
                <div class="bnr_box">
                    <div class="img"><img src="{{env('ASSET_URL')}}/Front/images/event_1.png"></div>
                    <div class="img_txt">
                        <h3>Birds of Fairy</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bnr_box">
                    <div class="img"><img src="{{env('ASSET_URL')}}/Front/images/event_2.png"></div>
                    <div class="img_txt">
                        <h3>Birds of Fairy</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="bnr_box">
                    <div class="img"><img src="{{env('ASSET_URL')}}/Front/images/event_3.png"></div>
                    <div class="img_txt">
                        <h3>Birds of Fairy</h3>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


<div class="content01 py-5 why_bg">
    <div class="container">

        <div class="text-center">
            <h2 class="com">Services
                <hr>
            </h2>
        </div>

        <div class="row">



            <div class="col-md-12 list p-md-0 p-3">

                <div class="box05 row m-0">
                    <div class="col-md-3 p-0 crs_img">
                        <img src="{{env('ASSET_URL')}}/Front/images/serv_1.png">
                    </div>
                    <div class="col-md-9 flx_serv">
                        <h2><a href="#">Planning your Dream day:</a></h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>


                <div class="box05 row m-0">
                    <div class="col-md-3 p-0 crs_img">
                        <img src="{{env('ASSET_URL')}}/Front/images/serv_2.png">
                    </div>
                    <div class="col-md-9 flx_serv">
                        <h2><a href="#">Stage designing and Conceptualization </a></h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>


                <div class="box05 row m-0">
                    <div class="col-md-3 p-0 crs_img">
                        <img src="{{env('ASSET_URL')}}/Front/images/serv_3.png">
                    </div>
                    <div class="col-md-9 flx_serv">
                        <h2><a href="#">Production and Site management </a></h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book.</p>
                    </div>
                </div>


            </div>

        </div>

    </div>
</div>
@endsection
@section('footer-script')
<!----- Add custom scripts here --->
@endsection