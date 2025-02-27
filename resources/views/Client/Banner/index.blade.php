<div class="banner-container">
    <div class="banner-wrapper">
        @foreach($banners as $banner)
            <div class="banner-slide">
                <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}">
            </div>
        @endforeach
        @if(count($banners) > 0)
            <div class="banner-slide">
                <img src="{{ asset($banners[0]->image) }}" alt="{{ $banners[0]->title }}">
            </div>
        @endif
    </div>
</div>

<style>
    .banner-container {
        width: 100%;
        overflow: hidden;
        position: relative;
    }

    .banner-wrapper {
        display: flex;
        transition: transform 0.5s ease-in-out;
        will-change: transform;
    }

    .banner-slide {
        min-width: 100%;
        flex: 0 0 auto;
    }

    .banner-slide img {
        width: 100%;
        height: 350px;
        object-fit: cover;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .banner-slide img {
            height: 200px;
        }
    }

</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const bannerWrapper = document.querySelector(".banner-wrapper");
        const slides = document.querySelectorAll(".banner-slide");
        const totalSlides = slides.length;
        let index = 0;

        function nextSlide() {
            index++;
            bannerWrapper.style.transition = "transform 0.5s ease-in-out";
            bannerWrapper.style.transform = `translateX(-${index * 100}%)`;

            if (index === totalSlides - 1) {
                setTimeout(() => {
                    bannerWrapper.style.transition = "none";
                    index = 0;
                    bannerWrapper.style.transform = `translateX(0)`;
                }, 500);
            }
        }

        setInterval(nextSlide, 3000);
    });
</script>
