<template>

    <!-- Assign Permissions to Role Modal -->
    <jet-dialog-modal :show="role" @close="closeModel">
        <template #title>
            Update Role
        </template>

        <template #content>
            <!-- Role Name -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Name"/>
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus/>
                <jet-input-error :message="form.error('name')" class="mt-2"/>
            </div>

            <!-- Permissions -->
            <div class="col-span-6" v-if="permissions.length > 0">
                <jet-label for="permissions" value="Permissions" />

                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="permission in permissions">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" :value="permission.name" v-model="form.permissions">
                            <span class="ml-2 text-md text-black">{{ permission.name }}</span>
                            <span class="ml-2 text-sm text-gray-600">{{ permission.guard_name }}</span>
                        </label>
                    </div>


                </div>
            </div>
        </template>

        <template #footer>
            <jet-secondary-button @click.native="closeModel">
                Nevermind
            </jet-secondary-button>

            <jet-button class="ml-2" @click.native="updateRole"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                Update
            </jet-button>
        </template>
    </jet-dialog-modal>
</template>

<script>
    import JetActionMessage from '@src/Jetstream/ActionMessage'
    import JetFormSection from '@src/Jetstream/FormSection'
    import JetDialogModal from '@src/Jetstream/DialogModal'
    import JetButton from '@src/Jetstream/Button'
    import JetSecondaryButton from '@src/Jetstream/SecondaryButton'
    import JetLabel from '@src/Jetstream/Label'
    import JetInput from '@src/Jetstream/Input'
    import JetInputError from '@src/Jetstream/InputError'

    export default {
        components: {
            JetActionMessage,
            JetFormSection,
            JetDialogModal,
            JetButton,
            JetSecondaryButton,
            JetLabel,
            JetInput,
            JetInputError,
        },

        props: {
            role: {
                type: Object,
                required: false,
            },
            permissions: {
                type: Array,
                default: () => {
                    return [];
                },
            }
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    permissions: [],
                }, {
                    bag: 'updateRole',
                })
            }

        },

        methods: {
            closeModel() {
                this.$emit('close');
            },
            updateRole() {
                this.form.put('/roles/' + this.role?.id, {
                    preserveState: true,
                }).then(() => {
                    this.closeModel();
                })
            },
        },
        watch: {
            role (role) {
                this.form.name = role?.name;
                this.form.permissions = role?.permissions.map((o) => {return o.name; });
            }
        }
    }
</script>
