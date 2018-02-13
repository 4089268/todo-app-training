<template>
    <div class="container">
        <div class="box">
            <div class="field is-grouped">
                <p class="control is-expanded">
                    <input class="input" type="text" placeholder="Nuevo recordatorio" v-model="todoItemText">
                </p>
                <p class="control">
                    <a class="button is-info" @click="addTodo">
                        Agregar
                    </a>
                </p>
            </div>
        </div>
        <table class="table is-bordered">
            <tr v-for="(todo, index) in items" :key="index">
                <td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': todo.done }" @click="toggleDone(todo)">
                    {{ todo.text }}
                </td>
                <td class="is-narrow">
                    <a class="button is-danger is-small" @click="removeTodo(todo)">Eliminar</a>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    /**
     * Tips:
     * - En mounted pueden obtener el listado del backend de todos y dentro de la promesa de axios asirnarlo
     *   al arreglo que debe tener una estructura similar a los datos de ejemplo.
     * - En addTodo, removeTodo y toggleTodo deben hacer los cambios pertinentes para que las modificaciones,
     *   addiciones o elimicaiones tomen efecto en el backend asi como la base de datos.
     */
    export default {
        data () {
            return {
                todoItemText: '',
                items: [],
            }
        },
        mounted () {
            var xthis1 = this;

            axios.get('/api/todos/').then(function(response){
                xthis1.items = response.data;
            });
        },
        methods: {
            addTodo () {
                var xthis2 = this;
                let text = this.todoItemText.trim()
                if (text !== '') {

                    axios.post('/api/todos/',{ 'text': text }).then(function(response){
                        xthis2.items.push(response.data);
                        xthis2.todoItemText = '';
                    });                    
                }
            },
            removeTodo (todo) {
                var xthis3 = this;
                axios.delete('/api/todos/' + todo.id).then(function(response){
                    switch(response.status){
                        case(200):
                            xthis3.items = xthis3.items.filter(item => item !== todo);
                            alert("Borrado");
                        break;
                        default:
                            alert("Err");
                        break;
                    }   
                });

            },
            toggleDone (todo) {                
                axios.put('/api/todos/' + todo.id).then(function(response){
                    todo.done = response.data.done;
                });
            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
