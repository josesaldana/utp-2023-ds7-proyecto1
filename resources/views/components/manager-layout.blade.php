<x-layout>
    <header class="flex flex-row text-white">
        <div class="w-1/6 flex flex-row bg-fuchsia-900 dark:bg-neutral py-5 px-5 border-r border-solid border-slate-200 dark:border-slate-700">
            <h1 class="text-2xl flex-grow self-end">Cyber Manager</h1>
            <button class="self-end i-carbon-sun dark:i-carbon-moon" alt="Dark Mode" onclick="javascript:toggleDarkMode();"  />
        </div>
        <div class="w-full flex flex-row bg-slate-500 dark:bg-neutral dark:text-neutral-content px-5 py-5">
            <h1 class="text-2xl flex-grow">{{ $pageTitle }}</h1>
            <h2 class="text-xl justify-seld-end self-end">12:30 PM</h2>  
        </div>
    </header>

    <!-- <main class="flex flex-row items-stretch"> -->
    <main class="flex flex-row flex-grow relative">
        <x-manager-menu></x-manager-menu>
        <div id="page-container" class="w-full bg-base-200">
            {{ $slot }}
        </div>
    </main>
</x-layout>