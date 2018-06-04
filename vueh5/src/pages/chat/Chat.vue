<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">聊天室</div>

                    <div class="panel-body">
                        <chat-messages :messages="messages"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form
                                v-on:messagesent="addMessage"
                                :user="user"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChatForm from '@/pages/chat/ChatForm.vue'
import ChatMessages from '@/pages/chat/ChatMessages.vue'
    export default {
        name: 'Chat',
        props: ['user','token'],
        components:{
            ChatForm,
            ChatMessages
        },
        data() {
            return {
                messages: ''
            }
        },
        created() {
            this.fetchMessages();
            /*Echo.private('chat')
                .listen('MessageSent', (e) => {
                    this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });
                });*/
        },
        methods: {
            fetchMessages() {
                this.$http.get(_httpconfig.apiurl+'/messages', {'params':{user: this.user , token : this.token }}).then(response => {
                    this.messages = response.data;
                });
            },
            addMessage(message) {
                this.messages.push(message);
                this.$http.post(_httpconfig.apiurl+'/messages', {'params':{user: this.user , token : this.token ,message : message}} ).then(response => {
                    console.log(response.data);
                });
            }
        }    
    }
</script>

<style>
  .chat {
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .chat li {
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
  }

  .chat li .chat-body p {
    margin: 0;
    color: #777777;
  }

  .panel-body {
    overflow-y: scroll;
    height: 350px;
  }

  ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar {
    width: 12px;
    background-color: #F5F5F5;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
  }
</style>
