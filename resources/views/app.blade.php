<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{ Vite::useHotFile('vendor/laravel-meilisearch/laravel-meilisearch.hot')->useBuildDirectory('vendor/laravel-meilisearch')->withEntryPoints(['resources/css/app.css', 'resources/js/app.js']) }}
</head>

<body class="">
    <div id="app"></div>
</body>

</html>
