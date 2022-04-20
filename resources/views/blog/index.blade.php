@extends('layouts.app')
@section('content')
<body style="background: lightgray">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <a href="{{ route('blog.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BLOG</a>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">NO</th>
                            <th scope="col">GAMBAR</th>
                            <th scope="col">JUDUL</th>
                            <th scope="col">CONTENT</th>
                            <th scope="col">AKSI</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                          @forelse ($blogs as $blog)
                            <tr>
                                <td class="fw-bold">{{ $no++ }}</td>
                                <td class="text-center">
                                    <img src="{{ Storage::url('public/blogs/').$blog->image }}" class="rounded" style="width: 150px">
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>{!! $blog->content !!}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                        <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                          @empty
                              <div class="alert alert-danger">
                                  Data Blog belum Tersedia.
                              </div>
                          @endforelse
                        </tbody>
                      </table>  
                      {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
