<template>

    <!-- Generate Permission -->
    <jet-form-section @submitted="createPermission">
        <template #title>
            Create Permission
        </template>

        <template #description>
            Permissions are used across the application to authorize users when performing actions or viewing sensitive information.
        </template>

        <template #form>
            <!-- Permission Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name"/>
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus/>
                <jet-input-error :message="form.error('name')" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Created.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Create
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetActionMessage from './../../../Jetstream/ActionMessage'
    import JetFormSection from './../../../Jetstream/FormSection'
    import JetButton from './../../../Jetstream/Button'
    import JetLabel from './../../../Jetstream/Label'
    import JetInput from './../../../Jetstream/Input'
    import JetInputError from './../../../Jetstream/InputError'

    export default {
        components: {
            JetActionMessage,
            JetFormSection,
            JetButton,
            JetLabel,
            JetInput,
            JetInputError,
        },

        data() {
            return {

                form: this.$inertia.form({
                    name: '',
                }, {
                    bag: 'createPermission',
                    resetOnSuccess: true,
                })
            }

        },

        methods: {
            createPermission() {
                this.form.post('/permissions', {
                    preserveScroll: true,
                }).then(response => {
                    if (!this.form.hasErrors()) {
                        this.display = true
                    }
                })
            },
        }
    }
</script>

<style scoped>

</style>