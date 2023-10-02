<!DOCTYPE html>
<html>
<head>
    <title>
        Import a csv file to db
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="col-4 d-flex justify-content-center">
    <div>
        <div style="display: flex">
            <h2>Upload CSV File</h2>
            <div id="loader" class="spinner-border text-info" role="status" style="display: none">
                <span class="sr-only"></span>
            </div>
        </div>

        @if(session()->has('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        @if(session()->has('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif

        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" accept=".csv" name="csv_file">
            <button type="submit" id="importButton">Import CSV</button>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>

<script>

    document.getElementById('importButton').addEventListener('click', function () {
        // Show the loader when the import button is clicked
        document.getElementById('loader').style.display = 'block';
    });
</script>
