import Vue from 'vue';

Vue.filter('priceDecimal', function (value) {
    if (!value) {
        return value;
    }

    return (value / 100).toFixed(2);
});
