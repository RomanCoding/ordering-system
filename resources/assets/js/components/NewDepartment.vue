<template>
    <div class="col-md-6">

        <label for="name" class="col-md-4 control-label">Название</label>

        <div class="col-md-6">
            <input id="name" v-model="department['name']" type="text" class="form-control" required autofocus>
        </div>


        <div class="col-md-10">
            <textarea id="description" v-model="department['description']" class="form-control" cols="30" rows="10" placeholder="Описание (опционально)"></textarea>
        </div>

        <div class="col-md-6">
            <button type="submit" class="btn btn-default" @click="add">
                Добавить
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                departments: [],
                department: {
                    name: '',
                    description: ''
                }
            }
        },
        created() {
            axios.get('/departments').then(({data}) => {
                this.departments = data;
            });
        },
        methods: {
            add() {
                axios.post('/departments', this.department).then((response) => {
                    this.$emit('added', response.data);
                    this.clearForm();
                });
            },
            clearForm() {
                for(let field in this.department) {
                    this.department[field] = '';
                }
            }
        }
    }
</script>