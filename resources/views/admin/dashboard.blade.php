@extends('layouts.app')
@section('content')
<div class="container">
 <h1>Dashboard Administrativo</h1>
 <div class="row">
 <div class="col-md-3">
 <div class="card">
 <div class="card-body">
 <h5>Total Posts</h5>
 <p class="h2">{{ $total_posts }}</p>
 </div>
 </div>
 </div>
 <div class="col-md-3">
 <div class="card">
 <div class="card-body">
 <h5>Total Usuarios</h5>
 <p class="h2">{{ $total_users }}</p>
 </div>
 </div>
 </div>
 <div class="col-md-3">
 <div class="card">
 <div class="card-body">
 <h5>Total Comentarios</h5>
 <p class="h2">{{ $total_comments }}</p>
 </div>
 </div>
 </div>
 </div>
 <div class="row mt-4">
 <div class="col-md-6">
 <h3>Posts Recientes</h3>
 <table class="table">
 <thead>
 <tr>
 <th>Título</th>

 <th>Autor</th>
 <th>Fecha</th>
 </tr>
 </thead>
 <tbody>
 @forelse($recent_posts as $post)
 <tr>
 <td>{{ $post->title }}</td>
 <td>{{ $post->author->name }}</td>
 <td>{{ $post->created_at->format('d/m/Y') }}</td>
 </tr>
 @empty
 <tr>
 <td colspan="3">Sin posts</td>
 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 <div class="col-md-6">
 <h3>Auditoría Reciente</h3>
 <table class="table">
 <thead>
 <tr>
 <th>Usuario</th>
 <th>Acción</th>
 <th>Modelo</th>
 <th>Fecha</th>
 </tr>
 </thead>
 <tbody>
 @forelse($recent_audits as $audit)
 <tr>
 <td>{{ $audit->user_name }}</td>
 <td>{{ $audit->action }}</td>
 <td>{{ $audit->model_type }}</td>
 <td>{{ $audit->created_at->format('d/m/Y H:i') }}</td>
 </tr>
 @empty
 <tr>
 <td colspan="4">Sin cambios registrados</td>

 </tr>
 @endforelse
 </tbody>
 </table>
 </div>
 </div>
</div>
@endsection
