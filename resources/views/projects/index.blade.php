<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Liste des projets</h1>
@foreach($projects as $project)
    <td>
        <p>
            {{ $project->project_name }}
            {{ $project->description }}
        </p>
    </td>
@endforeach
</body>
</html>