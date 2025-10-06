<div
    class="relative flex min-h-screen w-full flex-col justify-between overflow-hidden bg-blue-300 bg-cover bg-center px-16 py-8"
    id="carousel_container"
>
    <div class="absolute inset-0 z-0">
        <div
            class="carousel-slider flex h-full w-[300%] transition-transform duration-1000 ease-in-out"
        >
            <div
                class="h-full w-1/3 bg-cover bg-center"
                style="background-image: url('{{ asset("images/c1.png") }}')"
            ></div>
            <div
                class="h-full w-1/3 bg-cover bg-center"
                style="background-image: url('{{ asset("images/c2.png") }}')"
            ></div>
            <div
                class="h-full w-1/3 bg-cover bg-center"
                style="background-image: url('{{ asset("images/c3.png") }}')"
            ></div>
        </div>
        <div class="bg-opacity-40 absolute inset-0"></div>
    </div>

    <div class="relative z-10">
        <img
            src="{{ asset("images/auth_hero.png") }}"
            alt=""
            width="400"
            class="mb-4"
        />
    </div>

    <div class="relative z-10 max-w-4xl">
        <h1
            class="mb-6 text-5xl leading-tight font-bold text-white md:text-6xl"
        >
            ชาว มข. มาทำกิจกรรมจิตอาสาสากันเถอะ !!!
        </h1>
        <p
            class="mb-8 max-w-3xl text-xl leading-relaxed text-gray-100 md:text-2xl"
        >
            ว็บจิตอาสามหาวิทยาลัยขอนแก่น
            เป็นพื้นที่สำหรับนักศึกษาที่ต้องการมีส่วนร่วมในการพัฒนาสังคมและชุมชน
            เรารวบรวมกิจกรรมจิตอาสา แนะนำโครงการต่าง ๆ
            และอำนวยความสะดวกในการบันทึกชั่วโมงจิตอาสา
        </p>

        <div class="mb-12 flex gap-4">
            <div
                class="carousel-indicator bg-opacity-90 active h-4 w-24 cursor-pointer rounded-xl bg-white shadow-lg transition-all duration-300 hover:w-28"
                data-slide="0"
            ></div>
            <div
                class="carousel-indicator bg-opacity-60 h-4 w-24 cursor-pointer rounded-xl bg-white shadow-lg transition-all duration-300 hover:w-28"
                data-slide="1"
            ></div>
            <div
                class="carousel-indicator bg-opacity-60 h-4 w-24 cursor-pointer rounded-xl bg-white shadow-lg transition-all duration-300 hover:w-28"
                data-slide="2"
            ></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.querySelector('.carousel-slider');
            const indicators = document.querySelectorAll('.carousel-indicator');
            let currentSlide = 0;

            // Auto slide every 5 seconds
            function autoSlide() {
                currentSlide = (currentSlide + 1) % 3;
                updateSlider();
            }

            function updateSlider() {
                const translateX = -currentSlide * 33.333;
                slider.style.transform = `translateX(${translateX}%)`;

                indicators.forEach((indicator, index) => {
                    if (index === currentSlide) {
                        indicator.classList.add('active');
                        indicator.classList.remove('bg-opacity-50');
                        indicator.classList.add('bg-opacity-80');
                    } else {
                        indicator.classList.remove('active');
                        indicator.classList.remove('bg-opacity-80');
                        indicator.classList.add('bg-opacity-50');
                    }
                });
            }

            // Manual slide control
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentSlide = index;
                    updateSlider();
                });
            });

            // Start auto sliding
            setInterval(autoSlide, 5000);
        });
    </script>
</div>
