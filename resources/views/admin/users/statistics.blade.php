@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
<div id="chartData"
    data-total-votes="{{ $totalVotes }}"
    data-total-reviews="{{ $totalReviews }}"
    data-total-messages="{{ $totalMessages }}"
></div>
<div>
    <canvas id="myChart"></canvas>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
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
  </script>
  
@endsection

