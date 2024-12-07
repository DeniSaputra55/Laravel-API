<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- boostrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <title>Laravel API</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Deni Saputra</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Todo List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <!-- Jumbotron -->
    <section class="jumbotron text-center">
        <img src="{{ asset('img/Foto.png') }}" alt="Deni Saputra" width="200" class="rounded-circle img-thumbnail" />

        <h1 class="display-4">Deni Saputra</h1>
        <p class="lead">Web Developer</p>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffff" fill-opacity="1" d="M0,96L30,122.7C60,149,120,203,180,229.3C240,256,300,256,360,250.7C420,245,480,235,540,213.3C600,192,660,160,720,138.7C780,117,840,107,900,106.7C960,107,1020,117,1080,144C1140,171,1200,213,1260,218.7C1320,224,1380,192,1410,176L1440,160L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
        </svg>
    </section>
    <!-- End Jumbotron -->
    <!-- Content -->
    <section id="about">
        <div class="container">
            <div class="row text-center mb-3">
                <div class="col">
                    <h2>Daftar Buku</h2>
                </div>
            </div>
            <div class="row justify-content-center fs-5 text-center">
                <div class="card">
                    <div class="card-header">
                        <a href="/add/buku" class="btn btn-success btn-sm float-end">Add New</a>
                    </div>
                    @if (Session::has('success'))
                    <span class="alert alert-success p-2">{{Session::get('success')}}</span>
                    @endif
                    @if (Session::has('fail'))
                    <span class="alert alert-danger p-2">{{Session::get('fail')}}</span>
                    @endif

                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Tanggal Publikasi</th>
                                <th colspan="3" class="text-center">Action</th>
                            </thead>
                            <tbody>
                                @if (count($data_buku )> 0)
                                @forEach($data_buku as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->judul}}</td>
                                    <td>{{$item->pengarang}}</td>
                                    <td>{{$item->tanggal_publikasi}}</td>
                                    <td>
                                        <a href="/buku/{{$item->id}}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/delete/{{$item->id}}" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Delete
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('buku.show', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i> Show
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8">No user Found!</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#e2edff" fill-opacity="1" d="M0,224L30,192C60,160,120,96,180,96C240,96,300,160,360,170.7C420,181,480,139,540,133.3C600,128,660,160,720,154.7C780,149,840,107,900,106.7C960,107,1020,149,1080,176C1140,203,1200,213,1260,208C1320,203,1380,181,1410,170.7L1440,160L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
        </svg>
    </section>
    <!-- End Content -->
    <!-- Footer  -->
    <footer class="bg-primary text-white text-center pb-5">
        <p>Crate With <i class="bi bi-heart-fill text-danger"></i> by <a href="https://www.instagram.com/dhenis______/" class="text-white fw-bold">Deni Saputra</a></p>
    </footer>
    <!-- End Footer  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>