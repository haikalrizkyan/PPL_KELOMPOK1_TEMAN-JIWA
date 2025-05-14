@extends('psikolog.layouts.app')

@push('style')
    <style>
        .truncate-2-lines {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 3.4em;
            /* tambahkan ini */
            line-height: 1.6em;
            /* ini buat pastikan 2 baris */
        }

        .no-wrap {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endpush

@section('title', 'Article - Teman Jiwa')


@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mb-3">
        <div class="card shadow p-4">
            <form action="{{ route('psikolog.article.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" id="article_title" placeholder="Enter Article Title"
                        name="title">
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Cover</label>
                    <input type="file" class="form-control" id="article_cover" placeholder="Enter Article Cover"
                        name="cover">
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">First Section Description</label>
                    <textarea class="form-control" id="article_first_section" placeholder="Enter Article First Section Description"
                        name="first_section"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">First Section Attachment</label>
                    <input type="file" class="form-control" id="article_first_section_attachment"
                        placeholder="Enter Article First Section Attachment" name="first_attachment">
                </div>

                <hr class="my-4">

                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Second Section Description</label>
                    <textarea class="form-control" id="article_second_section" placeholder="Enter Article Second Section Description"
                        name="second_section"></textarea>
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputEmail1">Second Section Attachment</label>
                    <input type="file" class="form-control" id="article_second_section_attachment"
                        placeholder="Enter Article Second Section Attachment" name="second_attachment">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <div class="container">
        <table class="table table-striped table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Title</th>
                    <th scope="col" class="no-wrap">Uploaded Time</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $index => $data)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td class="truncate-2-lines">{{ $data->first_section }}</td>
                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#Modal{{ $data->id }}">
                                Detail
                            </button></td>
                    </tr>
                    <div class="modal fade" id="Modal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $data->title }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('psikolog.article.update', $data->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group mb-2">
                                            <label for="exampleInputEmail1">Title</label>
                                            <input type="text" class="form-control" id="article_title"
                                                placeholder="Enter Article Title" name="title"
                                                value="{{ $data->title }}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="exampleInputEmail1">Cover</label><br>
                                            <img src="{{ url('article/cover/' . $data->cover) }}" class="img-fluid rounded" alt="Description of image">
                                            <input type="file" class="form-control" id="article_cover"
                                                placeholder="Enter Article Cover" name="cover">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="exampleInputEmail1">First Section Description</label>
                                            <textarea class="form-control" id="article_first_section" placeholder="Enter Article First Section Description"
                                                name="first_section">{{ $data->first_section }}</textarea>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="exampleInputEmail1">First Section Attachment</label><br>    
                                            @if(in_array(strtolower(pathinfo($data->first_attachment, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'svg'])
                                            )
                                            <img src="{{ url('article/attachment/images/' . $data->first_attachment) }}" class="img-fluid rounded">
                                            @else
                                            <div class="ratio ratio-4x3">
                                                <video controls>
                                                  <source src="{{ url('article/attachment/videos/' . $data->first_attachment) }}" type="video/mp4">
                                                  Your browser does not support the video tag.
                                                </video>
                                              </div>
                                            @endif
                                            <input type="file" class="form-control"
                                                id="article_first_section_attachment"
                                                placeholder="Enter Article First Section Attachment"
                                                name="first_attachment">
                                        </div>

                                        <hr class="my-4">

                                        <div class="form-group mb-2">
                                            <label for="exampleInputEmail1">Second Section Description</label>
                                            @if ($data->second_section)
                                                <textarea class="form-control" id="article_second_section" placeholder="Enter Article Second Section Description"
                                                    name="second_section">{{ $data->second_section }}</textarea>
                                            @else
                                                <textarea class="form-control" id="article_second_section" placeholder="Enter Article Second Section Description"
                                                    name="second_section">No Data For Second Section</textarea>
                                            @endif
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="exampleInputEmail1">Second Section Attachment</label><br>
                                            @if($data->second_attachment)
                                            @if(in_array(strtolower(pathinfo($data->second_attachment, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                                            <img src="{{ url('article/attachment/images/' . $data->second_attachment) }}" class="img-fluid rounded">
                                            @else
                                            <div class="ratio ratio-4x3">
                                                <video controls>
                                                  <source src="{{ url('article/attachment/videos/' . $data->second_attachment) }}" type="video/mp4">
                                                  Your browser does not support the video tag.
                                                </video>
                                              </div>
                                            @endif
                                            @else
                                              No Attachment On Second Section
                                            @endif
                                            <input type="file" class="form-control"
                                                id="article_second_section_attachment"
                                                placeholder="Enter Article Second Section Attachment"
                                                name="second_attachment">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </form>
                                <form action="{{route('psikolog.article.delete', $data->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
