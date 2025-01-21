<div>
    <header class="w-full pt-[74px] pb-[103px] relative z-0">
        <div class="container max-w-[1130px]  flex flex-col z-10">
            <div class="flex flex-col gap-4 mt-7 z-10">
                <p class="bg-[#2A2A2A] font-semibold text-belibang-grey rounded-[4px] p-[8px_16px] w-fit">
                    {{ $product->category->name }}
                </p>
                <h1 class="font-semibold text-2xl lg:text-5xl">
                    {{ $product->name }}
                </h1>
            </div>
        </div>
        <div class="background-image w-full h-full absolute top-0 overflow-hidden z-0">
            <img src="{{ Storage::url($product->thumbnail) }}" class="w-full h-full object-cover" alt="hero image">
        </div>
        <div class="w-full h-1/3 absolute bottom-0 bg-gradient-to-b from-belibang-black/0 to-belibang-black z-0"></div>
        <div class="w-full h-full absolute top-0 bg-belibang-black/95 z-0"></div>
    </header>


    <section id="DetailsContent" class="container max-w-[1130px] mx-auto mb-[32px] relative -top-[70px]">
        <div class="flex flex-col gap-8">
            <div class="w-full h-[400px] sm:h-[500px] md:h-[700px] flex shrink-0 rounded-[20px] overflow-hidden">
                <img src="{{ Storage::url($product->thumbnail) }}" class="w-full h-full object-cover bg-center"
                    alt="hero image">
            </div>
            <div class="flex flex-col gap-8 lg:flex-row sm:gap-8 relative -mt-[93px]">
                <div
                    class="flex flex-col p-[30px] gap-5 bg-[#181818] rounded-[20px]  w-full lg:w-[700px] mt-[90px] h-fit">
                    <div class="flex flex-col gap-4">
                        <p class="font-semibold text-xl">Overview</p>
                        <p class="text-belibang-grey leading-[30px] text-justify">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-col w-full lg:w-[366px] gap-[30px] flex-nowrap overflow-y-visible">
                    <div class="p-[2px] bg-img-purple-to-orange rounded-[20px] flex w-full h-fit">
                        <div class="w-full p-[28px] bg-[#181818] rounded-[20px] flex flex-col gap-[26px]">
                            <div class="flex flex-col gap-3">
                                <p
                                    class="font-semibold text-4xl bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                    {{ $product->priced }}
                                </p>
                                {{-- <div class="flex flex-col gap-[10px]">
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('assets/images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">100% Original Content</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('assets/images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">Lifetime Support</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('assets/images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">High-Performance Code</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('assets/images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">Customizable Themes</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('assets/images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">Responsive Design</p>
                                    </div>
                                    <div class="flex items-center gap-[10px]">
                                        <div class="w-4 h-4 flex shrink-0">
                                            <img src="{{ asset('assets/images/icons/check.svg') }}" alt="icon">
                                        </div>
                                        <p class="text-belibang-grey">Comprehensive Documentation</p>
                                    </div>
                                </div> --}}
                            </div>
                            <a wire:navigate href="{{ route('checkoutPage', $product->slug) }}"
                                class="bg-[#2D68F8] text-center font-semibold p-[12px_20px] rounded-full hover:bg-[#083297] active:bg-[#062162] transition-all duration-300 mt-32">
                                Check Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="NewProduct" class="container max-w-[1130px] mx-auto mb-[102px] flex flex-col gap-8">
        <h2 class="font-semibold text-[32px]">More Product</h2>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-[22px]">
            @forelse ($this->products as $item)
                <div class="product-card flex flex-col rounded-[18px] bg-[#181818] overflow-hidden">
                    <a href="{{ route('detailPage', $item->slug) }}"
                        class="thumbnail w-full h-[180px] flex shrink-0 overflow-hidden relative">
                        <img src="{{ Storage::url($item->thumbnail) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                        <p class="backdrop-blur bg-black/30 rounded-[4px] p-[4px_8px] absolute top-3 right-[14px]">
                            {{ $item->price }}
                        </p>
                    </a>
                    <div class="p-[10px_14px_12px] h-full flex flex-col justify-between gap-[14px]">
                        <div class="flex flex-col gap-1">
                            <a href="{{ route('detailPage', $item->slug) }}"
                                class="font-semibold line-clamp-2 hover:line-clamp-none">
                                {{ $item->name }}
                            </a>
                            <p
                                class="bg-[#2A2A2A] font-semibold text-xs text-belibang-grey rounded-[4px] p-[4px_6px] w-fit">
                                {{ $item->category->name }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <p>Belum ada produk</p>
            @endforelse
        </div>
    </section>

    <section id="Testimonial" class="mb-[102px] flex flex-col gap-8">
        <div class="container max-w-[1130px] mx-auto flex justify-between items-center">
            <h2 class="font-semibold text-[32px]">Customers Are Happy <br>With Our Products</h2>
            <div class="flex gap-[14px] items-center">
                <button class="btn-prev w-10 h-10 shrink-0 rounded-full overflow-hidden rotate-180">
                    <img src="{{ asset('assets/images/icons/circle-arrow-r.svg') }}" alt="icon">
                </button>
                <button class="btn-next w-10 h-10 shrink-0 rounded-full overflow-hidden">
                    <img src="{{ asset('assets/images/icons/circle-arrow-r.svg') }}" alt="icon">
                </button>
            </div>
        </div>
        <div class="w-full overflow-x-hidden no-scrollbar">
            <div class="testi-carousel" data-flickity>
                <div class="flex w-[calc((100vw-1130px-20px)/2)] shrink-0"></div>
                <div
                    class="testimonial-card bg-[#181818] rounded-[20px] flex mr-5 w-[420px] min-h-[256px] shrink-0 overflow-hidden">
                    <div
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('{{ asset('assets/images/backgrounds/Testimonials-image.png') }}')] bg-contain bg-no-repeat bg-top">
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
                                <img src="{{ asset('assets/images/photos/photo1.png') }}"
                                    class="w-full h-full object-cover" alt="photo">
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
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('{{ asset('assets/images/backgrounds/Testimonials-image.png') }}')] bg-contain bg-no-repeat bg-top">
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
                                <img src="{{ asset('assets/images/photos/photo1.png') }}"
                                    class="w-full h-full object-cover" alt="photo">
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
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('{{ asset('assets/images/backgrounds/Testimonials-image.png') }}')] bg-contain bg-no-repeat bg-top">
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
                                <img src="{{ asset('assets/images/photos/photo2.png') }}"
                                    class="w-full h-full object-cover" alt="photo">
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
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('{{ asset('assets/images/backgrounds/Testimonials-image.png') }}')] bg-contain bg-no-repeat bg-top">
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
                                <img src="{{ asset('assets/images/photos/photo1.png') }}"
                                    class="w-full h-full object-cover" alt="photo">
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
                        class="p-6 flex flex-col w-full gap-[42px] shrink-0 bg-[url('{{ asset('assets/images/backgrounds/Testimonials-image.png') }}')] bg-contain bg-no-repeat bg-top">
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
                                <img src="{{ asset('assets/images/photos/photo1.png') }}"
                                    class="w-full h-full object-cover" alt="photo">
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
