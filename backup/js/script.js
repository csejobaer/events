$(document).ready(function(){



 const ctx = document.getElementById('revenue');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
	    borderColor: '#e84393',
	    backgroundColor: '#e84393',
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






 const rev = document.getElementById('participent');

  new Chart(rev, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May','Jun','Jul'],
      datasets: [{
        label: '# of Votes',
        data: [500, 650, 200, 710,  300, 800, 900],
	    borderColor: '#e84393',
	    backgroundColor: '#e84393',
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




});

