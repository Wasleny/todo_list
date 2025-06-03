<section class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erros encontrados:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h1 class="text-center mt-4">{{ $title }}</h1>

                <div class="card-body">
                    <form method="POST" action="{{ $route }}">
                        @csrf

                        @if ($type == 'post')
                            @method('POST')
                        @endif

                        @if ($type == 'update')
                            @method('PUT')
                        @endif

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Título</label>

                            <div class="col-md-6">
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ $task ? $task->title : old('title') }}" required autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if ($type == 'update')
                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Status</label>

                                <div class="col-md-6">
                                    <select id="status" class="form-control @error('status') is-invalid @enderror"
                                        name="status" required>
                                        <option></option>
                                        <option value={{ \App\Enums\Status::PENDING }}>{{ \App\Enums\Status::PENDING }}
                                        </option>
                                        <option value={{ \App\Enums\Status::COMPLETED }}>
                                            {{ \App\Enums\Status::COMPLETED }}
                                        </option>
                                    </select>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Descrição</label>

                            <div class="col-md-6">
                                <textarea id="description" name="description" class="form-control" @error('description') is-invalid @enderror>
                                    {{ $task ? $task->description : old('description') }}
                                </textarea>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
