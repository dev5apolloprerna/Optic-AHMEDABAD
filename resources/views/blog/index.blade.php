@extends('layouts.app')

@section('title', 'Blog List')

@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            {{-- Alert Messages --}}
            @include('common.alert')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        {{-- Card Header --}}
                        <div class="d-flex justify-content-between card-header">
                            <h5 class="card-title mb-0">Blog List</h5>

                            <a href="{{ route('blog.create') }}" class="btn btn-sm btn-primary">
                                <i data-feather="plus"></i> Add New
                            </a>
                        </div>

                        {{-- Card Body --}}
                        <div class="card-body">

                            <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Title</th>
                                        <th width="40%">Description</th>
                                        <th width="10%">Photo</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach ($Blog as $blog)
                                        <tr class="text-center">

                                            <td>
                                                {{ $i + $Blog->perPage() * ($Blog->currentPage() - 1) }}
                                            </td>

                                            <td>{{ $blog->strTitle }}</td>

                                            <td>
                                                {!! strip_tags(Str::limit($blog->strDescription, 150)) !!}
                                            </td>

                                            <td>
                                                @if($blog->strPhoto)
                                                    <a target="_blank" href="{{ asset('blog/'.$blog->strPhoto) }}">
                                                        <!--<img src="{{ asset('/uploads/Blog/Thumbnail/'.$blog->strPhoto) }}"-->
                                                        <!--    style="width:50px;height:50px;">-->
                                                        <img src="{{ asset('blog/'.$blog->strPhoto) }}" style="width:50px;height:50px;">
                                                            <!--<img src="https://electricexpo.co.in/blog/{{ $blog->strPhoto }}" style="width:50px;height:50px;">-->
                                                    </a>
                                                @else
                                                    <img src="{{ asset('assets/images/noimage.png') }}"
                                                        style="width:50px;height:50px;">
                                                @endif
                                            </td>

                                            <td>
                                                <div class="gap-2">

                                                    <a class="mx-1" title="Edit"
                                                        href="{{ route('blog.edit',$blog->blogId) }}">
                                                        <i class="far fa-edit"></i>
                                                    </a>

                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal"
                                                        onclick="deleteData({{ $blog->blogId }});">
                                                        <i class="fa fa-trash"></i>
                                                    </a>

                                                </div>
                                            </td>

                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-3">
                                {{ $Blog->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Delete Modal --}}
            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body text-center">

                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                trigger="loop"
                                colors="primary:#f7b84b,secondary:#f06548"
                                style="width:100px;height:100px">
                            </lord-icon>

                            <h4 class="mt-3">Are you Sure ?</h4>
                            <p class="text-muted">Do you really want to delete this blog?</p>

                            <div class="d-flex gap-2 justify-content-center mt-4">

                                <a class="btn btn-primary"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('blog-delete-form').submit();">
                                    Yes, Delete
                                </a>

                                <button class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>

                                <form id="blog-delete-form" method="POST" action="{{ route('blog.delete') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="blogId" id="deleteid">
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    function deleteData(id) {
        $("#deleteid").val(id);
    }
</script>

@endsection
