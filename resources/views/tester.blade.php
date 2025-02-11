<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ Vite::useHotFile('vendor/laravel-meilisearch/laravel-meilisearch.hot')->useBuildDirectory('vendor/laravel-meilisearch')->withEntryPoints(['resources/css/app.css', 'resources/js/app.js']) }}
</head>

<body class="bg-slate-200 mx-auto max-w-screen-2xl py-12">
    <div class="bg-white p-12 rounded-3xl border border-slate-300">
        kks
    </div>
</body>

</html>