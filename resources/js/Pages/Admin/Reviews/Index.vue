<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Review Bookings
      </h2>
    </template>


    <div v-if="bookings.length > 0">
      <jet-section-border/>

      <div class="mx-10 mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
          <div class="mt-10 sm:mt-0">
            <div class="space-y-6">
              <div v-for="booking in bookings" class="flex items-center justify-between">
                <div class="flex items-center">
                  <div class="text-md mr-3">
                    {{ booking.id }}
                  </div>
                  <div class="text-sm text-gray-400">
                    {{ booking.requester.name }}
                  </div>
                </div>

                <div class="flex items-center">
                  <div v-if="booking.created_at" class="text-sm text-gray-400">
                    Created {{ booking.created_at }}
                  </div>

                  <div v-if="booking.reviewers > 0" class="text-sm text-gray-400">
                  </div>

                  <x-select v-model="booking.reviewers" class="mt-1 block w-full">
                    <option :value="null" selected="selected">Choose here</option>
                    <option v-for="room in availableRooms" :key="room.id" :value="room.id">{{room.name}}</option>
                  </x-select>

                  <button class="cursor-pointer ml-6 text-sm text-blue-800 focus:outline-none"
                          @click="debug(booking)">
                    Approve
                  </button>

                  <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                          @click="debug(booking)">
                    Deny
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    </app-layout>
</template>

<script>
import JetSectionBorder from '@src/Jetstream/SectionBorder'
import XSection from "@src/Components/XSection"
import XSelect from "@src/Components/Form/Select"
import AppLayout from '@src/Layouts/AppLayout'

export default {
  components: {
    AppLayout,
    JetSectionBorder,
    XSection,
    XSelect,
  },
  props: {
    bookings: {
      type: Array,
      default: function () {
        return []
      },
    }
  },
  mounted(){
  },
  data() {
    return {
    }
  },
  methods:{
    debug(a) {
      alert(a)
      console.log(a)
    }
  }
}
</script>
