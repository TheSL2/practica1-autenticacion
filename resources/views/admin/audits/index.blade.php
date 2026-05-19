@extends('layouts.app')

@section('content')
<div style="padding: 20px; font-family: sans-serif;">
    <h2 style="margin-bottom: 20px;">Historial de Auditoría (Audit Trail)</h2>
    
    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #f4f6f9; border-bottom: 2px solid #dee2e6; text-align: left;">
                <th style="padding: 12px;">ID</th>
                <th style="padding: 12px;">Usuario</th>
                <th style="padding: 12px;">Acción</th>
                <th style="padding: 12px;">Modelo</th>
                <th style="padding: 12px;">Fecha</th>
                <th style="padding: 12px;">Detalles</th>
            </tr>
        </thead>
        <tbody>
            @forelse($audits as $item)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 12px;">{{ $item->id }}</td>
                    <td style="padding: 12px; font-weight: bold;">{{ $item->user_name ?? 'System' }}</td>
                    <td style="padding: 12px;">
                        <span style="background: #feebc8; color: #c05621; padding: 3px 8px; border-radius: 4px; font-size: 0.85em; font-weight: bold;">
                            {{ strtoupper($item->action) }}
                        </span>
                    </td>
                    <td style="padding: 12px; color: #4a5568;">{{ class_basename($item->model_type) }}</td>
                    <td style="padding: 12px;">{{ $item->created_at }}</td>
                    <td style="padding: 12px;">
                        <a href="{{ route('admin.audits.show', $item->id) }}" style="background: #3182ce; color: white; border: none; padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 0.9em;">Ver JSON</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 20px; text-align: center; color: #718096;">No hay registros de auditoría aún.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $audits->links() }}
    </div>
</div>
@endsection