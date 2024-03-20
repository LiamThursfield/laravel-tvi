import { router } from '@inertiajs/vue2'

router.on('navigate', (event) => {
    try {
        dataLayer.push({
            'url': event.detail.page.url,
            'event': 'pageview'
        });
    } catch (e) {
        console.info('Failed to push datalayer', e);
    }
})
