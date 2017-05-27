<template>
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Входящие</a>
            </li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
                                       data-toggle="tab">Исходящие</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <!-- Tab panes -->
                <div class="col-md-4">
                    <div class="list-group">
                        <a href="#" class="list-group-item" v-for="order in incomingOrders">
                            <h4 class="list-group-item-heading">{{ order.title }}</h4>
                            <p class="list-group-item-text">
                                {{ order.creator.name }}
                                {{ order.due_date }}
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-8" style="background-color: red;">
                    1
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <!-- Tab panes -->
                <div class="col-md-4">
                    <div class="list-group">
                        <a href="#" class="list-group-item" v-for="order in outgoingOrders">
                            <h4 class="list-group-item-heading">{{ order.title }}</h4>
                            <p class="list-group-item-text">
                                {{ order.worker.name }}
                                {{ order.due_date }}
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <messages></messages>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <new-order :workers="this.workers">

            </new-order>
        </div>
    </div>
</template>

<script>
    import NewOrder from './NewOrder.vue';
    import Messages from './Messages.vue';
    export default {
        components: {NewOrder, Messages},
        props: ['workers'],

        data() {
            return {
                incomingOrders: [],
                outgoingOrders: [],
            }
        },
        created() {
            axios.get('/orders/').then(({data}) => {
                this.incomingOrders = data.incomingOrders;
                this.outgoingOrders = data.outgoingOrders;
            });
        }
    }
</script>