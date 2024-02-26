<template>
    <section class="px-4 py-6 shadow-subtle">
        <div class="container max-w-screen-lg mx-auto">
            <div class="flex items-center space-x-4">
                <span class="text-lg font-bold">{{ __('messages.faq') }}</span>
            </div>

            <div
                v-for="(faq, index) in faqs"
                :key="'faq-card-' + index"
                class="max-w-screen-lg"
                style="border: 0;
                    margin-bottom: 30px;
                    margin-top: 30px;
                    border-radius: 6px;
                    color: #333333;
                    background: #fff;
                    width: 100%;
                    box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    min-width: 0;
                    word-wrap: break-word;
                    font-size: .875rem;
                "
            >
                <div class="card-header">
                    <h3 class="p-2 font-extrabold text-lg">
                        <button class="button tox-button-link" data-toggle="collapse" :data-target="'#collapse-' + index" aria-expanded="true" aria-controls="collapseOne">
                            {{ faq.question }}
                        </button>
                    </h3>
                    <br>
                    <h3 class="p-2 font-medium">{{ faq.answer }}</h3>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "Faq",
        data() {
            return {
                faqs: [
                    {
                        'question': 'Question 1',
                        'answer': 'Answer 1',
                    },
                    {
                        'question': 'Question 2',
                        'answer': 'Answer 2',
                    },
                    {
                        'question': 'Question 3',
                        'answer': 'Answer 3',
                    },
                    {
                        'question': 'Question 4',
                        'answer': 'Answer 4',
                    }
            ],
            }
        }
    }
</script>
