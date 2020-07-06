<template>
  <b-container fluid>
    <!-- User Interface controls -->
     <b-row class="my-1">
        <b-col sm="6">
          <b-input-group prepend="Vendor" class="mt-3">
            <b-form-input v-model="keyword"></b-form-input>
            <b-input-group-append>
              <b-button variant="outline-danger" v-on:click="clear">Delete</b-button>
              <b-button variant="outline-info" v-on:click="search">Search</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-col>
      </b-row>
    <b-row>
      <b-col lg="9" class="my-1"></b-col>
      <b-col lg="3" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              placeholder="Type to Search"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
    </b-row>
    <!-- Main table element -->
    <b-table
      show-empty
      small
      stacked="md"
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filterIncludedFields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template v-slot:cell(actions)="row">
        <b-button size="sm" @click="addToModels(row.item, row.index, $event.target)" variant="outline-success">
          +
        </b-button>
      </template>
      <template v-slot:row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul>
        </b-card>
      </template>
    </b-table>
    <b-row>
      <b-col sm="5" md="9" class="my-1"></b-col>
      <b-col sm="7" md="3" class="my-1">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { apiHost } from '../config'
import axios from 'axios'

export default {
  data () {
    return {
      keyword: null,
      items: [],
      fields: [
        {
          key: 'actions',
          label: 'Actions'
        }, {
          key: 'modem_macaddr',
          label: 'Modem Mac.Address',
          sortable: true,
          sortDirection: 'desc'
        }, {
          key: 'ipaddr',
          label: 'Ip Address',
          sortable: true
        }, {
          key: 'vsi_model',
          label: 'Model',
          sortable: true
        }, {
          key: 'vsi_swver',
          label: 'Version',
          sortable: true
        }, {
          key: 'vsi_vendor',
          label: 'Vendor',
          sortable: true
        }
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 10,
      pageOptions: [5, 10, 15],
      sortBy: '',
      sortDesc: false,
      sortDirection: 'asc',
      filter: null,
      filterOn: [],
      infoModal: {
        id: 'info-modal',
        title: '',
        content: ''
      }
    }
  },
  computed: {
    sortOptions () {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key }
        })
    }
  },
  methods: {
    addToModels (item, index, target) {
      axios.post(apiHost + 'models', {
        vendor: item.vsi_vendor,
        name: item.vsi_model,
        soft: item.vsi_swver
      }, {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      }).then((result) => {
        this.search()
      })
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },
    clear () {
      this.keyword = ''
    },
    search () {
      axios.get(apiHost + 'cablemodems?vendor=' + this.keyword).then((result) => {
        this.items = result.data
        this.totalRows = this.items.length
      })
    }
  }
}
</script>
