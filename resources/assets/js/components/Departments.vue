<template>
    <div>
        <table class="table table-hover" v-if="this.departments">
            <thead>
            <tr>
                <th>Название</th>
                <th>Описание</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="department in this.departments">
                <td v-text="department.name"></td>
                <td v-text="department.description"></td>
            </tr>
            </tbody>
        </table>
        <new-department @added="added"></new-department>
    </div>
</template>

<script>
    import NewDepartment from './NewDepartment.vue';
    export default {
        components: { NewDepartment },
        props: ['data'],
        data() {
            return {
                departments: [],
            }
        },
        watch: {
            data() {
                this.departments = this.data.departments;
            }
        },
        methods: {
            added(department) {
                this.$emit('added', department);
            }
        }
    }
</script>