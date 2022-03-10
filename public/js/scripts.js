let mychart = document.getElementById('mychart')

let orders = (JSON.parse(mychart.dataset.orders));
let customers = (JSON.parse(mychart.dataset.customers));

orderDates = [];
orders.forEach(function (orderItem) {
    orderDates.push(orderItem.date)
});

orderNumbers = [];
orders.forEach(function (orderItem) {
    orderNumbers.push(orderItem.count)
});


customersDates = [];
customers.forEach(function (customerItem) {
    customersDates.push(customerItem.date)
});

customerNumbers = [];
customers.forEach(function (customerItem) {
    customerNumbers.push(customerItem.count)
});


new Chart(document.getElementById("line-chart"), {
    type: 'line',
    data: {
        labels: orderDates,
        datasets: [{
            data: orderNumbers,
            label: "Orders",
            borderColor: "#3e95cd",
            fill: false
        }, {
            data: customerNumbers,
            label: "Customers",
            borderColor: "#8e5ea2",
            fill: false
        }
        ]
    },
    options: {
        title: {
            display: true,
            text: 'Customers and orders growth in last 30 days'
        }
    }
});




