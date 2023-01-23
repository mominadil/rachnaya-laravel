<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    </style>
</head>

<body class="antialiased">
    <div class="container">
        <h1>Books</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Preview Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $book)
                    <!-- @dd($book['title']) -->
                <tr>
                    <td>{{$book['title']}}</td>
                    <td>{{ $book['authors'] }}</td>
                    <td>{{ $book['publisher'] }}</td>
                    <td><a href="{{ $book['previewLink'] }}" class="btn btn-primary">Preview</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
