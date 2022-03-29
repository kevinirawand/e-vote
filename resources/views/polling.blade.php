<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Polling</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-2">
        <form action="{{ route('store') }}" method="POST">
            @csrf
            @foreach ($data as $data)
            <div class="card mt-5">
                <div class="card-header">
                    <h3>{{ $data['title'] }}</h3>
                    <div class="float-right">
                        <p>{{ date('Y-m-d H:i:s', strtotime($data['created_at'])) }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <input type="text" name="polling_id" value="{{ $data['id'] }}">
                    <h6>{{ $data['description'] }}</h6>
                    @if ($data['has_voted'] == true)
                    @foreach ($data['choice'] as $choice)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="choice_id" value="{{ $choice['id'] }}" disabled>
                        <label class="form-check-label">{{ $choice['choice'] }}</label>
                        <div class="progress progress-xxs">
                            <div class="progress-bar bg-warning progress-bar-striped" role="progressbar"
                                 aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                              <span class="sr-only">60% Complete (warning)</span>
                            </div>
                          </div>
                    </div>
                    @endforeach
                    @else
                    @foreach ($data['choice'] as $choice)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="choice_id" value="{{ $choice['id'] }}">
                        <label class="form-check-label">{{ $choice['choice'] }}</label>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    @endif
            </div>

            @endforeach
        </form>
    </div>
</body>

</html>