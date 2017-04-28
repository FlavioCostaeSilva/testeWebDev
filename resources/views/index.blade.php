<!DOCTYPE html>
<html>
<head>
    <title>Controle e upload de arquivos .xlsx</title>
</head>
<body>
<h1 style="text-align: center">Bem vindo a adição e atualização de produtos via upload de arquivo .xlsx</h1>
<hr>
<h2>Opções:</h2>
<ul>
    <li>Adicionar novos produtos via upload de arquivo .xlsx:</li>

    <ul>
        <li>
        {{ Form::open(array('files'=>true)) }}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {{ Form::label('file','Arquivo selecionado: ', array('id'=>'','class'=>'')) }}
        {{ Form::file('file') }}

        <!-- submit buttons -->
        {{ Form::submit('Enviar') }}

        <!-- reset buttons -->
            {{ Form::reset('Limpar') }}

            {{ Form::close() }}
        </li>
    </ul>
</ul>

<hr>

@if($aviso_adicao === true)
    <h2>Info:</h2>
    <h3>Pedidos enviados a fila com sucesso! Serão adicionados em instantes! <a href=".">Atualizar</a> </h3>
    <hr>
@elseif($aviso_adicao == 'error')
    <h2>Erro:</h2>
    <h3>Selecione um arquivo .xlsx válido para enviar!</h3>
    <hr>
@endif

<h2>Registros atualmente presentes:</h2>

@if(!$registros->isEmpty())
    <table border="1">
        <tr>
            <th>lm</th>
            <th>name</th>
            <th>category</th>
            <th>free_shipping</th>
            <th>description</th>
            <th>price</th>
        </tr>
        @foreach($registros as $registro)
            <tr>
                <td>{{$registro->lm}}</td>
                <td>{{$registro->name}}</td>
                <td>{{$registro->category}}</td>
                <td>{{$registro->free_shipping}}</td>
                <td>{{$registro->description}}</td>
                <td>{{$registro->price}}</td>
            </tr>
        @endforeach
    </table>
@else
    <p>Nenhum registro</p>
@endif

</body>
</html>