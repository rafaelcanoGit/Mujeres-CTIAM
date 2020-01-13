<ul class="slide-home">   
    @foreach ($sliders as $slider)
        <li class="slide-1" style="background-image: url('{{asset($slider->rutaPublica)}}')">
            <div class="back-slide">
                <div class="margen">
                    <div class="txt-slide">
                        <h1>{{$slider->nombre}}</h1>
                        <a href="{{$slider->link}}" target="_blank">Conoce</a>
                    </div> <!-- /txt-slide -->
                </div> <!-- /margen -->
            </div> <!-- /back-slide -->
        </li>
    @endforeach
</ul> <!-- /slide-home -->
<script>
    $('.slide-home').slick({
        autoplay: true,
        autoplaySpeed: 4000,
        arrows: false,
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1
    });
</script>
