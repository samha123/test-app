<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                @if (! empty($breadcrumbs))
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Home</a></li>
                        @foreach ($breadcrumbs as $key => $url)
                            @if ('home' != $key && 'gem_admin' != $key)
                                @if(! is_int($key))
                                    @if ($loop->last)
                                        <li class="breadcrumb-item active"></li>
                                    @else
                                        <li class="breadcrumb-item">
                                            <a href="{{ url($url) }}">
                                                {{ ucfirst(str_replace(['_', '-'], ' ', $key))  }}
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </ol>

                @endif
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
