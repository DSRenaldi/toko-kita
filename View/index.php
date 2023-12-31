<?php
require_once './connection.php';
global $connect;

// Card
$penjualan_max = mysqli_query($connect, "SELECT MAX(Penjualan) AS max_penjualan FROM tokokita");
$rows_pen_max_cd = [];
while ($row_pen_max_cd = mysqli_fetch_assoc($penjualan_max)) {
    $rows_pen_max_cd[] = $row_pen_max_cd;
}

$penjualan_min = mysqli_query($connect, "SELECT MIN(Penjualan) AS min_penjualan FROM tokokita");
$rows_pen_min_cd = [];
while ($row_pen_min_cd = mysqli_fetch_assoc($penjualan_min)) {
    $rows_pen_min_cd[] = $row_pen_min_cd;
}

$pembelian_max = mysqli_query($connect, "SELECT MAX(Pembelian) AS max_pembelian FROM tokokita");
$rows_pem_max_cd = [];
while ($row_pem_max_cd = mysqli_fetch_assoc($pembelian_max)) {
    $rows_pem_max_cd[] = $row_pem_max_cd;
}

$pembelian_min = mysqli_query($connect, "SELECT MIN(Pembelian) AS min_pembelian FROM tokokita");
$rows_pem_min_cd = [];
while ($row_pem_min_cd = mysqli_fetch_assoc($pembelian_min)) {
    $rows_pem_min_cd[] = $row_pem_min_cd;
}

$jual_max = mysqli_query($connect, "SELECT MAX(Jual) AS max_jual FROM tokokita");
$rows_jual_max_cd = [];
while ($row_jual_max_cd = mysqli_fetch_assoc($jual_max)) {
    $rows_jual_max_cd[] = $row_jual_max_cd;
}

$jual_min =  mysqli_query($connect, "SELECT MIN(Jual) AS min_jual FROM tokokita");
$rows_jual_min_cd = [];
while ($row_jual_min_cd = mysqli_fetch_assoc($jual_min)) {
    $rows_jual_min_cd[] = $row_jual_min_cd;
}

$beli_max = mysqli_query($connect, "SELECT MAX(Beli) AS max_beli FROM tokokita");
$rows_beli_max_cd = [];
while ($row_beli_max_cd = mysqli_fetch_assoc($beli_max)) {
    $rows_beli_max_cd[] = $row_beli_max_cd;
}

$beli_min =  mysqli_query($connect, "SELECT MIN(Beli) AS min_beli FROM tokokita");
$rows_beli_min_cd = [];
while ($row_beli_min_cd = mysqli_fetch_assoc($beli_min)) {
    $rows_beli_min_cd[] = $row_beli_min_cd;
}

$qty_max = mysqli_query($connect, "SELECT MAX(Qty) AS max_qty FROM tokokita");
$rows_qty_max_cd = [];
while ($row_qty_max_cd = mysqli_fetch_assoc($qty_max)) {
    $rows_qty_max_cd[] = $row_qty_max_cd;
}

$qty_min = mysqli_query($connect, "SELECT MIN(Qty) AS min_qty FROM tokokita");
while ($row_qty_min_cd = mysqli_fetch_assoc($qty_min)) {
    $rows_qty_min_cd[] = $row_qty_min_cd;
}

$penjualan = mysqli_query($connect, "SELECT AVG(Penjualan) AS penjualan FROM tokokita");
$rows_pen_ct = [];
while ($row_pen_ct = mysqli_fetch_assoc($penjualan)) {
    $rows_pen_ct[] = $row_pen_ct;
}

$tanggal = mysqli_query($connect, "SELECT Tanggal AS tanggal FROM tokokita");
$rows_tgl_ct = [];
while ($row_tgl_ct = mysqli_fetch_assoc($tanggal)) {
    $rows_tgl_ct[] = $row_tgl_ct;
}

$sql = "SELECT Tanggal, Penjualan FROM tokokita ORDER BY Tanggal ASC";
$result = $connect->query($sql);
$result = mysqli_query($connect, $sql);
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard TokoKita</title>
    <link rel="stylesheet" href="output.css">
    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />
    <!-- Plotly JS -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!-- Tailwind CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>

    <?php include('../Component/navbar.php'); ?>
    <div class="container mx-auto">
        <h1 class="text-center text-4xl my-9">DASHBOARD TOKOKITA TAHUN 2020 - APRIL 2021</h1>
        <!-- Filter -->
        <!-- <div class="flex justify-start gap-x-3">
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-slate-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-slate-800 dark:hover:bg-slate-800 dark:focus:ring-blue-800" type="button">
            Provinsi
            <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <div id="dropdown" class="z-10 hidden bg-emerald-500 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-emerald-500">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">test</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                </li>
            </ul>
        </div>

        <div>
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-slate-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-slate-800 dark:hover:bg-slate-800 dark:focus:ring-blue-800" type="button">Kota<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="dropdown" class="z-10 hidden bg-emerald-500 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-emerald-500">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-slate-800 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-slate-800 dark:hover:bg-slate-800 dark:focus:ring-blue-800" type="button">Bulan<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <div id="dropdown" class="z-10 hidden bg-emerald-500 divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-emerald-500">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
        </div> -->

        <div class="flex flex-row gap-x-12">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="flex flex-col gap-y-3 pt-20 pb-7">
                    <!-- Nilai Penjualan Tertinggi -->
                    <div class="ml-5 block max-w-[250px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Nilai Penjualan Tertinggi</h5>
                        <div class="text-center">
                            <?php foreach ($rows_pen_max_cd as $value) : ?>
                                <h1><?= $value['max_penjualan']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Nilai Penjualan Terendah -->
                    <div class="ml-5 block max-w-[250px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Nilai Penjualan Terendah</h5>
                        <div class="text-center">
                            <?php foreach ($rows_pen_min_cd as $value) : ?>
                                <h1><?= $value['min_penjualan']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-y-3 pt-20 pb-7">
                    <!-- Nilai Pembelian Tertinggi -->
                    <div class="ml-5 block max-w-[400px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Nilai Pembelian Tertinggi</h5>
                        <div class="text-center">
                            <?php foreach ($rows_pem_max_cd as $value) : ?>
                                <h1><?= $value['max_pembelian']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Nilai Pembelian Terendah -->
                    <div class="ml-5 block max-w-[400px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Nilai Pembelian Terendah</h5>
                        <div class="text-center">
                            <?php foreach ($rows_pem_min_cd as $value) : ?>
                                <h1><?= $value['min_pembelian']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-y-3 pt-7 pb-7">
                    <!-- Harga Jual Tertinggi -->
                    <div class="ml-5 block max-w-[250px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Harga Jual Tertinggi</h5>
                        <div class="text-center">
                            <?php foreach ($rows_jual_max_cd as $value) : ?>
                                <h1><?= $value['max_jual']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Harga Jual Terendah -->
                    <div class="ml-5 block max-w-[250px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Harga Jual Terendah</h5>
                        <div class="text-center">
                            <?php foreach ($rows_jual_min_cd as $value) : ?>
                                <h1><?= $value['min_jual']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-y-3 pt-7 pb-7">
                    <!-- Harga Beli Tertinggi -->
                    <div class="ml-5 block max-w-[250px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Harga Beli Tertinggi</h5>
                        <div class="text-center">
                            <?php foreach ($rows_beli_max_cd as $value) : ?>
                                <h1><?= $value['max_beli']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Harga Beli Terendah -->
                    <div class="ml-5 block max-w-[250px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Harga Beli Terendah</h5>
                        <div class="text-center">
                            <?php foreach ($rows_beli_min_cd as $value) : ?>
                                <h1><?= $value['min_beli']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>


                </div>
                <div class="flex flex-col gap-y-3 pt-7 pb-7">
                    <!-- Quantity Tertinggi -->
                    <div class="ml-5 block max-w-[250px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Quantity Tertinggi</h5>
                        <div class="text-center">
                            <?php foreach ($rows_qty_max_cd as $value) : ?>
                                <h1><?= $value['max_qty']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Quantity Terendah -->
                    <div class="ml-5 block max-w-[250px] p-3 bg-white border border-emerald-200 rounded-lg shadow  dark:bg-emerald-300 dark:border-emerald-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 text-black"> Quantity Terendah</h5>
                        <div class="text-center">
                            <?php foreach ($rows_qty_min_cd as $value) : ?>
                                <h1><?= $value['min_qty']; ?></h1>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-y-3">
                <!-- Penjualan -->
                <div class="mt-2" id='penjualan_ct'></div>

                <!-- Pembelian -->
                <div class="mt-3" id='pembelian_ct'></div>

                <!-- Harga Jual -->
                <div id='jual_ct'></div>

                <!-- Harga Beli -->
                <div id='beli_ct'></div>

                <!-- Quantity -->
                <div id='qty_ct'></div>
                <div id="output"></div>
            </div>
        </div>

        <script>
            var data = <?php echo json_encode($data); ?>;
            $("#output").text(JSON.stringify(data, null, 2));
            var xData = [];
            var yData = [];

            for (var i = 0; i < data.length; i++) {
                xData.push(data[i].kolom1);
                yData.push(data[i].kolom2);
            }

            var trace1 = {
                x: [1, 2, 3, 4],
                y: [10, 15, 13, 17],
                type: 'scatter'
            };

            var trace2 = {
                x: [1, 2, 3, 4],
                y: [16, 5, 11, 9],
                type: 'scatter'
            };

            var data = [trace1, trace2];

            var layout = {
                atuosize: false,
                margin: {
                    l: 20,
                    r: 20,
                    b: 20,
                    t: 35,
                },
                height: 275,
                width: 650,
                title: "Penjualan Per Tahun"
            };

            Plotly.newPlot('penjualan_ct', data, layout);

            // Pembelian Per Tahun
            var trace1 = {
                x: [1, 2, 3, 4],
                y: [10, 15, 13, 17],
                type: 'scatter'
            };

            var trace2 = {
                x: [1, 2, 3, 4],
                y: [16, 5, 11, 9],
                type: 'scatter'
            };

            var data = [trace1, trace2];

            var layout = {
                atuosize: false,
                margin: {
                    l: 20,
                    r: 20,
                    b: 20,
                    t: 35,
                },
                height: 275,
                width: 650,
                title: "Pembelian Per Tahun"
            };

            Plotly.newPlot('pembelian_ct', data, layout);

            // Harga Jual Per Tahun
            var trace1 = {
                x: [1, 2, 3, 4],
                y: [10, 15, 13, 17],
                type: 'scatter'
            };

            var trace2 = {
                x: [1, 2, 3, 4],
                y: [16, 5, 11, 9],
                type: 'scatter'
            };

            var data = [trace1, trace2];

            var layout = {
                atuosize: false,
                margin: {
                    l: 20,
                    r: 20,
                    b: 20,
                    t: 35,
                },
                height: 275,
                width: 650,
                title: "Harga Jual Per Tahun"
            };

            Plotly.newPlot('jual_ct', data, layout);

            // Harga Beli Per Tahun
            var trace1 = {
                x: [1, 2, 3, 4],
                y: [10, 15, 13, 17],
                type: 'scatter'
            };

            var trace2 = {
                x: [1, 2, 3, 4],
                y: [16, 5, 11, 9],
                type: 'scatter'
            };

            var data = [trace1, trace2];

            var layout = {
                atuosize: false,
                margin: {
                    l: 20,
                    r: 20,
                    b: 20,
                    t: 35,
                },
                height: 275,
                width: 650,
                title: "Harga Beli Per Tahun"
            };

            Plotly.newPlot('beli_ct', data, layout);

            // Quantity Per Tahun
            var trace1 = {
                x: [1, 2, 3, 4],
                y: [10, 15, 13, 17],
                type: 'scatter'
            };

            var trace2 = {
                x: [1, 2, 3, 4],
                y: [16, 5, 11, 9],
                type: 'scatter'
            };

            var data = [trace1, trace2];

            var layout = {
                atuosize: false,
                margin: {
                    l: 20,
                    r: 20,
                    b: 20,
                    t: 35,
                },
                height: 275,
                width: 650,
                title: "Quantity Per Tahun"
            };

            Plotly.newPlot('qty_ct', data, layout);
        </script>
    </div>
</body>

</html>