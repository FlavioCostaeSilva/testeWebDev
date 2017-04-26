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

        {{ Form::label('file','Arquivo selecionado: ',array('id'=>'','class'=>'')) }}
        {{ Form::file('file','') }}

        <!-- submit buttons -->
        {{ Form::submit('Enviar') }}

        <!-- reset buttons -->
            {{ Form::reset('Limpar') }}

            {{ Form::close() }}
        </li>
    </ul>
</ul>

<hr>

@if(isset($aviso_adicao))
    <h2>Info:</h2>
    <h3>Adição dos dados feita com sucesso!</h3>
    <hr>
@endif

<h2>Registros atualmente presentes:</h2>

{{--@if(!$registros->isEmpty())--}}
    {{--<table border="1">--}}
        {{--<tr>--}}
            {{--<th>ID</th>--}}
            {{--<th>Purchaser_name</th>--}}
            {{--<th>Item_description</th>--}}
            {{--<th>Item_price</th>--}}
            {{--<th>Purchase_count</th>--}}
            {{--<th>Merchant_address</th>--}}
            {{--<th>Merchant_name</th>--}}
            {{--<th>Ações</th>--}}
        {{--</tr>--}}
        {{--@foreach($registros as $registro)--}}
            {{--<tr>--}}
                {{--<td>{{$registro->id}}</td>--}}
                {{--<td>{{$registro->purchaser_name}}</td>--}}
                {{--<td>{{$registro->item_description}}</td>--}}
                {{--<td>{{$registro->item_price}}</td>--}}
                {{--<td>{{$registro->purchase_count}}</td>--}}
                {{--<td>{{$registro->merchant_address}}</td>--}}
                {{--<td>{{$registro->merchant_name}}</td>--}}
                {{--<td>--}}
                    {{--<a href="edit/{{$registro->id}}" >Editar</a> | <a href="delete/{{$registro->id}}" >Deletar</a>--}}
                {{--</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    {{--</table>--}}
{{--@else--}}
    {{--<p>Nenhum registro</p>--}}
{{--@endif--}}

</body>
</html>