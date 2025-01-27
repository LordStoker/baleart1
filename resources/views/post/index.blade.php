
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Posts</title>

    <script>
        var app = @json($posts);
        console.log(app);
    </script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @if (session('status'))
    <div class="alert alert-primary role='alert'">
        {!! session('status') !!}
    </div>
@endif

<div class="row row-cols-1 row-cols-md-3 g-4">
    @each('components.card-posts', $posts, 'post');
</div>

    <h3>Index Post</h3>

   

</body>
</html>