<div class="w-full px-10 mt-5">
    <h1 class="font-bold">Sesiones Activas</h1>

    <div class="mt-3"
            hx-get="/sessions/list"
            hx-trigger="load, every 5s, session-created from:body"
            hx-swap="innerHTML">
        <span class="loading loading-spinner text-primary"></span>
    </div>
</div>