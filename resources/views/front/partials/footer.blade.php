{{-- resources/views/front/partials/footer.blade.php --}}
<footer class="bg-azwara-darkest text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Main Footer Content --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

            {{-- Column 1: Brand & Description --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center gap-4">
                    <div class="h-14 w-14 rounded-full overflow-hidden border-2 border-primary">
                        <img
                            src="{{ asset('img/logo.png') }}"
                            alt="Azwara Learning"
                            class="h-full w-full object-cover"
                        >
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">Azwara Learning</h2>
                        <p class="text-azwara-lighter text-sm">Bimbel Online Terpercaya</p>
                    </div>
                </div>

                <p class="text-azwara-lighter max-w-lg leading-relaxed">
                    Platform bimbel online dengan materi terstruktur, tentor berpengalaman,
                    serta tryout dan pembahasan yang membantu siswa mencapai target belajar
                    dengan lebih efektif.
                </p>

                {{-- Social Media --}}
                <div class="flex items-center gap-4 pt-2">
                    <p class="text-azwara-lighter font-medium">Follow Us:</p>
                    <div class="flex items-center gap-3">
                        {{-- Instagram --}}
                        <a
                            href="https://www.instagram.com/azwara_learning"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="h-10 w-10 rounded-full bg-azwara-darker flex items-center justify-center hover:bg-[#E4405F] transition duration-300 group relative"
                            aria-label="Instagram Azwara Learning"
                            title="Instagram @azwara_learning"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                @azwara_learning
                            </span>
                        </a>

                        {{-- TikTok --}}
                        <a
                            href="https://www.tiktok.com/@azwara.learning"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="h-10 w-10 rounded-full bg-azwara-darker flex items-center justify-center hover:bg-black transition duration-300 group relative"
                            aria-label="TikTok Azwara Learning"
                            title="TikTok @azwara.learning"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                            </svg>
                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                @azwara.learning
                            </span>
                        </a>

                        {{-- YouTube --}}
                        <a
                            href="https://www.youtube.com/@AzwaraLearning"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="h-10 w-10 rounded-full bg-azwara-darker flex items-center justify-center hover:bg-[#FF0000] transition duration-300 group relative"
                            aria-label="YouTube Azwara Learning"
                            title="YouTube @AzwaraLearning"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <span class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-black text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                                @AzwaraLearning
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <h3 class="text-xl font-bold mb-6 pb-3 border-b border-azwara-darker">
                    Quick Links
                </h3>
                <ul class="space-y-4">
                    <li>
                        <a
                            href="#home"
                            class="flex items-center gap-3 text-azwara-lighter hover:text-white hover:translate-x-1 transition duration-300 group"
                        >
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#about"
                            class="flex items-center gap-3 text-azwara-lighter hover:text-white hover:translate-x-1 transition duration-300 group"
                        >
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>About Us</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#courses"
                            class="flex items-center gap-3 text-azwara-lighter hover:text-white hover:translate-x-1 transition duration-300 group"
                        >
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Courses</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="#teachers"
                            class="flex items-center gap-3 text-azwara-lighter hover:text-white hover:translate-x-1 transition duration-300 group"
                        >
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Teachers</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a
                            href="#testimonials"
                            class="flex items-center gap-3 text-azwara-lighter hover:text-white hover:translate-x-1 transition duration-300 group"
                        >
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span>Testimonials</span>
                        </a>
                    </li> --}}
                </ul>
            </div>

            {{-- Column 3: Contact Info --}}
            <div>
                <h3 class="text-xl font-bold mb-6 pb-3 border-b border-azwara-darker">
                    Contact Us
                </h3>
                <ul class="space-y-6">
                    {{-- <li class="flex items-start gap-4">
                        <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Alamat Kantor</p>
                            <p class="text-azwara-lighter text-sm mt-1">
                                Jl. Pendidikan No. 123<br>
                                Jakarta Selatan, 12540
                            </p>
                        </div>
                    </li> --}}
                    <li class="flex items-start gap-4">
                        <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Telepon / WhatsApp</p>
                            <p class="text-azwara-lighter text-sm mt-1">
                                (+62) 851-4133-9645
                                {{-- 0812-3456-7890 --}}
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Email</p>
                            <p class="text-azwara-lighter text-sm mt-1">
                                azwaralearning@gmail.com
                                {{-- support@azwaralearning.com --}}
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Newsletter Section --}}
        {{-- <div class="mt-16 pt-10 border-t border-azwara-darker">
            <div class="max-w-2xl mx-auto text-center">
                <h3 class="text-2xl font-bold mb-3">
                    Dapatkan Info & Promo Terbaru
                </h3>
                <p class="text-azwara-lighter mb-6">
                    Berlangganan newsletter kami untuk mendapatkan informasi terbaru
                    tentang kursus, promo, dan tips belajar.
                </p>

                <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input
                        type="email"
                        placeholder="Email address"
                        class="flex-1 px-4 py-3 rounded-lg bg-azwara-darker border border-azwara-darker focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/30 text-white placeholder-azwara-lighter"
                        required
                    >
                    <button
                        type="submit"
                        class="px-6 py-3 rounded-lg bg-primary text-white font-medium hover:bg-azwara-medium transition duration-300 whitespace-nowrap"
                    >
                        Subscribe
                    </button>
                </form>
                <p class="text-xs text-azwara-lighter mt-3">
                    Dengan berlangganan, Anda menyetujui Kebijakan Privasi kami.
                </p>
            </div>
        </div> --}}

        {{-- Bottom Bar --}}
        <div class="mt-12 pt-8 border-t border-azwara-darker">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-azwara-lighter text-sm">
                    &copy; {{ date('Y') }} Azwara Learning. All rights reserved.
                </div>

                <div class="flex items-center gap-6 text-sm">
                    {{-- <a
                        href="#"
                        class="text-azwara-lighter hover:text-white transition duration-300"
                    >
                        Privacy Policy
                    </a>
                    <a
                        href="#"
                        class="text-azwara-lighter hover:text-white transition duration-300"
                    >
                        Terms of Service
                    </a>
                    <a
                        href="#"
                        class="text-azwara-lighter hover:text-white transition duration-300"
                    >
                        Cookie Policy
                    </a>
                    <a
                        href="#"
                        class="text-azwara-lighter hover:text-white transition duration-300"
                    >
                        Sitemap
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</footer>
