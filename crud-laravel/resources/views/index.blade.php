{{-- herda a view 'base' --}}
@extends('base')
{{-- cria a seção content, definida na base, para injetar o código --}}
@section('content')
    <h2>Veículos Cadastrados</h2>
    {{-- se a variável $vehicles não existir, mostra um h3 com uma mensagem --}}
    @if (!isset($vehicles))
        <h3 style="color: red">Nenhum Registro Encontrado!</h3>
        {{-- senão, monta a tabela com o dados --}}
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ano</th>
                    <th>Cor</th>
                    <th colspan="3">Opções</th>
                </tr>
            </thead>
            <tbody>
                {{-- itera sobre a coleção de veículos --}}
                @foreach ($vehicles as $v)
                    <tr>
                        <td>{{ $v->name }} </td>
                        <td> {{ $v->year }} </td>
                        <td> {{ $v->color }} </td>
                        {{-- vai para a rota show, passando o id como parâmetro --}}
                        <td> <a href="{{ route('vehicles.show', $v->id) }}" class="btn btn-info" ><i class="bi bi-eye"></i> Exibir</a> </td>
                        <td> <a href="{{ route('vehicles.edit', $v->id) }}" class="btn btn-info" ><i class="bi bi-pencil"></i> Editar</a> </td>
                       <td> <button form="delete-form" type="submit" value="Excluir" class="btn btn-danger" ><i class="bi bi-trash"></i> Excluir </button></td>
    
                    </tr>
                @endforeach
            
            


</tbody>
            {{-- form para exclusão --}}
    <form method="POST" class="form" id="delete-form" action="{{ route('vehicles.destroy', $v->id) }}">
        @csrf
        {{-- o método HTTP para exclusão deve ser o DELETE --}}
        @method('DELETE')
       
    </form>
            <tfoot>
                <tr>
                    {{-- mostra a qtde de veículos cadastrados. --}}
                    <td colspan="6">Veículos Cadastrados: {{ $vehicles->count() }}</td>
                </tr>
            </tfoot>
        </table>
    @endif
    @if(isset($msg))
        <script>
            alert("{{$msg}}");
        </script>
    @endif
@endsection