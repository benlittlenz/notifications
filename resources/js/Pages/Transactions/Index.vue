<template>
  <div class="mx-auto mt-4">
    <div class="rounded-lg">
      <button class="flex mr-2 focus:cursor-pointer focus:outline-none bg-purple-400 text-white py-2 px-4 rounded-lg font-bold">
        <icon name="create" />
        <span class="ml-2">Create Transaction</span>
      </button>
    </div>
    <div class="flex items-center mt-4">
      <div class="flex flex-1 items-center pr-4">
        <div class="relative md:w-1/3">
          <input v-model="form.search" type="search" class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search..." />
          <div class="absolute top-0 left-0 inline-flex items-center p-2">
            <icon name="search" />
          </div>
        </div>
        <div class="flex items-center ml-4 bg-gray-100 px-4 py-1 text-sm rounded-lg hover:bg-gray-200 cursor-pointer">
          <button>
            <icon name="cross" />
          </button>
          <span class="flex items-center ml-1">
            <p class="font-semibold mr-1"></p>
            <p></p>
          </span>
        </div>
      </div>
      <div class="flex items-center">
        <div class="mx-4">
          <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg inline-flex items-center">
            <icon name="trash" class="flex-shrink-0 w-4 h-4 fill-white" />
            <span class="pl-2">Delete</span>
          </button>
        </div>
        <button type="button" class="flex items-center text-gray-700 px-3 py-1 border font-medium rounded focus:outline-none">
          <icon name="filter" />
          Filter
        </button>
        <div class="relative ml-4">
          <select class="appearance-none h-full rounded border block w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
            <option>25</option>
            <option>50</option>
            <option>75</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <icon name="dropdown" />
          </div>
        </div>
      </div>
    </div>
    <div>
      <div>
        <div v-if="loading">Loading...</div>
        <div v-else class="bg-white rounded-sm shadow mt-2 overflow-auto max-h-screen">
          <table class="border-collapse w-full whitespace-no-wrap bg-white">
            <thead>
              <tr class="text-left h-6">
                <th v-for="(column, index) in columns" :key="index" class="w-40 bg-gray-100 sticky top-0 border-solid border border-gray-200 cursor-pointer px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                  <template v-if="sort.column === column">
                    <div class="flex items-center" v-if="sort.direction === 'asc'">
                      <span class="mr-2">{{ column }}</span>
                      <span>
                        <icon name="arrow-up" />
                      </span>
                    </div>
                    <div class="flex items-center" v-if="sort.direction === 'desc'">
                      <span class="mr-2">{{ column }}</span>
                      <span>
                        <icon name="arrow-down" />
                      </span>
                    </div>
                  </template>

                  <template v-else
                    ><span>{{ column }}</span></template
                  >
                </th>
                <th class="w-4 bg-gray-100 sticky top-0 border-solid border border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs"></th>
              </tr>
            </thead>
            <tbody>
              <template>
                <tr v-for="transaction in transactions.data" :key="transaction.id" class="max-h-2 hover:bg-gray-50 cursor-pointer">
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center">{{ transaction.date }}</span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center">{{ transaction.from }}</span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center">{{ transaction.to }}</span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center">{{ transaction.message }}</span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center">{{ transaction.source }}</span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center">{{ transaction.status }}</span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <div class="flex flex-col justify-center items-center">
                      <span class=""><icon name="details" /> </span>
                    </div>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'

import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  metaInfo: { title: 'Transactions' },
  layout: Layout,
  components: {
    Icon,
    SearchFilter
  },
  props: {
    transactions: Object,
    filters: Object,
  },
  data() {
    return {
      loading: false,
      columns: ['date', 'from', 'to', 'message', 'source', 'status'],
      form: {
        search: this.filters.search,
      },
      sort: {
        column: 'date',
        direction: 'desc',
      },
    }
  },

  computed: {
    computedTransactions() {
      if (this.transactions.length > 0) {
        return this.transactions
      }
    },
  },

  watch: {
    form: {
      handler: throttle(function () {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('transactions', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
}
</script>