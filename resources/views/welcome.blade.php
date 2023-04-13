<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@200;300;400;500&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Kodchasan:ital,wght@0,300;1,200;1,300&family=Montserrat:ital,wght@0,200;0,300;0,800;1,200;1,300;1,400;1,500;1,600;1,700&family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Parisienne&family=Playball&family=Poppins:ital,wght@0,100;0,200;0,300;0,800;0,900;1,100;1,200;1,300&family=Roboto+Condensed:wght@300;400;700&family=Roboto+Mono:ital,wght@0,100;1,100&family=Roboto:ital,wght@0,100;0,300;1,100&family=Rubik+Beastly&family=Teko:wght@300;400;500;600;700&display=swap" rel="stylesheet"> --}}


        <!-- Styles -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            $( function() {
              $( "#start_date" ).datepicker({
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                maxDate: new Date(Date.now()),
                inline: true
            });
              $( "#end_date" ).datepicker({
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                maxDate: new Date(Date.now()),
                inline: true
            });
            } );
        </script>

    </head>
    <body>

        <div class="container mx-auto px-1">
            <div class="pb-8">
                @if ($errors->any())
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Something went wrong...
                    </div>
                    <ul class="border border-t-0 border-red-400 rounded-b bg-red-1000 px-4 py-3 text-red-700">
                        @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>  
                        @endforeach
                    </ul>
                @endif
            </div>
            <div>
            </div>
          <form class="w-full" action="{{ route('send') }}" method="POST">
            @csrf
            <div class="flex flex-col items-center mt-7">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                  Company Symbol
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="company_symbol" name="company_symbol" type="text" value="{{ old('company_symbol') }}" placeholder="XXXXX" required>
                <p class="text-red-500 text-xs italic"></p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full">
                  <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="start_date">
                    Start Date
                  </label>
                  <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="start_date" name="start_date" value="{{ old('start_date') }}" type="text" required>
                </div>
              </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="end_date">
                  End Date
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="end_date" name="end_date" value="{{ old('end_date') }}" type="text" required>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
              <div class="w-full">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                  Email
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" name="email" type="text" value="{{ old('email') }}" placeholder="john@email.com" required>
              </div>
              </div>
              
              <div class="self-center">
                <div class="w-full">
    
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Send
                    </button>
                    
                </div>
                </div>
            </div>
        </div>
            
          </form>
          <canvas id="myChart" height="100px"></canvas>

          <div class="relative overflow-x-auto mt-5">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 px-5">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Open
                        </th>
                        <th scope="col" class="px-6 py-3">
                            High
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Close
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Volume
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @isset ($prices)
                        @foreach ($prices as $price)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ date( "d-m-Y" , $price['date'] ) }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $price['open'] ?? ''}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $price['high'] ?? ''}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $price['close'] ?? ''}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $price['volume'] ?? ''}}
                            </td>
                        </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
          
        </div>
    </body>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script type="text/javascript">
    
        var openData = {
            label: "Open",
            data: {{ Js::from($chartData['open'] ?? "") }},
            lineTension: 0,
            fill: false,
            borderColor: 'green'
        };

        var closeData = {
            label: "close",
            data: {{ Js::from($chartData['close'] ?? "") }},
            lineTension: 0,
            fill: false,
            borderColor: 'red'
        };

        var reportData = {
        labels: {{ Js::from($chartData['dates'] ?? "") }},
        datasets: [openData, closeData]
        };

        var chartOptions = {
        legend: {
            display: true,
            position: 'top',
            labels: {
            boxWidth: 80,
            fontColor: 'black'
            }
        }
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
    
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        var lineChart = new Chart(myChart, {
        type: 'line',
        data: reportData,
        options: chartOptions
        });
    </script> --}}
</html>
