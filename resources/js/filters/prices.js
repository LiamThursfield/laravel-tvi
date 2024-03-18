import Vue from 'vue';

Vue.filter('priceDecimal', function (value) {
    if (!value) {
        return value;
    }

    return (value / 100).toFixed(2);
});

Vue.filter('currencySymbol', function (value) {
    let symbolMap = {
        'GBP': '£',
        'RON': 'RON',
        'USD': '$',
        'EUR': '€',
    }

    if (symbolMap.hasOwnProperty(value)) {
        return symbolMap[value];
    }

    return "$";
});
