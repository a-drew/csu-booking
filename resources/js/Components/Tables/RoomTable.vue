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
          <th class="lt-grey" id="id_room_id">Room ID</th>
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
            <td class="text-center lt-grey">{{room.id}}</td>
            <td class="text-center lt-grey">{{room.name}}</td>
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
              Filter
          </template>

          <template #content>
              <div class="flex">
                  <div class="flex flex-col flex-1 py-2">
                      <div><h2>Capacity Standing</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              0-5
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              6-14
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              15+
                          </div>
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2">
                      <div><h2>Capacity Sitting</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              0-5
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              6-14
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              15+
                          </div>
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2">
                      <div><h2>Coffee Tables</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              0-2
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              2-5
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              6+
                          </div>
                      </div>
                  </div>
              </div>

              <div class="flex flex-row">
                  <div class="flex flex-col flex-1 py-2">
                      <div><h2>Tables</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              0-2
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              2-5
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              6+
                          </div>
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2">
                      <div><h2>Chairs</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              0-5
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              6-14
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              15+
                          </div>
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2">
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
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Whiteboard
                          </div>
                      </div>
                  </div>
              </div>

              <div class="flex flex-row">
                  <div class="flex flex-col flex-1 py-2">
                      <div><h2>Amenities Permitted</h2></div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Food
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Alcohol
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              AV
                          </div>
                      </div>
                      <div class="flex flex-row">
                          <div><input type="checkbox"></div>
                          <div class="text-sm text-gray-400 px-2">
                              Ambient Music
                          </div>
                      </div>
                  </div>
                  <div class="flex flex-col flex-1 py-2">
                      <div><h2>Event Type</h2></div>
                      <div>Sales for Profit</div>
                      <div>Fundraiser</div>
                      <div>3</div>
                  </div>
              </div>


          </template>

          <template #footer>
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
      Button,
      CreateBookingRequestModal,
      JetDialogModal,
      JetSecondaryButton,
      Label
  },
  data() {
      return {
          filter: '',
          roomBeingBooked: null,
          jsonFilters: {},
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
        }
    },
    methods: {
        advancedFilters(){
            const json_filters = {
                "a_v_permitted": false,
                "alcohol": false
            };
            this.$emit('filterRoomsJson', json_filters)
        },
        toggleAdvancedFilters(){
            this.showFilterModal = !this.showFilterModal;
        }
    }
};
</script>
