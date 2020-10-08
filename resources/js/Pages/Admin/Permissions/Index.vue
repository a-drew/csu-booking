<template>
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Things
          </h2>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            </div>
        </div>
</template>

<script>
    import AppLayout from './../../../Layouts/AppLayout'
    import JetSectionBorder from './../../../Jetstream/SectionBorder'

    export default {
        props: [
            'permissions',
        ],

        components: {
        },
    }
</script>
