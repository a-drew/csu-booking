<template>
  <div class="table-container">
    <table class="table-auto responsive-spaced">
      <caption></caption>
      <thead>
      <tr>
        <th id="id_user_name">Name</th>
        <th id="id_user_email">Email</th>
        <th id="id_actions">Action</th>
      </tr>
      </thead>
      <tbody>
      <tr :id="'user-row-'+user.id" v-for="user in paginator.data" :key="user.id">
        <td class="text-center">{{ user.name }}</td>
        <td class="text-center">{{ user.email }}</td>
        <td class="text-center">
          <slot name="user" v-bind:user="user"></slot>
        </td>
      </tr>
      </tbody>
    </table>
    <div class="pt-3 px-2">
      <Paginator :paginator="paginator" />
    </div>
  </div>

</template>
<script>

import JetInput from '@src/Jetstream/Input';
import Paginator from "@src/Components/Paginator";

export default {
  components: {
    JetInput,
    Paginator
  },

  name: "userTable",
  props: {
    Users: {
      type: Array,
      default: [],
      required: true
    },
    paginator: Object
  }
};
</script>
