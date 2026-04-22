<div class="px-0 px-md-3">
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <!-- Place somewhere in the <body> of your page -->
            <style>
                /* Limit slider image height to prevent box from becoming too tall */
                .slider-img { max-height: 540px; width: auto; object-fit: cover; }
                @media (max-width: 768px) { .slider-img { max-height: 240px; } }
            </style>
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <img class="img-fluid mx-auto d-block slider-img" src="{{ asset('images/gallery/full/slide-1.jpg') }}" alt="slide" />
                        <p class="flex-caption">Adventurer Cheesecake Brownie</p>
                    </li>
                    <li>
                        <img class="img-fluid mx-auto d-block slider-img" src="../images/gallery/full/slide-2.jpg" alt="slide" />
                        <p class="flex-caption">Adventurer Lemon</p>
                    </li>
                    <li>
                        <img class="img-fluid mx-auto d-block slider-img" src="../images/gallery/full/slide-3.jpg" alt="slide" />
                        <p class="flex-caption">Adventurer Donut</p>
                    </li>z
                    <li>
                        <img class="img-fluid mx-auto d-block slider-img" src="../images/gallery/full/slide-4.jpg" alt="slide" />
                        <p class="flex-caption">Adventurer Cheesecake Brownie</p>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</div>
