@include('includes.header')

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="orange">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
                <a href="https://www.facebook.com/Olivia-221586811741271/" class="simple-text logo-normal">
                    Olivia
                </a>
            </div>
           @include('includes.sidebar')
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo">Complains</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{ $title }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Description
                                            </th>
                                            <th>
                                                Location
                                            </th>
                                            <th class="text-right">
                                                Time
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach($complains as $complain)
                                            <tr>
                                                <td>
                                                    Anonymous
                                                </td>
                                                <td>
                                                    {{ $complain->description }}
                                                </td>
                                                <td>
                                                    Nicosia
                                                </td>
                                                <td class="text-right">
                                                    {{ $complain->created_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
@include('includes.footer')
