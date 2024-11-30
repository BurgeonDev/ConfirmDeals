@extends('admin.layouts.app')

@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <!-- Profile Information Card -->


        <div class="card">
            <div class="card-body">
                <div class="max-w-xl">
                    <section>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Update Profile Information</h4>
                                    <p class="card-description"> Update your name and email address. </p>
                                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                                        class="forms-sample">
                                        @csrf
                                        @method('patch')
                                        <!-- Existing Profile Picture -->
                                        <div class="form-group">
                                            <label for="profile_pic">{{ __('Profile Picture') }}</label><br>
                                            @if ($user->profile_pic)
                                                <img src="{{ asset('storage/' . $user->profile_pic) }}"
                                                    alt="Profile Picture"
                                                    style="width: 150px; height: 150px; object-fit: cover;">
                                            @else
                                                <p>No profile picture available.</p>
                                            @endif
                                        </div>

                                        <!-- Upload New Profile Picture -->
                                        <div class="form-group">
                                            <label for="profile_pic">{{ __('Upload New Profile Picture') }}</label>
                                            <input type="file" class="form-control" id="profile_pic" name="profile_pic"
                                                accept="image/*">
                                            <x-input-error class="mt-2" :messages="$errors->get('profile_pic')" />
                                        </div>
                                        <!-- Name Input -->
                                        <div class="form-group">
                                            <label for="first_name">{{ __('First Name') }}</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                value="{{ old('first_name', $user->first_name) }}" required
                                                placeholder="Enter your first name">
                                            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                        </div>

                                        <div class="form-group">
                                            <label for="last_name">{{ __('Last Name') }}</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                value="{{ old('last_name', $user->last_name) }}" required
                                                placeholder="Enter your last name">
                                            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">{{ __('Phone No') }}</label>
                                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                                value="{{ old('phone_number', $user->phone_number) }}" required
                                                placeholder="Enter your last name">
                                            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                                        </div>


                                        <!-- Email Input -->
                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }}</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ old('email', $user->email) }}" required autocomplete="username"
                                                placeholder="Enter your email">
                                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-800">
                                                        {{ __('Your email address is unverified.') }}
                                                        <button form="send-verification"
                                                            class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                            {{ __('Click here to re-send the verification email.') }}
                                                        </button>
                                                    </p>

                                                    @if (session('status') === 'verification-link-sent')
                                                        <p class="mt-2 text-sm font-medium text-green-600">
                                                            {{ __('A new verification link has been sent to your email address.') }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Save Button -->
                                        <div class="form-group d-flex justify-content-between">
                                            <button type="submit"
                                                class="btn btn-primary me-2">{{ __('Save') }}</button>

                                            @if (session('status') === 'profile-updated')
                                                <p x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                    {{ __('Saved.') }}</p>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="max-w-xl">
                    <section>


                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Update Password</h4>
                                    <p class="card-description"> Make sure your password is strong and secure. </p>

                                    <form method="post" action="{{ route('password.update') }}" class="forms-sample">
                                        @csrf
                                        @method('put')

                                        <!-- Current Password -->
                                        <div class="form-group">
                                            <label
                                                for="update_password_current_password">{{ __('Current Password') }}</label>
                                            <input type="password" class="form-control"
                                                id="update_password_current_password" name="current_password"
                                                autocomplete="current-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                        </div>

                                        <!-- New Password -->
                                        <div class="form-group">
                                            <label for="update_password_password">{{ __('New Password') }}</label>
                                            <input type="password" class="form-control" id="update_password_password"
                                                name="password" autocomplete="new-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-group">
                                            <label
                                                for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
                                            <input type="password" class="form-control"
                                                id="update_password_password_confirmation" name="password_confirmation"
                                                autocomplete="new-password" />
                                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                        </div>

                                        <!-- Save Button -->
                                        <div class="form-group d-flex justify-content-between">
                                            <button type="submit"
                                                class="btn btn-primary me-2">{{ __('Save') }}</button>

                                            @if (session('status') === 'password-updated')
                                                <p x-data="{ show: true }" x-show="show" x-transition
                                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                    {{ __('Saved.') }}</p>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <!-- Delete Account Card -->
        <div class="card">
            <div class="card-body">

                <div class="max-w-xl">
                    <section class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Delete Account') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                    </p>
                                </header>

                                <button type="button" class="btn btn-danger"
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</button>

                                <!-- Modal -->
                                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                    <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                                        @csrf
                                        @method('delete')

                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('Are you sure you want to delete your account?') }}
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                        </p>

                                        <div class="mt-4">
                                            <div class="form-group">
                                                <label for="password" class="sr-only">{{ __('Password') }}</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" placeholder="{{ __('Password') }}" />

                                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="mt-4 d-flex justify-content-end">
                                            <x-secondary-button x-on:click="$dispatch('close')" class="btn btn-light">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>

                                            <button type="submit" class="btn btn-danger ms-3">
                                                {{ __('Delete Account') }}
                                            </button>
                                        </div>
                                    </form>
                                </x-modal>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
@endsection
