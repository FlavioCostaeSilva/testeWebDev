<!DOCTYPE html>
<html>
<head>
    <title>Controle e upload de arquivos .xlsx</title>
</head>
<body>
<h1>Gerenciamento de produtos</h1>
<hr>
<h2>Editar produto:</h2>

@if(!empty($productData))
    <div style="width: 400px;">
        {!! Form::open(['url' => route('.update')]) !!}
            {{ Form::hidden('lm', $productData->lm) }}

            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', $productData->name) !!}
        <br>
            {!! Form::label('category', 'Category:') !!}
            {!! Form::text('category', $productData->category)!!}
        <br>
            {!! Form::label('free_shipping', 'Free Shipping:') !!}
            {!! Form::text('free_shipping', $productData->free_shipping) !!}
        <br>
            {!! Form::label('description', 'Description:') !!}
            {!! Form::textarea('description', $productData->description) !!}
        <br>
            {!! Form::label('price', 'Price:') !!}
            {!! Form::text('price', $productData->price) !!}
        <br>
        <br>
            {!! Form::submit('Editar produto') !!}

        {!! Form::close() !!}
    </div>
@endif

@if(count($errors) > 0)
    <h3>Erros encontrados:</h3>
    <ul>
    @foreach ($errors->all() as $error)
        <li style="color: red">{{$error}}</li>
    @endforeach
    </ul>
@endif

<h3>
    <a href="{{route('.')}}"><<< Voltar</a>
</h3>

</body>
</html>
