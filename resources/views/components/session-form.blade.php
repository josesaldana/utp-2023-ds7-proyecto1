<form class="w-full flex flex-col gap-y-3 flex-none mt-5" 
        hx-post="/sessions/create"
        hx-target="body"
        hx-swap="beforeend">
    @csrf <!-- {{ csrf_field() }} -->
    <h2 class="font-bold">Nueva Sesi&oacute;n</h2>
    <legend>Ingrese los datos del alquiler</legend>
    <input type="text" name="cliente" class="input input-bordered w-full" placeholder="C&oacute;digo">
    <input type="text" name="nombre" class="input input-bordered w-full" placeholder="Nombre">
    <input type="text" name="apellido" class="input input-bordered w-full" placeholder="Apellido">
    <input type="number" name="tiempo" class="input input-bordered w-full" placeholder="Tiempo">
    <div class="form-control">
        <label class="label cursor-pointer" for="fuma">
            <span class="label-text">¿Fuma?</span> 
            <input type="checkbox" name="fuma" class="checkbox" />
        </label>
    </div>
    <button type="submit" class="btn btn-primary w-60 self-end">Registrar</button>
</form>