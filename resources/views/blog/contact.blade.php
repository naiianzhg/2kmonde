@extends('blog.layouts.master', ['meta_description' => 'Contact me'])

@section('page-header')
    <header class="masthead" style="background-image: url('{{ page_image('contact_bg.jpg') }}')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="page-heading">
                        <h1>Contact me</h1>
                        <span class="subheading">Question for me? Answer you right away.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @include('admin.partials.errors')
                @include('admin.partials.success')

                <p>Try to contact me? Fill the following form and I will reply you ASAP!</p>

                <form action="/contact" name="sendMessage" id="contactForm" method="POST" novalidate>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Your name" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your email address" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Your phone number" value="{{ old('phone') }}" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Your problem" value="{{ old('message') }}" required></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="sendMessageButton">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
