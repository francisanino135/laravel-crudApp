<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" x-data="fileUploadHandlerRegister"
        x-init="$watch('files', value => console.log(value))"> <!-- Add enctype here -->
        @csrf

        <div
            class="wrapper w-[420px] bg-[#4B006E] shadow-[0_0_10px_rgba(0,0,0,0.2)] rounded-[10px] text-white py-[30px] px-[40px]">
            <h1 class="text-[36px] text-center font-bold">Register</h1>

            <div class="input-box relative w-full h-[50px] mt-[30px]">
                <input id="name"
                    class="w-full h-full bg-transparent border-2 border-white/20 rounded-[40px] text-[16px] text-inherit 
                            ps-[20px] py-[20px] focus:ring-0 focus:border-white/20 placeholder:text-white/60"
                    name="name" type="text" placeholder="Name" required>
                <i class='bx bxs-user absolute right-[20px] top-[50%] translate-y-[-50%] text-[20px]'></i>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="input-box relative w-full h-[50px] mt-[30px]">
                <input id="email"
                    class="w-full h-full bg-transparent border-2 border-white/20 rounded-[40px] text-[16px] text-inherit 
                            ps-[20px] py-[20px] focus:ring-0 focus:border-white/20 placeholder:text-white/60"
                    name="email" type="email" placeholder="Email address" required>
                <i class="bx bxs-envelope absolute right-[20px] top-[50%] translate-y-[-50%] text-[20px]"></i>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="input-box relative w-full h-[50px] mt-[30px]">
                <input id="password"
                    class="w-full h-full bg-transparent border-2 border-white/20 rounded-[40px] text-[16px] 
                            ps-[20px] py-[20px] focus:ring-0 focus:border-white/20 placeholder:text-white/60"
                    name="password" type="password" placeholder="Password" required>
                <i class="bx bxs-lock-alt absolute right-[20px] top-[50%] translate-y-[-50%] text-[20px]"></i>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="input-box relative w-full h-[50px] mt-[30px]">
                <input id="password_confirmation"
                    class="w-full h-full bg-transparent border-2 border-white/20 rounded-[40px] text-[16px] ps-[20px] py-[20px] focus:ring-0 focus:border-white/20 placeholder:text-white/60"
                    name="password_confirmation" type="password" placeholder="Confirm password" required>
                <i class="bx bxs-lock-alt absolute right-[20px] top-[50%] translate-y-[-50%] text-[20px]"></i>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="input-box relative w-full h-[50px] hidden">               
                <input id="profile_picture" class="block w-full " name="profile_picture" type="file"
                    accept="image/*" multiple x-ref="fileInput" @change="handleFileUpload($event)" />
                <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
            </div>

            <!-- Profile Picture Preview -->
            <div class="flex items-center justify-center">
                <div
                    class="w-[150px] h-[150px] mt-[30px] rounded-full bg-transparent border-2 border-white/20 flex items-center justify-center overflow-hidden bg-gray-100 relative">
                    
                    <template x-if="files.length > 0">
                        <img :src="previewUrl" alt="Profile Picture" class="w-[90px] ">
                    </template>

                    <button type="button" 
                        :class="{ 'opacity-0': files.length > 0 }"
                        class="w-full absolute px-[5px] py-[10px] bg-transparent active:translate-y-[2px] text-white text-[15px]"
                        @click="$refs.fileInput.click()">Add photo
                    </button>
                </div>
            </div>

            <button type="submit"
                class="btn w-full h-[45px] mt-[15px] bg-white text-black/80 text-[16px] font-semibold rounded-[40px] shadow-[0_0_10px_rgba(0,0,0,0.2)] active:translate-y-[2px]">Register</button>
            <div class="login-register text-[14.5px] text-center mt-[20px] mb-[15px]">
                <p>Already have an account?
                    <a href="{{ route('login') }}"
                        class="register-link font-semibold inline-block hover:underline active:translate-y-[2px]">
                        Login
                    </a>
                </p>
            </div>
        </div>
        <!-- Name -->
        {{-- <div class="flex">
            <div class="bg-white px-[20px] py-[30px] rounded-s-[16px] border-s border-y border-gray-300">
                <div class="mb-[20px] text-[30px]">Register</div>
                <div class="w-[320px]">
                    <div>
                        <x-input-label class="text-[12px] font-sans" for="name" :value="__('NAME')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                            required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label class="text-[12px] font-sans" for="email" :value="__('EMAIL')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label class="text-[12px] font-sans" for="password" :value="__('PASSWORD')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label class="text-[12px] font-sans" for="password_confirmation"
                            :value="__('CONFIRM PASSWORD')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Profile Picture -->
                    <div class="mt-4">
                        <x-input-label class="text-[12px] font-sans" for="profile_picture"
                            :value="__('PROFILE PICTURE')" />
                        <x-text-input id="profile_picture" class="block mt-1 w-full" type="file" name="profile_picture"
                            accept="image/*" />
                        <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                    </div>

                    <div class="mt-[20px]">
                        <button type="submit"
                            class="bg-[#151A2D] text-gray-400 text-[15px] px-[120px] py-[10px] w-full rounded-full hover:bg-gray-700 active:bg-gray-950 active:translate-y-[2px]">
                            {{ __('Register') }}
                            <button>
                    </div>

                </div>
            </div>
            <div class="bg-[#151A2D] px-[20px] py-[30px] w-[350px] rounded-e-[16px]">
                <div class="text-white">
                    <h2 class="font-bold text-[30px]">Welcome to register</h2>
                    <p class=" text-[15px] mb-[20px]">Already have an account?</p>
                    <a href="{{ route('login') }}"
                        class="text-[15px] border-2 border-white rounded-full px-[30px] py-[10px]">Login</a>
                </div>
            </div>
        </div> --}}
    </form>
</x-guest-layout>