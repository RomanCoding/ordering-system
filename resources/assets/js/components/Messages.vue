<template>
    <div class="messages">
        <div class="panel panel-default" v-if="order">
            <div class="panel-body">
                Поручение создано: {{ moment(order.created_at).fromNow() }}
                <hr>
                {{ order.body }}
            </div>
        </div>
        <div :class="classes(message.sender.id)" v-for="message in messages">
            <div class="panel-body">
                {{ yours(message.sender.id) ? 'Вы' : message.sender.name }}:
                {{ message.body }}
            </div>
        </div>
        <div v-if="this.order">
            <div class="form-group">
                <textarea v-model="body" cols="30" rows="5" class="form-control" placeholder="Сообщение"></textarea>
            </div>
            <div class="btn-group">
                <button class="btn btn-default col-xs-push-1" @click="create">Отправить</button>
            </div>
        </div>

    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        props: ['order'],
        data() {
            return {
                messages: [],
                body: ''
            }
        },
        watch: {
            order() {
                this.messages = this.order.messages;
            }
        },
        methods: {
            moment(date=[]) {
                return moment(date).locale('ru');
            },
            create() {
                axios.post('/orders/' + this.order.id,
                    {body: this.body})
                    .then(({data}) => {
                        this.body = '';
                        this.messages.push(data);
                        flash('Сообщение отправлено!');
                    });
            },
            yours(id) {
                return window.App.auth.id == id;
            },
            classes(message_sender_id) {
                return ['panel', 'panel-default', 'message', this.yours(message_sender_id) ? 'pull-right' : 'pull-left'];
            }
        }
    }
</script>

<style>
    .messages {
        background-color: #fff;
    }
    .message {
        background-color: #f3f8fc;
        padding: 3px;
        border: #c6dfed 2px solid;
        margin: 5px;
        clear: both;
    }
</style>