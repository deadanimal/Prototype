@extends('auth.layout')

@section('content')


    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Prototype</h3>
                    <p class="subtitle has-text-black">Please enter your email to reset password</p>
                    <div class="box">            
                        <form action="/forgot-password" method="POST">
                            @csrf

           
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="email" name="email" placeholder="Your Email" autofocus="">
                                </div>
                            </div>

                              
                            <button class="button is-block is-info is-large is-fullwidth">Forgot Password</button>
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="/login">Sign In</a> &nbsp;·&nbsp;
                        <a href="/register">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
