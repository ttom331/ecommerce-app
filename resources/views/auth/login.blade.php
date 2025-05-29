<x-layout>
    <x-heading>Login</x-heading>
    <x-forms.form method="POST" action="/login" class="mt-5 px-10">
        <x-forms.input name="email" label="Email"></x-forms.input>
        <x-forms.input name="password" label="Password" type="password"></x-forms.input>
        <div class="text-center">
            <x-forms.button class="text-white py-1 sm:py-2 md:px-8 mt-1 md:mt-0">Login</x-button>
        </div>
    </x-forms.form>
    <a href="/register" ><p class="text-center mt-2">Create account</p></a>
    
</x-layout>