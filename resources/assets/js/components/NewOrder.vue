<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Новое поручение</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="text" v-model="title" placeholder="Заголовок" class="form-control">
                </div>
                <div class="form-group">
                    <textarea v-model="body" cols="30" rows="5" class="form-control" placeholder="Задание"></textarea>
                </div>
                <div class="form-group col-md-10" style="padding-left: 0;">
                    <select v-model="worker_id" class="form-control">
                        <option v-for="worker in workers" :value="worker.id" v-text="fullname(worker)"></option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Выполнить до:
                        <input v-model="due_date" type="date" class="form-control">
                    </label>
                </div>
                <div class="btn-group">
                    <input ref="file_input" type="file" class="hidden" @change="onFileChange">
                    <button class="btn btn-success" @click="open">Прикрепить файл</button>
                    <button class="btn btn-default col-xs-push-1" @click="create">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['workers'],

        data() {
            return {
                title: '',
                body: '',
                worker_id: '',
                due_date: '',
                formData: null
            }
        },

        methods: {
            fullname(worker) {
                return worker.surname + ' ' + worker.name + ' ' + worker.patronymic;
            },
            open() {
                this.$refs.file_input.click()
            },
            create() {
                this.formData.append('title', this.title);
                this.formData.append('body', this.body);
                this.formData.append('worker_id', this.worker_id);
                this.formData.append('due_date', this.due_date);
                axios.post('/orders', this.formData);
            },
            onFileChange (ele) {
                this.errors = {};

                let files = ele.target.files || ele.dataTransfer.files;

                if (!files.length) {
                    return;
                }

                this.file = files[0];

                var form = new FormData();
                form.append('file', this.file, this.file.name);
                this.formData = form;
            },
        }
    }
</script>