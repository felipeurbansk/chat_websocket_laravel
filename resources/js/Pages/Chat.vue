<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chat</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex"
          style="min-height: 400px; max-height: 400px"
        >
          <div
            class="w-3/12 bg-green-300 bg-opacity-25 border-r border-gray-200 overflow-y-scroll"
          >
            <ul>
              <li
                v-for="user in users"
                :key="user.id"
                @click="
                  () => {
                    {
                      loadMessage(user.id);
                    }
                  }
                "
                class="p-6 text-lg text-gray-600 leading-7 font-semibold border-b border-gray-200 hover:cursor-pointer"
                :class="
                  userActive && userActive.id == user.id
                    ? 'bg-green-400 bg-opacity-25'
                    : 'hover:bg-gray-100 hover:bg-opacity-50'
                "
              >
                <p class="flex items-center">
                  {{ user.name }}
                  <span class="ml-2 w-2 h-2 bg-blue-400 rounded-full"></span>
                </p>
              </li>
            </ul>
          </div>
          <div class="w-9/12 bg-white flex flex-col justify-between">
            <div class="w-full p-6 flex flex-col overflow-y-scroll">
              <div
                v-for="message in messages"
                :key="message.id"
                :class="message.from == $page.auth.user.id ? 'text-right' : ''"
                class="w-full mb-3 messagesBody"
              >
                <p
                  :class="
                    message.from == $page.auth.user.id
                      ? 'messageFromMe'
                      : 'messageToMe'
                  "
                  class="inline-block p-2 rounded-md"
                  style="max-width: 75%"
                >
                  {{ message.content }}
                </p>
                <span class="block mt-1 text-xs text-gray-500">{{
                  message.created_at | formatDate
                }}</span>
              </div>
            </div>
            <div
              class="w-full bg-green-200 bg-opacity-25 p-6 border-t border-gray-200"
            >
              <form
                v-on:submit.prevent="sendMessage"
                v-if="userActive"
                class="flex rounded-md overflow-hidden border border-gray-300"
              >
                <input
                  v-model="message"
                  type="text"
                  class="flex-1 px-4 py-2 text-sm focus:outline-none"
                />
                <button
                  type="submit"
                  class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2"
                >
                  Enviar
                </button>
              </form>
            </div>
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

  data() {
    return {
      users: [],
      messages: [],
      userActive: null,
      message: "",
    };
  },

  mounted() {
    axios.get("api/users").then((result) => {
      this.users = result.data.users;
    });
  },

  methods: {
    async loadMessage(user_id) {
      await axios.get(`api/users/${user_id}`).then((result) => {
        this.userActive = result.data.user;
      });

      await axios.get(`api/messages/${user_id}`).then(async (result) => {
        this.messages = await result.data.messages;
      });

      this.scrollToBottom();
    },
    async sendMessage() {
      await axios
        .post(`api/messages/store`, {
          content: this.message,
          to: this.userActive.id,
        })
        .then(async (result) => {
          const message = await result.data.message;
          this.messages = { ...this.messages, message };
          this.message = "";
        });
      this.scrollToBottom();
    },
    scrollToBottom() {
      if (this.messages) {
        document.querySelector(".messagesBody:last-child").scrollIntoView();
      }
    },
  },
};
</script>

<style>
.messageFromMe {
  @apply bg-green-400 bg-opacity-25;
}

.messageToMe {
  @apply bg-indigo-400 bg-opacity-25;
}
</style>
