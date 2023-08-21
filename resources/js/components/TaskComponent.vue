<template>
    <div class="container">
        <div class="row mb-2 justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Issues
                    </div>

                    <div class="card-body">
                        <div class="input-group">
                            <!-- Task search input -->
                            <input type="search" class="form-control" v-model="this.searchTerm"  @input="getTasks(this.searchTermPage, this.searchTerm)" placeholder="Search tasks">
                            <!-- <button type="button" class="btn btn-warning" @click="getTasks(this.searchTermPage, this.searchTerm)" v-if="!edit_todo_id">Search</button> -->
                            <button type="button" class="btn btn-danger float-right" @click="resetTodo()" >Reset</button>
                        </div>
                        <br/>

                        <div>
                            Add Form
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="text" placeholder="Task title..." class="form-control" aria-label="todo" aria-describedby="todo" v-model="this.issue.title" >
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <textarea placeholder="Description..." class="form-control" aria-label="todo" aria-describedby="todo" v-model="this.issue.description" ></textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <input type="text" placeholder="Status..." class="form-control" aria-label="todo" aria-describedby="todo" v-model="this.issue.status" >
                                </div>

                                <div class="col">
                                    <input type="text" placeholder="Priority..." class="form-control" aria-label="todo" aria-describedby="todo" v-model="this.issue.priority" >
                                </div>

                                <div class="col">
                                    <input type="date" class="form-control" aria-label="todo" aria-describedby="todo" v-model="this.issue.due_date" >
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <select class="form-select" aria-label="Select Assignee" v-model="this.issue.assignee_id" >
                                        <option disabled selected>Select Assignee</option>
                                        <option v-for="(user,index) in users" :key="index" value="{{user.id}}" > {{ user.name }} </option>
                                    </select>
                                </div>

                                <div class="col">
                                    <div class="input-group">
                                        <select  class="form-select" aria-label="Select Project" v-model="this.issue.project_id" >
                                            <option selected value="">Select Project</option>
                                            <option v-for="(project,index) in projects" :key="index" value="{{project.id}}" > {{ project.name }} </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-append pl-2">
                                            <button type="button" class="btn btn-info" @click="saveTodo()" v-if="!edit_todo_id">Add</button>
                                            <button type="button" class="btn btn-danger float-right" @click="resetTodo()" >Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        Listing...
                        <table class="table table-bordered mt-4">
                            <thead>
                                <th>Sr No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Assignee</th>
                                <th>Due Date</th>
                                <th>Project</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr v-for="(todo,index) in todos" :key="index">
                                    <td> {{ ++index }} </td>
                                    <td :key="todo.id"> {{ todo.title }} </td>
                                    <td> {{ todo.description }} </td>
                                    <td> {{ todo.status }} </td>
                                    <td> {{ todo.priority }} </td>
                                    <td> {{ todo.user.name }} </td>   
                                    <td> {{ todo.due_date }} </td>
                                    <td> {{ todo.project.name }} </td>
                                    <td> 
                                        <button type="button" v-show="false" class="btn btn-warning ml-10" @click="editTodo(todo.id, --index)">Edit </button>
                                        <button type="button" class="btn btn-danger mr-4" @click="deleteTodo(todo.id, --index)"> Delete </button>
                                    </td>
                                </tr>
                                <!-- Pagination links -->
                                <tr class="pagination">
                                    <td v-for="page in this.totalPages" :key="page" colspan="6">
                                        <a @click="getTasks(page, this.searchTerm)" :class="{ active: page === pagination.current_page }">{{ page }}</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        //Declare Variable
        data() {
            return {
                todos: {},
                searchTerm: '',
                searchTermPage: 1,
                api: import.meta.env.VITE_API_URL+'/tasks',
                todo_input: '',
                edit_todo_id: '',
                edit_todo_index: '',
                totalPages: '',
                pagination: {},
                page: 1,
                issue: {},
                users: {},
                projects: {},
            }
        },
        created() {
            this.fetchInitialData();
            this.getTasks();
            
        },
        //Set Value for the todo list :: Read Fetch All Todo List data
        mounted() {
        },
        //On click perform  Create store, Edit, Update, Delete o 
        methods:{
            //For display drop down fetch data from database
            fetchInitialData() {
                this.axios.get(this.api+'/get-require-data').then((response) => {
                        if (response.data.length > 0) {
                            this.users = response.data.users;
                            this.projects = response.data.projects;
                        }
                    });
            },
            //For fetch all tasks
            getTasks(page = 1, searchTerm) {
                let url = import.meta.env.VITE_API_URL+`/tasks?page=${page}`;
                
                
                if (searchTerm != undefined) {
                    url = import.meta.env.VITE_API_URL+`/tasks?page=${page}&searchTerm=${searchTerm}`;
                } 

                axios.get(url) 
                .then(response => {
                    this.todos = response.data.tasks.data;
                    this.totalPages = response.data.pagination.total_pages;
                    this.pagination = response.data.tasks;
                })
                .catch(error => {
                    alert(error);
                    console.log(error);
                });
            },
            //For add new task
            saveTodo() {
                console.log(this.issue.title, this.issue.description);
                if(this.issue.title != undefined && this.issue.description != undefined) {
                    this.axios.post(this.api, this.issue)
                    .then((response) => {
                        this.getTasks();
                        this.resetTodo();
                    });
                } else {
                    alert('Please enter all detailss');
                }
            },
            //For delete task
            deleteTodo(id, index) {
                if(id > 0) {
                    this.axios.delete(this.api+'/'+id).then((response) => {
                        console.log(response);
                        this.todos.splice(index, 1);
                        this.getTasks();
                    });
                }
            },
            // editTodo(id, index) {
            //     if(this.todos[index].id) {
            //         this.todo_input = this.todos[index].name;
            //         this.edit_todo_id = id;
            //         this.edit_todo_index = index;
            //     }
            // },
            // updateTodo() {
            //     if(this.edit_todo_id > 0) {
            //         let data = {'name': this.todo_input};
            //         this.axios.put(this.api+'/'+this.edit_todo_id, data).then((response) => {
            //             console.log(response);
            //             this.todos[this.edit_todo_index].name = response.data.name;
            //             this.resetTodo();
            //         });
            //     }
            // },
            resetTodo() {
                this.searchTerm = '';
                this.todo_input = '';
                this.edit_todo_id = '';
                this.edit_todo_index = '';
                this.issue = {};
                this.getTasks();
            },
        }
    }
</script>