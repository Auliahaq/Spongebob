document.addEventListener('DOMContentLoaded', () => {
  const kategoriLabels = window.chartData.kategoriLabels;
  const kategoriData = window.chartData.kategoriData;
  const tingkatLabels = window.chartData.tingkatLabels;
  const tingkatData = window.chartData.tingkatData;

  // Chart Kategori
  new Chart(document.getElementById('chartKategori'), {
    type: 'pie',
    data: {
      labels: kategoriLabels,
      datasets: [{
        data: kategoriData,
        backgroundColor: ['#002366', '#0055A4', '#3399FF', '#66CCFF', '#A9D6FF']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  });

  // Chart Tingkat Kesulitan
  new Chart(document.getElementById('chartTingkat'), {
    type: 'pie',
    data: {
      labels: tingkatLabels,
      datasets: [{
        data: tingkatData,
        backgroundColor: ['#FFD700', '#FFA500', '#FF4500']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  });
});
