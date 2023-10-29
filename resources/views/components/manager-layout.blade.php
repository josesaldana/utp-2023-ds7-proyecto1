<x-layout>
    <!-- <main class="flex flex-row items-stretch"> -->
    <main class="flex flex-row flex-grow">
        <x-manager-menu></x-manager-menu>
        <div id="page-container" class="w-full">
            {{ $slot }}
        </div>
    </main>
</x-layout>