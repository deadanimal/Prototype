@extends('auth.layout')

@section('content')


    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-black">Prototype</h3>
                    <p class="subtitle has-text-black">Please register to access the system</p>
                    <div class="box">            
                        <form action="/register" method="POST">
                            @csrf

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="text" name="name" placeholder="Your Name" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="email" name="email" placeholder="Your Email" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="password" name="password" placeholder="Your Password">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" type="password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>                            
                            <button class="button is-block is-info is-large is-fullwidth">Register <i class="fa fa-sign-in"
                                    aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <p class="has-text-grey">
                        <a href="/login">Sign In</a> &nbsp;·&nbsp;
                        <a href="/forgot-password">Forgot Password</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
