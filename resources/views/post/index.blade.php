
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
</head>
<body>
    @if (session('status'))
    <div class="alert alert-primary role='alert'">
        {!! session('status') !!}
    </div>
@endif

    <h3>Index Post</h3>

    <table border='1'>
        <th>ID</th>
        <th>Title</th>
        <th>Posted</th>
        <th>Content</th>
        <th>Created At</th>
        <th>Updated At</th>
        @foreach ($posts as $post)

            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->posted }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
            
                <td>
                    <form action="{{route('postCRUD.destroy', ['postCRUD' => $post->id ])}}" method="POST">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form> 
                </td> 

                <td>
                    <form action="{{route('postCRUD.show', ['postCRUD' => $post->id ])}}" method="GET">
                      @method('GET')
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm">Show</button>
                    </form> 
                </td>
                
                <td>
                    <form action="{{route('postCRUD.edit', ['postCRUD' => $post->id ])}}" method="GET">
                      
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm">Edit</button>
                    </form> 
                </td> 
            
            </tr>
        @endforeach
    </table>

</body>
</html>