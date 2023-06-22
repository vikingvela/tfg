<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <ul>
            <?php foreach ($deportes as $deporte) : ?>
                <li>
                    <a href="/deporte?id=<?= $deporte['id'] ?>" class="text-blue-500 hover:underline">
                        <?= htmlspecialchars($deporte['body']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="card">
            <div class="card-header">
                Deportes en las que participas:
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table table">
                        <thead>
                            <tr>
                                <th scope="col">Column 1</th>
                                <th scope="col">Column 2</th>
                                <th scope="col">Column 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <td scope="row">R1C1</td>
                                <td>R1C2</td>
                                <td>R1C3</td>
                            </tr>
                            <tr class="">
                                <td scope="row">Item</td>
                                <td>Item</td>
                                <td>Item</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h4 class="card-title">Title</h4>
                <p class="card-text">Text</p>
            </div>
            <div class="card-footer text-muted">
                Footer
            </div>
        </div>
        <div> <!-- Mis equipos -->
            <div class="text-xl">
                <p>
                    Ligas en las que participas:
                </p>
            </div>
            <section class="ftco-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <!--
                        <div class="col-md-6 text-center mb-5">
                            <h3 class="heading-section">Table #07</h3>
                        </div>
                        --> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-wrap">
                                <table class="table table-bordered table-dark table-hover"; width="70%" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="adc0ccdfc6c2d9d9c2edc8c0ccc4c183cec2c0">[email&#160;protected]</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="bfd5dedcd0ddcbd7d0cdd1cbd0d1ffdad2ded6d391dcd0d2">[email&#160;protected]</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a5c9c4d7d7dcc7ccd7c1e5c0c8c4ccc98bc6cac8">[email&#160;protected]</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="39535651575d565c795c54585055175a5654">[email&#160;protected]</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>Gary</td>
                                            <td>Bird</td>
                                            <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="fa9d9b88839893889eba9f979b9396d4999597">[email&#160;protected]</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/jquery.min.js"></script>
            <script src="js/popper.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/main.js"></script>
            <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816" integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw==" data-cf-beacon='{"rayId":"7bae3000fb7a3850","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.3.0","si":100}' crossorigin="anonymous"></script>
        </div>
        <p class="mt-6">
            <a href="/deportes/create" class="text-blue-500 hover:underline">Crear Deporte</a>
        </p>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>
