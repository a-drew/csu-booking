<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Permissions
            </h2>
        </template>

      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div v-if="permissions.length > 0">
          <jet-section-border />

          <!-- Manage Application Permissions -->
          <div class="mt-10 sm:mt-0">
            <jet-action-section>
              <template #title>
                Manage Permissions
              </template>

              <template #description>
                You may delete any of your existing tokens if they are no longer needed.
              </template>

              <!-- Permissions List -->
              <template #content>
                <div class="space-y-6">
                  <div class="flex items-center justify-between" v-for="permission in permissions">
                    <div>
                      {{ permission.name }}
                    </div>

                    <div class="flex items-center">

                      <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none">
                        Delete
                      </button>
                    </div>
                  </div>
                </div>
              </template>
            </jet-action-section>
          </div>
        </div>
      </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../../Layouts/AppLayout'
    import JetActionSection from './../../../Jetstream/ActionSection'
    import JetSectionBorder from './../../../Jetstream/SectionBorder'

    export default {
        props: [
            'permissions',
        ],

        components: {
          AppLayout,
          JetSectionBorder,
          JetActionSection,
        },
    }
</script>
