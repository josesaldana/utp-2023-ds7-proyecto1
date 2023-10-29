<!-- Order your soul. Reduce your wants. - Augustine -->
<header class="header flex flex-row bg-fuchsia-900 text-white dark:bg-neutral dark:text-neutral-content row px-10 py-5 dark:bg-slate-500">
    <h1 class="text-2xl flex-grow">Sesiones</h1>
    <h2 class="text-xl justify-seld-end self-end">12:30 PM</h2>  
</header>

<div class="container-lg px-8 mt-10 mb-5 grid grid-cols-[1fr_500px] gap-5 place-items-start grid-flow-row auto-rows auto-rows-min auto-cols-max">
    <x-sessions-summary></x-sesssions-summary>
    <x-sessions-table></x-sessions-table>
    <x-session-form></x-session-form>
</div>