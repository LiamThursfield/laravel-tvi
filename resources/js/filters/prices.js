import Vue from 'vue';

Vue.filter('priceDecimal', function (value) {
    if (!value) {
        return value;
    }

    return value;
});

Vue.filter('currencySymbol', function (value) {
    let symbolMap = {
        'GBP': '£'
    }

    if (symbolMap.hasOwnProperty(value)) {
        return symbolMap[value];
    }

    return "$";
});
