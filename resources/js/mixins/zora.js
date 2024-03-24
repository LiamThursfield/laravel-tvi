import Vue from "vue";
import _, {snakeCase} from 'lodash';

Vue.mixin({
    methods: {
        formatTransKey(key) {
            return _.snakeCase(key);
        },
        transWithFallback(key, fallbackValue) {
            let translation = this.trans(key);

            // If the key is the same, there is no translation
            if (translation === key) {
                return fallbackValue;
            }

            return translation;
        }
    }
});
