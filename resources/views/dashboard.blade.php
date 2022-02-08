<x-app-layout>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Bienvenue sur votre tableau de bord !  
                </div>
                <div id="mon-chart" style="height: 500px; width: 800px;" ></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
      
        function drawChart() {
      
         var data = google.visualization.arrayToDataTable([
            ['odpEvents', 'events'],
            @foreach ($odpEvents as $ODPEvent) 
            [ "{{ $ODPEvent->tags }}", {{ $eventCount }} ], 
            @endforeach
          ]);
          //var events = {!! json_encode($odpEvents->toArray()) !!}
      
      var options = {
        title: 'TEST', // Le titre
        is3D : true // En 3D
      };
      
      // On crée le chart en indiquant l'élément où le placer "#mon-chart"
      var chart = new google.visualization.PieChart(document.getElementById('mon-chart'));
      
      // On désine le chart avec les données et les options
      chart.draw(data, options);
      }
      </script>
</x-app-layout>
