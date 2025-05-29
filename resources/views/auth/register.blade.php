<x-layout>
    <x-heading>Register</x-heading>
    <x-forms.form method="POST" action="/register" class="mt-5 px-10">
        <x-forms.input name="email" label="Email"></x-forms.input>
        <x-forms.input name="name" label="Name"></x-forms.input>
        <x-forms.input name="password" label="Password" type="password"></x-forms.input>
        <x-forms.input name="password_confirmation" label="Confirm Password" type="password"></x-forms.input>
        <div class="text-center">
            <x-forms.button class="text-white py-1 sm:py-2 md:px-8 mt-1 md:mt-0">Login</x-button>
        </div>
    </x-forms.form>
    <a href="/login">
        <p class="text-center mt-2">Already have an account, login!</p>
    </a>
</x-layout>