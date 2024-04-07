@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
<div class="container">

    <div id="chartData"
        data-total-votes="{{ $totalVotes }}"
        data-total-reviews="{{ $totalReviews }}"
        data-total-messages="{{ $totalMessages }}"
    ></div>
    <div class="row">
      <div class="col-6">
        <canvas id="myChart"></canvas>
      </div>
      <div class="col-6">
        <canvas id="myChart2"></canvas>
      </div>
    </div>
</div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
      // GRAFICO TOTALI VOTI MESSAGGI E RECENSIONI
      const ctx = document.getElementById('myChart');
      const chartDataElement = document.getElementById('chartData');

        const totalVotes = chartDataElement.dataset.totalVotes;
        const totalReviews = chartDataElement.dataset.totalReviews;
        const totalMessages = chartDataElement.dataset.totalMessages;

  
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Voti', 'Recensioni', 'Messaggi'],
        datasets: [{
          label: 'Totale voti messaggi e recensioni',
          data: [totalVotes, totalReviews, totalMessages],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    //GRAFICO A TORTA VOTAZIONI
    const ctx2 = document.getElementById('myChart2');
    const voteCounts = {!! json_encode($voteCounts) !!};
    const labels = Object.keys(voteCounts);
    const data = Object.values(voteCounts);
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Le tue votazioni',
                data: data,
                backgroundColor: [
                    'rgb(255, 157, 157)',
                    'rgb(255, 216, 157)',
                    'rgb(211, 211, 211)',
                    'rgb(161, 250, 113)',
                    'rgb(113, 188, 250)',
                ],
                borderColor: [
                    'rgba(226, 226, 226, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
  
@endsection

