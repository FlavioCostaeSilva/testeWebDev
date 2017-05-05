<!DOCTYPE html>
<html>
<head>
    <title>Product management</title>
</head>
<body>
<h1 style="text-align: center">Product management</h1>
<hr>
<h2>Options:</h2>
<ul>
    <li>Adds new products by uploading .xlsx file:</li>

    <ul>
        <li>
        {{ Form::open(array('files'=>true, 'url' => route('.'))) }}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        {{ Form::label('file','File selected: ', array('id'=>'','class'=>'')) }}
        {{ Form::file('file') }}

        {{ Form::submit('Send') }}

        {{ Form::reset('Clear') }}

        {{ Form::close() }}
        </li>
    </ul>
</ul>

<hr>

@if($result === true)
    <h2>Info:</h2>
    <h3 style="color: red">Products sent successfully to queue! Will be added in moments!</h3>
    <hr>
@elseif($result == 'error')
    <h2>Erro:</h2>
    <h3 style="color: red">Select a valid .xlsx file to send!</h3>
    <hr>
@elseif($result == 'prod_edited')
    <h2>Info:</h2>
    <h3 style="color: red">Product edited with success!</h3>
    <hr>
@elseif($result == 'product_deleted')
    <h2>Info:</h2>
    <h3 style="color: red">Product deleted with success!</h3>
    <hr>
@elseif($result == 'deleted_failed')
    <h2>Info:</h2>
    <h3 style="color: red">Product not found to be deleted!</h3>
    <hr>
@endif

<h2>Currently products:</h2>
<h3><a href="{{route('.')}}">Refresh</a> </h3>
@if(!$productsData->isEmpty())
    <table border="1">
        <tr>
            <th>lm</th>
            <th>name</th>
            <th>category</th>
            <th>free_shipping</th>
            <th>description</th>
            <th>price</th>
        </tr>
        @foreach($productsData as $productData)
            <tr>
                <td>{{$productData->lm}}</td>
                <td>{{$productData->name}}</td>
                <td>{{$productData->category}}</td>
                <td>{{$productData->free_shipping}}</td>
                <td>{{$productData->description}}</td>
                <td>{{$productData->price}}</td>
                <td>
                    <a href="{{ route('.edit', ['lm' => $productData->lm]) }}" >Edit</a> |
                    <a href="{{ route('.delete', ['lm' => $productData->lm]) }}" >Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@else
    <p>Empty record</p>
@endif

</body>
</html>