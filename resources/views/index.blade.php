<!DOCTYPE html>
<html>
<head>
    <title>Controle e upload de arquivos .xlsx</title>
</head>
<body>
<h1 style="text-align: center">Gerenciamento de produtos</h1>
<hr>
<h2>Opções:</h2>
<ul>
    <li>Adicionar novos produtos via upload de arquivo .xlsx:</li>

    <ul>
        <li>
        {{ Form::open(array('files'=>true, 'url' => route('.'))) }}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {{ Form::label('file','Arquivo selecionado: ', array('id'=>'','class'=>'')) }}
        {{ Form::file('file') }}

        {{ Form::submit('Enviar') }}

        {{ Form::reset('Limpar') }}

        {{ Form::close() }}
        </li>
    </ul>
</ul>

<hr>

@if($result === true)
    <h2>Info:</h2>
    <h3 style="color: red">Produtos enviados a fila com sucesso! Serão adicionados em instantes!</h3>
    <hr>
@elseif($result == 'error')
    <h2>Erro:</h2>
    <h3 style="color: red">Selecione um arquivo .xlsx válido para enviar!</h3>
    <hr>
@elseif($result == 'prod_edited')
    <h2>Info:</h2>
    <h3 style="color: red">Produto editado com sucesso!</h3>
    <hr>
@elseif($result == 'product_deleted')
    <h2>Info:</h2>
    <h3 style="color: red">Produto deletado com sucesso!</h3>
    <hr>
@elseif($result == 'deleted_failed')
    <h2>Info:</h2>
    <h3 style="color: red">Produto não encontrado pra ser deletado!</h3>
    <hr>
@endif

<h2>Registros atualmente presentes:</h2>
<h3><a href="{{route('.')}}">Atualizar</a> </h3>
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
                <td>
                    <a href="{{ route('.edit', ['lm' => $registro->lm]) }}" >Editar</a> |
                    <a href="{{ route('.delete', ['lm' => $registro->lm]) }}" >Deletar</a>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <p>Nenhum registro</p>
@endif

</body>
</html>