<template>
  <div class="table-container">
    <div class="table-filter-container">
      <input type="text"
         placeholder="Search Rooms Table"
         v-model="filter"
         />
        <button
            class="btn submit-btn"
            @click="toggleAdvancedFilters()"
        >Additional Search</button>
    </div>

    <table class="table-auto responsive-spaced">
      <caption></caption>
      <thead>
        <tr>
          <th class="lt-grey" id="id_room_id">Room Name</th>
          <th class="lt-grey" id="id_room_type">Room Type</th>
          <th class="lt-grey" id="id_room_building">Building</th>
          <th class="lt-grey" id="id_room_number">Number</th>
          <th class="lt-grey" id="id_room_floor">Floor</th>
          <th class="lt-grey" id="id_room_availability">Availability</th>
          <th class="lt-grey" id="id_room_reference">Reference</th>
          <th class="lt-grey" id="id_room_action">Action</th>
        </tr>
      </thead>
      <tbody>
         <tr v-for="room in filteredRooms" :key="room.id">
            <td class="text-center lt-grey">{{room.name}}</td>
            <td class="text-center lt-grey">{{room.room_type}}</td>
            <td class="text-center lt-grey">{{room.building}}</td>
            <td class="text-center lt-grey">{{room.number}}</td>
            <td class="text-center lt-grey">{{room.floor}}</td>
            <td class="text-center lt-grey">{{room.status}}</td>
            <td class="text-center lt-grey">Reference</td>
            <td class="text-center lt-grey">
              <button
                    class="h-10 px-5 m-2 text-gray-100 transition-colors duration-150 bg-gray-700 rounded-lg focus:shadow-outline hover:bg-gray-800"
                    @click="roomBeingBooked = room"
                  >Book
              </button>
            </td>
        </tr>
      </tbody>
    </table>

    <CreateBookingRequestModal
      :room="roomBeingBooked"
      @close="roomBeingBooked = null"
    ></CreateBookingRequestModal>

      <jet-dialog-modal :show="showFilterModal">
          <template #title>
              Additional Room Filters
          </template>

          <template #content>
              <div class="flex">
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Capacity Standing</h2></div>
                      <div class="flex flex-row">
                          <input
                              type="number"
                              id="capacity_standing"
                              class="form-input w-2/3 h-2/3"
                              v-model.number="jsonFilters.capacity_standing"
                          >
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Capacity Sitting</h2></div>
                      <div class="flex flex-row">
                          <input
                              type="number"
                              id="capacity_sitting"
                              class="form-input w-2/3 h-2/3"
                              v-model.number="jsonFilters.capacity_sitting"
                          >
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Coffee Tables</h2></div>
                      <div class="flex flex-row">
                          <input
                              type="number"
                              id="coffee_tables"
                              class="form-input w-2/3 h-2/3"
                              v-model.number="jsonFilters.coffee_tables"
                          >
                      </div>
                  </div>
              </div>

              <div class="flex flex-row">
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Tables</h2></div>
                      <div class="flex flex-row">
                          <input
                              type="number"
                              id="tables"
                              class="form-input w-2/3 h-2/3"
                              v-model.number="jsonFilters.tables"
                          >
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Chairs</h2></div>
                      <div class="flex flex-row">
                          <input
                              type="number"
                              id="chairs"
                              class="form-input w-2/3 h-2/3"
                              v-model.number="jsonFilters.chairs"
                          >
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Sofas</h2></div>
                      <div class="flex flex-row">
                          <input
                              type="number"
                              id="sofas"
                              class="form-input w-2/3 h-2/3"
                              v-model.number="jsonFilters.sofas"
                          >
                      </div>
                  </div>

              </div>

              <div class="flex flex-row">
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Electronics</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Computers
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Television
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox" v-model="jsonFilters.whiteboard"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Whiteboard
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox" v-model="jsonFilters.projector"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Projector
                          </div>
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Amenities Permitted</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox" v-model="jsonFilters.food"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Food
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox" v-model="jsonFilters.alcohol"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Alcohol
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox" v-model="jsonFilters.a_v_permitted"></div>
                          <div class="text-sm text-gray-400 px-2">
                              AV
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox" v-model="jsonFilters.ambiant_music"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Ambient Music
                          </div>
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2 px-3">
                      <div><h2>Event Type</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox" v-model="jsonFilters.sale_for_profit"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Sales for Profit
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox" v-model="jsonFilters.fundraiser"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Fundraiser
                          </div>
                      </div>
                  </div>
              </div>


          </template>

          <template #footer>
              <button id="toggleFilters" @click="advancedFilters()">
                  Filter
              </button>
              <jet-secondary-button @click.native="toggleAdvancedFilters">
                  Close
              </jet-secondary-button>
          </template>
      </jet-dialog-modal>
  </div>
</template>
<script>

import CreateBookingRequestModal from "@src/Pages/Admin/BookingRequests/CreateBookingRequestModal";
import Button from "@src/Jetstream/Button";
import JetDialogModal from "@src/Jetstream/DialogModal";
import JetSecondaryButton from "@src/Jetstream/SecondaryButton";
import Label from "@src/Jetstream/Label";
import JetInput from "@src/Jetstream/Input";
import Input from "@src/Jetstream/Input";

export default {
  name: "RoomTable",
  props: {
    rooms: {
      type: Array,
      default: [],
      required: true
    },
  },
  components: {
      Input,
      Button,
      CreateBookingRequestModal,
      JetDialogModal,
      JetSecondaryButton,
      Label,
      JetInput
  },
  data() {
      return {
          filter: '',
          roomBeingBooked: null,
          jsonFilters: {
              capacity_standing: null,
              capacity_sitting: null,
              coffee_tables: null,
              tables: null,
              chairs: null,
              sofas: null,
              computers: false,
              television: false,
              whiteboard: false,
              projector: false,
              food: false,
              alcohol: false,
              a_v_permitted: false,
              ambiant_music: false,
              sale_for_profit: false,
              fundraiser: false

          },
          showFilterModal: false
      }
  },
    computed: {
        filteredRooms() {
            return this.rooms.filter(room => {


                const building = room.building.toLowerCase();
                const status = room.status.toLowerCase();
                const type = room.name.toLowerCase();
                const floor = room.floor.toString();
                const number = room.number.toLowerCase();
                const id = room.id.toString();

                const searchTerm = this.filter.toLowerCase();

                return building.includes(searchTerm) ||
                        floor.includes(searchTerm) ||
                        type.includes(searchTerm) ||
                        status.includes(searchTerm) ||
                        number.includes(searchTerm) ||
                        id.includes(searchTerm);

            });
        },
        activeJsonFilters: function () {
            let activeJsonFilters = {};
            for (let key of Object.keys(this.jsonFilters)) {
                if(this.jsonFilters[key]){
                    activeJsonFilters[key] = this.jsonFilters[key];
                }
            }
            return activeJsonFilters;
        }
    },
    methods: {
        advancedFilters(){
            this.$emit('filterRoomsJson', this.activeJsonFilters);
            this.toggleAdvancedFilters();
        },
        toggleAdvancedFilters(){
            this.showFilterModal = !this.showFilterModal;
        }
    },

};
</script>
