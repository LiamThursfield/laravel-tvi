import Vue from 'vue';
import Toasted from 'vue-toasted';
Vue.use(Toasted);


/**
 * Error Toast
 */
Vue.toasted.register('error',
    (payload) => {
        let message = 'Oops.. Something went wrong';
        if (payload.message)  {
            message = payload.message;
        }

        // If the icon should not be shown, simply return the message
        if (!payload.showIcon) {
            return message;
        }

        // Show the error icon with the message (Tabler Alert-Triangle Icon)
        return "<div class=\"flex flex-row items-center space-x-2\">\n" +
               "    <svg\n" +
               "        xmlns=\"http://www.w3.org/2000/svg\"\n" +
               "        width=\"24\"\n" +
               "        height=\"24\"\n" +
               "        viewBox=\"0 0 24 24\"\n" +
               "        stroke-width=\"2\"\n" +
               "        stroke=\"currentColor\"\n" +
               "        fill=\"none\"\n" +
               "        stroke-linecap=\"round\"\n" +
               "        stroke-linejoin=\"round\"\n" +
               "    >\n" +
               "        <path stroke=\"none\" d=\"M0 0h24v24H0z\" fill=\"none\"/>\n" +
               "        <path d=\"M12 9v2m0 4v.01\" />\n" +
               "        <path d=\"M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75\" />\n" +
               "    </svg>\n" +
               "    <span>" +
                       message + "\n" +
               "    </span>" +
               "</div>";
    },
    {
        type : 'error',
         duration : 3000,
    }
);

Vue.prototype.$errorToast = (message = null, showIcon = true) => Vue.toasted.global.error({
    message: message,
    showIcon: showIcon
});
