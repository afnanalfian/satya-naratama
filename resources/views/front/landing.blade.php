@extends('front.layouts.app')
@section('title', 'Azwara Learning')
@section('description', 'Tryout SKD CPNS Kedinasan gratis dan premium dengan pembahasan lengkap.')
@section('content')

    <section id="home">
        @include('front.sections.hero')
    </section>

    <section id="about">
        @include('front.sections.about')
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
