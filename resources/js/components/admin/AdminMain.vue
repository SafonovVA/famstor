<template>
    <div>
        <form v-on:submit.prevent="addNewTodo">
            <label for="new-todo">Добавить задачу</label>
            <input
                v-model="newTodoText"
                id="new-todo"
                placeholder="Например, покормить кота"
            >
            <button class="btn btn-primary">Добавить</button>
        </form>
        <ul>
            <li
                is="todo-item"
                v-for="(todo, index) in todos"
                v-bind:key="todo.id"
                v-bind:title="todo.title"
                v-on:remove="todos.splice(index, 1)"
            ></li>
        </ul>
        <span>{{ nextTodoId }} qwe</span>
    </div>
</template>

<script>
    Vue.component('todo-item', {
        template: '<li>{{ title }}<button v-on:click="$emit(\'remove\')">Удалить</button></li>',
        props: ['title']
    });

    export default {

        data: function () {
            return {
                newTodoText: '',
                todos: [
                    {id: 1, title: 'Помыть посуду'},
                    {id: 2, title: 'Вынести мусор'},
                    {id: 3, title: 'Подстричь газон'}
                ],
            }
        },
        computed: {
            nextTodoId: {
                get: function () {
                    return this.todos.length + 1;
                }
            }
        },
        methods: {
            addNewTodo: function () {
                this.todos.push({
                    id: this.nextTodoId,
                    title: this.newTodoText
                })
                this.newTodoText = '';
            }
        }
    }
</script>
