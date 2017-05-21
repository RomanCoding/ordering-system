<template>
    <div class="col-md-7">

        <label for="surname" class="col-md-4 control-label">Фамилия</label>

        <div class="col-md-6">
            <input id="surname" v-model="person['surname']" type="text" class="form-control" required autofocus>
        </div>

        <label for="name" class="col-md-4 control-label">Имя</label>

        <div class="col-md-6">
            <input id="name" v-model="person['name']" type="text" class="form-control" required autofocus>
        </div>

        <label for="patronymic" class="col-md-4 control-label">Отчество</label>

        <div class="col-md-6">
            <input id="patronymic" v-model="person['patronymic']" type="text" class="form-control" required autofocus>
        </div>

        <label for="department_id" class="col-md-4 control-label">Отдел</label>

        <div class="col-md-6">
            <select id="department_id" v-model="person['department_id']" class="form-control" required>
                <option :value="department.id" v-text="department.name" v-for="department in this.departments"></option>
            </select>
        </div>

        <label for="email" class="col-md-4 control-label">E-Mail</label>

        <div class="col-md-6">
            <input id="email" v-model="person['email']" type="email" class="form-control" required>
        </div>

        <label for="password" class="col-md-4 control-label">Пароль</label>

        <div class="col-md-6">
            <input id="password" v-model="person['password']" type="password" class="form-control" required>
        </div>

        <label for="description" class="col-md-4 control-label">Описание сотрудника</label>

        <div class="col-md-6">
            <textarea id="description" v-model="person['description']" class="form-control" cols="30" rows="5"
                      required></textarea>
        </div>

        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-default" @click="add">
                Добавить пользователя
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                departments: [],
                person: {
                    surname: '',
                    name: '',
                    patronymic: '',
                    department_id: '',
                    email: '',
                    password: '',
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
                axios.post('/workers', this.person).then((response) => {
                    this.$emit('added', response.data);
                    this.clearForm();
                });
            },
            clearForm() {
                for(let field in this.person) {
                    this.person[field] = '';
                }
            }
        }
    }
</script>