<div class="w-1/6 flex flex-col self-stretch border-r border-solid border-slate-700">
    <header class="flex flex-row row py-5 px-5 row bg-fuchsia-900 text-white dark:bg-neutral">
        <h1 class="text-2xl flex-grow self-end">Cyber Manager</h1>
        <button class="self-end i-carbon-sun dark:i-carbon-moon"
                alt="Dark Mode"
                onclick="javascript:toggleDarkMode();"  />
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