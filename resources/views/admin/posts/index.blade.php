@extends('layouts.app')

@section('content')
<div style="padding: 20px; font-family: sans-serif;">
    <h2 style="margin-bottom: 20px;">Administración de Posts (CRUD)</h2>
    
    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #f4f6f9; border-bottom: 2px solid #dee2e6; text-align: left;">
                <th style="padding: 12px;">ID</th>
                <th style="padding: 12px;">Título</th>
                <th style="padding: 12px;">Categoría</th>
                <th style="padding: 12px;">Autor</th>
                <th style="padding: 12px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px;">{{ $post->id }}</td>
                    <td style="padding: 12px; font-weight: bold;">{{ $post->title }}</td>
                    <td style="padding: 12px;"><span style="background: #e2e8f0; padding: 3px 8px; border-radius: 4px; font-size: 0.85em;">{{ $post->category->name ?? 'Sin Categoría' }}</span></td>
                    <td style="padding: 12px;">{{ $post->author->name ?? 'Sistema' }}</td>
                    <td style="padding: 12px;">
                        <button style="background: #3182ce; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Editar</button>
                        <button style="background: #e53e3e; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Eliminar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 20px; text-align: center; color: #718096;">No hay posts registrados en el sistema.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $posts->links() }}
    </div>
</div>
@endsection