import Vue from 'vue';
import dayjs from 'dayjs';

Vue.filter('humanFriendlyDateTime', function (value) {
    if (!value) {
        return value;
    }

    try {
        return dayjs(value).format('D MMM YYYY HH:mm')
    } catch (e) {
        return value;
    }
});

Vue.filter('humanFriendlyDate', function (value) {
    if (!value) {
        return value;
    }

    try {
        return dayjs(value).format('D MMM YYYY HH:mm')
    } catch (e) {
        return value;
    }
});
