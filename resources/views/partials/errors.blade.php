@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Houlà !</strong> Un problème est survenu :
        <br /><br />
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif