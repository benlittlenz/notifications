<template>
  <div class="mx-auto mt-20 w-11/12">
    <div class="rounded-lg">
      <button class="flex mr-2 focus:cursor-pointer focus:outline-none bg-purple-400 text-white py-2 px-4 rounded-lg font-bold">
        <svg class="w-6 h-6 bg-purple-600 text-white rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span class="ml-2">Create Transaction</span>
      </button>
    </div>
    <div class="flex items-center mt-4">
      <div class="flex flex-1 items-center pr-4">
        <div class="relative md:w-1/3">
          <input type="search" class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search..." />
          <div class="absolute top-0 left-0 inline-flex items-center p-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
              <circle cx="10" cy="10" r="7" />
              <line x1="21" y1="21" x2="15" y2="15" />
            </svg>
          </div>
        </div>
        <div class="flex items-center ml-4 bg-gray-100 px-4 py-1 text-sm rounded-lg hover:bg-gray-200 cursor-pointer">
          <button>
            <svg class="w-4 h-4 bg-gray-300 rounded-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
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
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span class="pl-2">Delete</span>
          </button>
        </div>
        <button type="button" class="flex items-center text-gray-700 px-3 py-1 border font-medium rounded focus:outline-none">
          <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" class="w-5 h-5 mr-1">
            <g class="">
              <path d="M0 0h24v24H0z" fill="none" class=""></path>
              <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z" class=""></path>
            </g>
          </svg>
          Filter
        </button>
        <div class="relative ml-4">
          <select class="appearance-none h-full rounded border block appearance-none w-full bg-white text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white">
            <option>25</option>
            <option>50</option>
            <option>75</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
              <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
            </svg>
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
                <tr class="max-h-2 hover:bg-gray-50 cursor-pointer">
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center"></span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center"></span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center"></span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center"></span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center"></span>
                  </td>
                  <td class="border-solid border border-gray-200">
                    <span class="text-gray-700 px-6 py-1 flex items-center"></span>
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
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
export default {
  layout: Layout,
  components: {
    Icon,
  },

  data: () => ({
    columns: ['date', 'from', 'to', 'message', 'source', 'status', 'actions'],
    sort: {
      column: 'date',
      direction: 'desc',
    },
  }),
}
</script>