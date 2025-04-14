<x-guest-layout>

    <x-auth-session-status class="mt-[15px] mb-[15px]" :status="session('status')" />

    <x-input-error :messages="$errors->all()" class="mt-[15px]" id="error-message" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div
            class="wrapper w-[420px] bg-[#4B006E] shadow-[0_0_10px_rgba(0,0,0,0.2)] rounded-[10px] text-white py-[30px] px-[40px]">
            <h1 class="text-[36px] text-center font-bold">Login</h1>
            <div class="input-box relative w-full h-[50px] mt-[30px]">
                <input
                    class="w-full h-full bg-transparent border-2 border-white/30 rounded-[40px] text-[16px] text-inherit ps-[20px] py-[20px] focus:ring-0 focus:border-white/30 placeholder:text-white/60"
                    name="email" type="email" placeholder="Email address" required>

                <i class='bx bxs-envelope absolute right-[20px] top-[50%] translate-y-[-50%] text-[20px]'></i>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="input-box relative w-full h-[50px] mt-[30px]">
                <input
                    class="w-full h-full bg-transparent border-2 border-white/30 rounded-[40px] text-[16px] ps-[20px] py-[20px] focus:ring-0 focus:border-white/20 placeholder:text-white/60"
                    name="password" type="password" placeholder="Password" required />
                <i class='bx bxs-lock-alt absolute right-[20px] top-[50%] translate-y-[-50%] text-[20px]'></i>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="remember-forgot flex justify-between text-[14.5px] my-[15px] mx-0 ">
                <label><input class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 me-[5px]"
                        type="checkbox">Remember me</label>
                <a class="hover:underline" href="#">Forgot Password?</a>
            </div>
            <button type="submit"
                class="btn w-full h-[45px] bg-white text-[16px] font-semibold text-black/80 rounded-[40px] shadow-[0_0_10px_rgba(0,0,0,0.2)] active:translate-y-[2px]">Login</button>
            <div class="login-register text-[14.5px] text-center mt-[20px] mx-0 mb-[15px]">
                <p>Don't have an account?
                    <a href="register" class="register-link font-medium inline-block hover:underline active:translate-y-[2px]">
                        Register
                    </a>
                </p>
            </div>
        </div>


        {{-- <div class="flex">
            <div class="bg-white px-[20px] py-[30px] rounded-s-[16px] border-s border-y border-gray-300">
                <div class="mb-[20px] text-[30px]">Login</div>
                <div class="w-[350px]">
                    <!-- Email Address -->
                    <div>
                        <x-input-label class="text-[12px] font-sans font-bold" for="email" :value="__('EMAIL')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            placeholder="Enter email" :value="old('email')" required autofocus
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label class="text-[12px] font-sans font-bold" for="password" :value="__('PASSWORD')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            placeholder="Enter password" required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-[25px]">
                        <button type="submit"
                            class="bg-[#151A2D] text-[15px] w-full text-gray-400 py-[10px] rounded-full hover:bg-[] active:bg-gray-950 active:translate-y-[2px]">
                            {{ __('Log in') }}
                            <button>
                    </div>

                    <div class="flex justify-between items-center mt-5">
                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <label for="remember_me" class="ms-2 text-sm text-gray-600">
                                {{ __('Remember me') }}
                            </label>
                        </div>

                        <div>
                            @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-[#151A2D] px-[20px] py-[30px] w-[350px] rounded-e-[16px]">
                <div class="text-white">
                    <h2 class=" font-bold text-[30px]">Welcome to login</h2>
                    <p class="mt-[5px] text-[15px] mb-[25px]">Don't have an account?</p>
                    <a href="{{ route('register') }}"
                        class="text-[15px] border-2 border-white rounded-full px-[30px] py-[10px]">Register</a>
                </div>
            </div>
        </div> --}}
    </form>
</x-guest-layout>