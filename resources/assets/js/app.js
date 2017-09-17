
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const app = new Vue({
    el: '#app',
    data: {
        msg: 'Update New Post:',
        content: '',
        posts: [],
        likes:[],
        postId: '',
        successMsg: '',


    },

    ready: function(){
        this.created();
    },

    created(){
        axios.get('http://mymessage.com/posts')
            .then(response => {
                console.log(response);
                this.posts = response.data;
                Vue.filter('myOwnTime', function(value){
                    return moment(value).fromNow();
                });

            })
            .catch(function (error) {
                console.log(error);
            });

        // fetching likes
        axios.get('http://mymessage.com/likes')
            .then(response => {
                console.log(response);
                this.likes = response.data;

            })
            .catch(function (error) {
                console.log(error);
            });

    },


    methods:{

        addPost(){

            axios.post('http://mymessage.com/addPost', {
                content: this.content
            })
                .then(function (response) {
                    console.log('saved successfully');
                    if(response.status===200){
                        app.posts = response.data;
                    }

                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        deletePost(id){
            axios.get('http://mymessage.com/deletePost/' + id)
                .then(response => {
                    console.log(response);
                    this.posts = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        likePost(id){
            axios.get('http://mymessage.com/likePost/' + id)
                .then(response => {
                    console.log(response);
                    this.posts = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    },


});