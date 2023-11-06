<!DOCTYPE html>
<html lang="en" data-theme="dark" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cyber Manager' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@unocss/runtime/preset-icons.global.js"></script>
    <script>
        window.__unocss = {
            presets: [
            () => window.__unocss_runtime.presets.presetIcons({
                scale: 1.2,
                cdn: 'https://esm.sh/'
            }),
            ],
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@unocss/runtime"></script>
    <script src="https://unpkg.com/htmx.org@1.9.6" integrity="sha384-FhXw7b6AlE/jyjlZH5iHa/tTe9EpJ1Y55RjcgPbjeWMskSxZt1v9qkxLJWNJaGni" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/hyperscript.org@0.9.12"></script>
    <script src="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/src/index.min.js"></script>
</head>
<body class="flex flex-col h-full relative h-screen dark:text-neutral-content">
    {{ $slot }}

    <footer class="header bg-fuchsia-900 text-neutral-50 dark:bg-neutral dark:text-neutral-content w-full sticky py-5 px-10 dark:bg-slate-800">
        Todos los derechos reservados &copy;
    </footer>

    <script>
        function toggleDarkMode() {
            let htmlEl = document.documentElement;
            let mode = htmlEl.getAttribute("class") === "light" ? "dark" : "light";
            htmlEl.setAttribute("data-theme", mode);
            htmlEl.setAttribute("class", mode);
        }
    </script>
</body>
</html>