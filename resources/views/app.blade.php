<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ Vite::useHotFile('vendor/laravel-meilisearch/laravel-meilisearch.hot')->useBuildDirectory('vendor/laravel-meilisearch')->withEntryPoints(['resources/css/app.css', 'resources/js/app.js']) }}
</head>

<body class="bg-gray-50">
    <div id="app"></div>
</body>

</html>
