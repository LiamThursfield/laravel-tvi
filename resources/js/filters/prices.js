import Vue from 'vue';

Vue.filter('priceDecimal', function (value) {
    if (!value) {
        return value;
    }

    return (value / 100).toFixed(2);
});

// If the value is a whole number e.g. 100.00 vs. 100.10, don't show decimals
Vue.filter('priceDecimalUnlessWhole', function (value) {
    if (!value) {
        return value;
    }

    let decimalPlaces = 2;

    if (value % 100 === 0) {
        decimalPlaces = 0;
    }

    return (value / 100).toFixed(decimalPlaces);
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
