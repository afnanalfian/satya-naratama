@extends('front.layouts.app')
@section('title', 'Satya Naratama')
@section('description', 'Bimbingan Belajar Persiapan Kedinasan TNI POLRI lengkap paket latihan jasmani dan kelas belajar - Kabupaten Pangkajene dan Kepulauan.')
@section('content')

    <section id="home">
        @include('front.sections.hero')
    </section>

    <section id="about">
        @include('front.sections.about')
    </section>

    <section id="photo">
        @include('front.sections.photo')
    </section>
    
    <section id="courses">
        @include('front.sections.courses')
    </section>

    <section id="teachers">
        @include('front.sections.teachers')
    </section>

    {{-- <section id="testimonials">
        @include('front.sections.testimonials')
    </section> --}}

@endsection
