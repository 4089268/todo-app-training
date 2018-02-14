<template>
    <div class="container">
        <div class="box">
             <todo-input @addTodo="addTodo($event)"></todo-input>
        </div>
        <table class="table is-bordered">
            <todo-item v-for="todo in items" :text=todo.text :done=todo.done :id=todo.id @toggleDone=toggleDone($event) @removeTodo=removeTodo($event)>
            </todo-item>
        </table>
    </div>
</template>

<script>    
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
            addTodo (text) {
                var xthis2 = this;                
                if (text !== '') {                    
                    axios.post('/api/todos/',{ 'text': text }).then(function(response){
                        xthis2.items.push(response.data);
                        xthis2.todoItemText = '';
                    });                    
                }
            },
            removeTodo (id) {
                var xthis3 = this;
                axios.delete('/api/todos/' + id).then(function(response){
                    switch(response.status){
                        case(200):
                            xthis3.items = xthis3.items.filter(item => item.id !== id);
                            alert("Borrado");
                        break;
                        default:
                            alert("Err");
                        break;
                    }   
                });
            },
            toggleDone (id) {   
                var xthis4 = this;
                axios.put('/api/todos/' + id).then(function(response){
                    var todo = xthis4.items.filter(item => item.id == response.data.id);
                    todo[0].done= response.data.done;                                        
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
