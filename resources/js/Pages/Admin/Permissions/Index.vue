<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permissions
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <create-permission-form></create-permission-form>

            <div v-if="permissions.length > 0">
                <jet-section-border/>

                <!-- Manage Application Permissions -->
                <div class="mt-10 sm:mt-0">
                    <jet-action-section>
                        <template #title>
                            Manage Permissions
                        </template>

                        <template #description>
                            You may delete any of your existing permissions if they are no longer needed.
                        </template>

                        <!-- Permissions List -->
                        <template #content>
                            <div class="space-y-6">
                                <div v-for="permission in permissions" class="flex items-center justify-between">
                                    <div>
                                        {{ permission.name }}
                                    </div>

                                    <div class="flex items-center">
                                        <div v-if="permission.created_at" class="text-sm text-gray-400">
                                            Created {{ fromNow(permission.created_at) }}
                                        </div>

                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                                                @click="permissionBeingDeleted = permission">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </jet-action-section>
                </div>
            </div>

            <!-- Delete Permission Confirmation Modal -->
            <jet-confirmation-modal :show="permissionBeingDeleted" @close="permissionBeingDeleted = null">
                <template #title>
                    Delete Permission
                </template>

                <template #content>
                    Are you sure you would like to delete this permission?
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="permissionBeingDeleted = null">
                        Nevermind
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2" @click.native="deletePermission"
                                       :class="{ 'opacity-25': deletePermissionForm.processing }"
                                       :disabled="deletePermissionForm.processing">
                        Delete
                    </jet-danger-button>
                </template>
            </jet-confirmation-modal>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../../Layouts/AppLayout'
    import JetSectionBorder from './../../../Jetstream/SectionBorder'
    import JetActionSection from './../../../Jetstream/ActionSection'
    import JetConfirmationModal from './../../../Jetstream/ConfirmationModal'
    import JetDangerButton from './../../../Jetstream/DangerButton'
    import JetSecondaryButton from './../../../Jetstream/SecondaryButton'
    import CreatePermissionForm from "./CreatePermissionForm";

    export default {
        props: {
            permissions: {
                type: Array,
                default: function () {
                    return []
                },
            }
        },

        components: {
            AppLayout,
            JetSectionBorder,
            JetActionSection,
            JetConfirmationModal,
            JetDangerButton,
            JetSecondaryButton,
            CreatePermissionForm,
        },

        data() {
            return {
                deletePermissionForm: this.$inertia.form(),
                permissionBeingDeleted: null,
            }
        },

        methods: {
            deletePermission() {
                this.deletePermissionForm.delete('/permissions/' + this.permissionBeingDeleted.id, {
                    preserveScroll: true,
                    preserveState: true,
                }).then(() => {
                    this.permissionBeingDeleted = null
                })
            },

            fromNow(timestamp) {
                return moment(timestamp).local().fromNow()
            },

        }
    }
</script>
