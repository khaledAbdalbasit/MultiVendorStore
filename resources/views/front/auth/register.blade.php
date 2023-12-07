<x-front-layout title="Register">
    <x-slot:breadcrumb>
        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Registration</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>Registration</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
    </x-slot:breadcrumb>

    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>Registration takes less than a minute but gives you full control over your orders.</p>
                        </div>
                        <form class="row" method="post" action="{{ route('register') }}">
                            @csrf
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-input-label for="reg-fn" :value="__('Name')" />
                                    <x-form.input id="reg-fn" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-input-label for="phone_number" :value="__('phone_number')" />
                                    <x-form.input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-form.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">{{ __('Register') }}</button>
                            </div>
                            <p class="outer-link">Already have an account? <a href="{{ route('login') }}">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->
</x-front-layout>
