<div class="w-1/6 flex flex-col self-stretch border-r px-5 border-solid border-slate-200 dark:border-slate-700 bg-base-100">
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