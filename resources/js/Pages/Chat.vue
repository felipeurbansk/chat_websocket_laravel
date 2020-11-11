<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chat</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex"
          style="min-height: 400px"
        >
          <div
            class="w-3/12 bg-green-300 bg-opacity-25 border-r border-gray-200"
          >
            <ul>
              <li
                class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:bg-gray-100 hover:cursor-pointer"
              >
                <p class="flex items-center">
                  Felipe Urbanski
                  <span class="ml-2 w-2 h-2 bg-blue-400 rounded-full"></span>
                </p>
              </li>
              <li
                class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:bg-opacity-50 hover:bg-gray-100 hover:cursor-pointer"
              >
                <p class="flex items-center">
                  Nina Urbanski
                  <span class="ml-2 w-2 h-2 bg-blue-400 rounded-full"></span>
                </p>
              </li>
            </ul>
          </div>
          <div class="w-0 bg-white">
            <form>
              <input type="text" />
              <button>Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
  components: {
    AppLayout,
  },
};
</script>
