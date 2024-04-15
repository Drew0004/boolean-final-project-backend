@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')

  <div class="container py-5">

    <h2 class="my-blue fw-bold text-center mb-5">Le tue statistiche:</h2>
    
      <div class="row">
        <h2  class="my-blue fw-bold mb-2">Sezione votazioni:</h2>
        <div class="col-6">
          <canvas id="myChart"></canvas>
        </div>
        <div class="col-6">
          <canvas id="myChart2"></canvas>
        </div>
        <div class="col-6">
            <canvas id="myChart3"></canvas>
          </div>
      </div>
      
      {{-- <div class="text-center">
        <h2 class="badge text-bg-danger fs-4">Ops! Sembra che tu non abbia ancora ricevuto Messaggi, Voti, o Recensioni!</h2>
      </div> --}}
  
  </div>
    
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
  <script>
    // Grafico media votazioni per mese
      const months = ['Gennaio', 'Febbraio', 'Marzo', 
      'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 
      'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
      const totalVotesPerMonth = {!! json_encode($totalVotesPerMonth) !!};
      const totalMessagesPerMonth = {!! json_encode($totalMessagesPerMonth) !!};

  
      // Imposta il contesto del grafico
      const ctx = document.getElementById('myChart').getContext('2d');
  
      // Definisci i dati del grafico
      const data = {
          labels: months,
          datasets: [{
              label: 'Media voti per mese',
              data: totalVotesPerMonth,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 205, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(201, 203, 207, 0.2)',
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 205, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
              ],
              borderColor: [
                  'rgb(255, 99, 132)',
                  'rgb(255, 159, 64)',
                  'rgb(255, 205, 86)',
                  'rgb(75, 192, 192)',
                  'rgb(54, 162, 235)',
                  'rgb(153, 102, 255)',
                  'rgb(201, 203, 207)',
                  'rgb(255, 99, 132)',
                  'rgb(255, 159, 64)',
                  'rgb(255, 205, 86)',
                  'rgb(75, 192, 192)',
                  'rgb(54, 162, 235)',
              ],
              borderWidth: 1
          }]
      };
  
      // Crea il grafico
      let myChart1 = new Chart(ctx, {
          type: 'bar',
          data: data
      });

    // Grafico media votazioni per anno
    const years = ['2020','2021', '2022', '2023', '2024'];
    const totalVotesPerYear = {!! json_encode(array_values($totalVotesPerYear)) !!}; // Utilizza array_values per ottenere solo i valori dall'array associativo

    // Imposta il contesto del grafico
    const ctx2 = document.getElementById('myChart2').getContext('2d');

    // Definisci i dati del grafico
    const chartData = {
        labels: years,
        datasets: [{
            label: 'Media voti per anno',
            data: totalVotesPerYear,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)'
            ],
            borderWidth: 1
        }]
    };

    // Crea il grafico
    let myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: chartData
    });


const ctx3 = document.getElementById('myChart3').getContext('2d');
  
  // Definisci i dati del grafico
  const messageMonthdata = {
      labels: months,
      datasets: [{
        label: 'Media messaggi per mese',
        data: totalMessagesPerMonth,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
  };

  // Crea il grafico
  let myChart3 = new Chart(ctx3, {
      type: 'line',
      data: messageMonthdata
  });
  
  </script>
  @endsection


