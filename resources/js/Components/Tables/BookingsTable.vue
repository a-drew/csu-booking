<template>
  <div class="table-container">
    <div class="table-filter-container">
      <input type="text"
         placeholder="Search Bookings"
         v-model="filter" 
         />
    </div>
     
    <table class="table-auto responsive-spaced">
      <caption></caption>
      <thead>
        <tr>
          <th class="lt-grey" id="id_room_name">Room Name</th>
          <th class="lt-grey" id="id_room_number">Room Number</th>
          <th class="lt-grey" id="id_booking_date">Date/Time</th>
          <th class="lt-grey" id="id_booking_status">Status</th>
          <th class="lt-grey" id="id_booking_action">Action</th>
        </tr>
      </thead>
      <tbody>
         <tr v-for="booking in bookings" :key="booking.id">
            <td class="text-center lt-grey">{{booking.reservations[0].room.name}}</td>
            <td class="text-center lt-grey">{{booking.reservations[0].room.number}}</td>
            <td class="text-center lt-grey">{{formatDateMonth(booking.start_time)}} From:  {{formatDateTime(booking.start_time)}} To: {{formatDateTime(booking.start_end)}}</td>
            <td class="text-center lt-grey">{{booking.status}}</td>
            <td class="text-center lt-grey">
            <a :href="'/bookings/'+booking.id+'/edit'">
              <button class="h-10 px-5 m-2 text-gray-100 transition-colors duration-150 bg-gray-700 rounded-lg focus:shadow-outline hover:bg-gray-800">
                Edit
              </button>
            </a>
            </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import moment from "moment";

export default {
  props: {
    bookings: {
      type: Array,
      default: [],
      required: true
    },
  },
  data() {
      return {
          filter: '',
          roomBeingBooked: null
      }
  },
      methods: {
            formatDateTime(date) {
                return moment(date).format('h:mm:ss a')
            },
            formatDateMonth(date) {
                return moment(date).format('MMM Do YYYY')
            }

        }


};
</script>
