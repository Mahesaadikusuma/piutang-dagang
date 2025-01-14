<div x-data="{ open: false }">
    @include('includes.header')

    <section id="Category" class="container max-w-[1130px] mx-auto mb-[102px]">
        <h2 class="font-semibold text-[32px]">Category</h2>
        <div class="category-carousel carousel">
            <div
                class="carousel-cell  w-fit h-fit p-[1px] rounded-2xl bg-img-transparent hover:bg-img-purple-to-orange transition-all duration-300">
                <a href="" class="group category-card w-full h-full block">
                    <div
                        class="flex flex-col p-[18px] rounded-2xl w-[210px] bg-img-black-gradient group-active:bg-img-black transition-all duration-300">
                        <div class="w-[58px] h-[58px] flex shrink-0 items-center justify-center">
                            <img src="{{ asset('assets/images/icons/cart.svg') }}" alt="icon">
                        </div>
                        <div class="px-[6px] flex flex-col text-left">
                            <p class="font-bold text-sm">All Products</p>
                            <p class="text-xs text-belibang-grey">Everything in One Place</p>
                        </div>
                    </div>
                </a>
            </div>
            <div
                class="carousel-cell w-fit h-fit p-[1px] rounded-2xl bg-img-transparent hover:bg-img-purple-to-orange transition-all duration-300">
                <a href="" class="group category-card w-full h-full block">
                    <div
                        class="flex flex-col p-[18px] rounded-2xl w-[210px] bg-img-black-gradient group-active:bg-img-black transition-all duration-300">
                        <div class="w-[58px] h-[58px] flex shrink-0 items-center justify-center">
                            <img src="{{ asset('assets/images/icons/laptop.svg') }}" alt="icon">
                        </div>
                        <div class="px-[6px] flex flex-col text-left">
                            <p class="font-bold text-sm">Templates</p>
                            <p class="text-xs text-belibang-grey">Designs Made Easy</p>
                        </div>
                    </div>
                </a>
            </div>
            <div
                class="carousel-cell w-fit h-fit p-[1px] rounded-2xl bg-img-transparent hover:bg-img-purple-to-orange transition-all duration-300">
                <a href="" class="group category-card w-full h-full block">
                    <div
                        class="flex flex-col p-[18px] rounded-2xl w-[210px] bg-img-black-gradient group-active:bg-img-black transition-all duration-300">
                        <div class="w-[58px] h-[58px] flex shrink-0 items-center justify-center">
                            <img src="{{ asset('assets/images/icons/book.svg') }}" alt="icon">
                        </div>
                        <div class="px-[6px] flex flex-col text-left">
                            <p class="font-bold text-sm">Ebooks</p>
                            <p class="text-xs text-belibang-grey">Read and Learn</p>
                        </div>
                    </div>
                </a>
            </div>
            <div
                class="carousel-cell w-fit h-fit p-[1px] rounded-2xl bg-img-transparent hover:bg-img-purple-to-orange transition-all duration-300">
                <a href="" class="group category-card w-full h-full block">
                    <div
                        class="flex flex-col p-[18px] rounded-2xl w-[210px] bg-img-black-gradient group-active:bg-img-black transition-all duration-300">
                        <div class="w-[58px] h-[58px] flex shrink-0 items-center justify-center">
                            <img src="{{ asset('assets/images/icons/hat.svg') }}" alt="icon">
                        </div>
                        <div class="px-[6px] flex flex-col text-left">
                            <p class="font-bold text-sm">Courses</p>
                            <p class="text-xs text-belibang-grey">Expand Your Skills</p>
                        </div>
                    </div>
                </a>
            </div>
            <div
                class="carousel-cell w-fit h-fit p-[1px] rounded-2xl bg-img-transparent hover:bg-img-purple-to-orange transition-all duration-300">
                <a href="" class="group category-card w-full h-full block">
                    <div
                        class="flex flex-col p-[18px] rounded-2xl w-[210px] bg-img-black-gradient group-active:bg-img-black transition-all duration-300">
                        <div class="w-[58px] h-[58px] flex shrink-0 items-center justify-center">
                            <img src="{{ asset('assets/images/icons/pen.svg') }}" alt="icon">
                        </div>
                        <div class="px-[6px] flex flex-col text-left">
                            <p class="font-bold text-sm">Fonts</p>
                            <p class="text-xs text-belibang-grey">Typography Selection</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section id="NewProduct" class="container max-w-[1130px] mx-auto mb-[102px] flex flex-col gap-8">
        <h2 class="font-semibold text-[32px]">New Product</h2>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-[22px]">
            @foreach ($products as $item)
                <div class="product-card flex flex-col rounded-[18px] bg-[#181818] overflow-hidden">
                    <a wire:navigate href="{{ route('detailPage', $item->slug) }}"
                        class="thumbnail w-full h-[180px] flex shrink-0 overflow-hidden relative">
                        <img src="{{ Storage::url($item->thumbnail) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                        <p class="backdrop-blur bg-black/30 rounded-[4px] p-[4px_8px] absolute top-3 right-[14px]">
                            {{ $item->priced }}
                        </p>
                    </a>
                    <div class="p-[10px_14px_12px] h-full flex flex-col justify-between gap-[14px]">
                        <div class="flex flex-col gap-1 ">
                            <p
                                class="bg-[#2A2A2A] font-semibold text-xs text-belibang-grey rounded-[4px] p-[4px_6px] w-fit py-2">
                                {{ Str::limit($item->category->name, 50, '...') }}
                            </p>

                            <a wire:navigate href="{{ route('detailPage', $item->slug) }}"
                                class="font-semibold line-clamp-2 hover:line-clamp-none py-2">
                                {{ $item->name }}
                            </a>

                        </div>
                        {{-- <div class="flex items-center gap-[6px]">
                            <div class="w-6 h-6 flex shrink-0 items-center justify-center rounded-full overflow-hidden">
                                <img src="{{ asset('assets/images/logos/framer.png') }}"
                                    class="w-full h-full object-cover" alt="logo">
                            </div>
                            <a href="" class="font-semibold text-xs text-belibang-grey">Framer</a>
                        </div> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="Testimonial" class="mb-[102px] flex flex-col gap-8">
        <div class="container max-w-[1130px] mx-auto flex justify-between items-center">
            <h2 class="font-semibold text-[32px]">Customers Are Happy <br>With Our Products</h2>
            <div class="flex gap-[14px] items-center">
                <button class="btn-prev w-10 h-10 shrink-0 rounded-full overflow-hidden rotate-180">
                    <img src="assets/images/icons/circle-arrow-r.svg" alt="icon">
                </button>
                <button class="btn-next w-10 h-10 shrink-0 rounded-full overflow-hidden">
                    <img src="assets/images/icons/circle-arrow-r.svg" alt="icon">
                </button>
            </div>
        </div>
        <div class="w-full overflow-x-hidden no-scrollbar">
            <div class="testi-carousel" data-flickity>
                <div class="flex w-[calc((100vw-1130px-20px)/2)] shrink-0"></div>
                <div
                    class="testimonial-card bg-[#181818] rounded-[20px] flex mr-5 w-[420px] min-h-[256px] shrink-0 overflow-hidden">
                    <div
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('assets/images/backgrounds/Testimonials-image.png')] bg-contain bg-no-repeat bg-top">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center ga-[6px]">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                            </div>
                            <p class="leading-[26px]">Using these templates has boosted my productivity significantly.
                                Highly recommended for all designers!</p>
                        </div>
                        <div class="flex gap-[14px] items-center">
                            <div class="w-12 h-12 flex shrink-0 rounded-full overflow-hidden">
                                <img src="assets/images/photos/photo1.png" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <div class="flex flex-col justify-center-center">
                                <p
                                    class="font-semibold text-left leading-[170%] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                    Sarah Lopez</p>
                                <p class="font-semibold text-left text-xs text-belibang-grey">Brand Design Consultant
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="testimonial-card bg-[#181818] rounded-[20px] flex mr-5 w-[420px] min-h-[256px] shrink-0 overflow-hidden">
                    <div
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('assets/images/backgrounds/Testimonials-image.png')] bg-contain bg-no-repeat bg-top">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center ga-[6px]">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                            </div>
                            <p class="leading-[26px]">Using these templates has boosted my productivity significantly.
                                Highly recommended for all designers!</p>
                        </div>
                        <div class="flex gap-[14px] items-center">
                            <div class="w-12 h-12 flex shrink-0 rounded-full overflow-hidden">
                                <img src="assets/images/photos/photo1.png" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <div class="flex flex-col justify-center-center">
                                <p
                                    class="font-semibold text-left leading-[170%] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                    Sarah Lopez</p>
                                <p class="font-semibold text-left text-xs text-belibang-grey">Brand Design Consultant
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="testimonial-card bg-[#181818] rounded-[20px] flex mr-5 w-[420px] min-h-[256px] shrink-0 overflow-hidden">
                    <div
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('assets/images/backgrounds/Testimonials-image.png')] bg-contain bg-no-repeat bg-top">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center ga-[6px]">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                            </div>
                            <p class="leading-[26px]">Using these templates has boosted my productivity significantly.
                                Highly recommended for all designers!</p>
                        </div>
                        <div class="flex gap-[14px] items-center">
                            <div class="w-12 h-12 flex shrink-0 rounded-full overflow-hidden">
                                <img src="assets/images/photos/photo2.png" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <div class="flex flex-col justify-center-center">
                                <p
                                    class="font-semibold text-left leading-[170%] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                    Michael Chen</p>
                                <p class="font-semibold text-left text-xs text-belibang-grey">UI/UX Designer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="testimonial-card bg-[#181818] rounded-[20px] flex mr-5 w-[420px] min-h-[256px] shrink-0 overflow-hidden">
                    <div
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('assets/images/backgrounds/Testimonials-image.png')] bg-contain bg-no-repeat bg-top">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center ga-[6px]">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                            </div>
                            <p class="leading-[26px]">Using these templates has boosted my productivity significantly.
                                Highly recommended for all designers!</p>
                        </div>
                        <div class="flex gap-[14px] items-center">
                            <div class="w-12 h-12 flex shrink-0 rounded-full overflow-hidden">
                                <img src="assets/images/photos/photo1.png" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <div class="flex flex-col justify-center-center">
                                <p
                                    class="font-semibold text-left leading-[170%] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                    Emily Robinson</p>
                                <p class="font-semibold text-left text-xs text-belibang-grey">Senior Graphic Designer
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="testimonial-card bg-[#181818] rounded-[20px] flex mr-5 w-[420px] min-h-[256px] shrink-0 overflow-hidden">
                    <div
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('assets/images/backgrounds/Testimonials-image.png')] bg-contain bg-no-repeat bg-top">
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center ga-[6px]">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                                <img src="{{ asset('assets/images/icons/star.svg') }}" alt="star">
                            </div>
                            <p class="leading-[26px]">Using these templates has boosted my productivity significantly.
                                Highly recommended for all designers!</p>
                        </div>
                        <div class="flex gap-[14px] items-center">
                            <div class="w-12 h-12 flex shrink-0 rounded-full overflow-hidden">
                                <img src="assets/images/photos/photo1.png" class="w-full h-full object-cover"
                                    alt="photo">
                            </div>
                            <div class="flex flex-col justify-center-center">
                                <p
                                    class="font-semibold text-left leading-[170%] bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                    Sarah Lopez</p>
                                <p class="font-semibold text-left text-xs text-belibang-grey">Brand Design Consultant
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        $('.category-carousel').flickity({
            // options
            cellAlign: 'left',
            contain: true,
            pageDots: false,
            prevNextButtons: false,
            draggable: true,
            freeScroll: true
        });

        // Testimonial
        $('.testi-carousel').flickity({
            // options
            cellAlign: 'left',
            contain: true,
            pageDots: false,
            prevNextButtons: false,
        });

        // previous
        $('.btn-prev').on('click', function() {
            $('.testi-carousel').flickity('previous', true);
        });

        // next
        $('.btn-next').on('click', function() {
            $('.testi-carousel').flickity('next', true);
        });
    </script>
@endpush
