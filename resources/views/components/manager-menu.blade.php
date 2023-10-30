<div class="w-1/6 flex flex-col self-stretch border-r border-solid border-slate-700">
    <header class="flex flex-row row py-5 px-5 row bg-fuchsia-900 text-white dark:bg-neutral">
        <h1 class="text-2xl flex-grow self-end">Cyber Manager</h1>
        <button id="darkModeToggler" 
                onclick="javascript:toggleDarkMode();" 
                class="self-end"
                alt="Dark mode">
            <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" 
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6">
                <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 
                        0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 
                        12.75 21a9.753 9.753 0 009.002-5.998z" />
            </svg>
        </button>
    </header>

    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    <a class="w-full px-5 py-3 mt-5 text-center" 
        hx-get="/sessions"
        hx-target="#page-container"
        hx-swap="innerHTML">Inicio</a>

    <a class="w-full px-5 py-3 text-center" 
        hx-get="/reports"
        hx-target="#page-container" 
        hx-swap="innerHTML">Reportes</a>
    <a class="w-full px-5 py-3 text-center" href="/logout">Logout</a>
</div>