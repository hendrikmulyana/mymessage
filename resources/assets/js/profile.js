/**
 * Created by EBOD on 8/20/2017.
 */
require('./bootstrap');

const app = new Vue({
    el: '#app',
    data: {
        msg: 'Friends your Chat',
        content: '',
        privsteMsgs: [],
        singleMsgs :[],
        msgFrom: '',
        conID: '',
        friend_id: '',
        seen: false,
        newMsgFrom: ''
    },

    ready: function(){
        this.created();

    },

    created(){
        axios.get('http://mymessage.com/getMessages')
            .then(response => {
                console.log(response.data);
                app.privsteMsgs = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
    },


    methods: {

        messages: function (id) {
            axios.get('http://mymessage.com/getMessages/'+id)
                .then(response => {
                    console.log(response.data);
                    app.singleMsgs = response.data;
                    app.conID = response.data[0].conversation_id
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        inputHandler(e){
            if(e.keyCode ===13 && !e.shiftKey){
                e.preventDefault();
                this.sendMsg();
            }
        },
        sendMsg(){
            if(this.msgFrom){

                axios.post('http://mymessage.com/sendMessage', {
                    conID: this.conID,
                    msg: this.msgFrom
                })
                    .then(function (response) {
                        console.log(response.data);

                        if(response.status===200){
                            app.singleMsgs = response.data;
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        },

        friendID: function(id){
            app.friend_id = id;
        },
        sendNewMsg(){
            axios.post('http://mymessage.com/sendNewMessage', {
                friend_id: this.friend_id,
                msg: this.newMsgFrom,
            })
                .then(function (response) {
                    console.log(response.data);
                    if(response.status===200){
                        window.location.replace('http://mymessage.com/message');
                        app.msg = 'your message has been sent successfully';
                    }

                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    }

});
