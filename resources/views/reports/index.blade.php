<div class="container-lg px-8 mt-10 mb-5">
    <form class="w-full flex flex-row gap-y-3 flex-none items-center mt-5 gap-3" 
            hx-post="/reports/generate"
            hx-target="#report-container"
            hx-swap="innerHTML">
        @csrf <!-- {{ csrf_field() }} -->
        <label for="reporte">Seleccione el tipo de reporte:</label>
        <select name="reporte" class="select select-bordered w-full max-w-xs">
            <option value="clientes" name="clientes">Clientes</option>
            <option value="financiero" name="financiero">Financiero</option>
        </select>
        <button type="submit" class="btn btn-primary w-60 self-start">Generar</button>
    </form>

    <div id="report-container" class="my-5"></div>
</div>