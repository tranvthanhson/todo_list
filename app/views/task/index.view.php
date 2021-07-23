<?php require "app/views/layouts/header.view.php" ?>
<div id="app" class="container mt-3">
    <h1>To do list</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3 v-show="isStore">Create task</h3>
            <h3 v-show="!isStore">Update task</h3>
        </div>
        <div class="col-md-12">
            <form v-on:submit.prevent>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label>Tasks</label>
                        <input type="text" class="form-control" placeholder="Enter task" v-model="task.name">
                    </div>
                    <div class="form-group col-6">
                        <label>Status</label>
                        <select v-model="task.status" class="form-control">
                            <option value="0">To do</option>
                            <option value="1">Doing</option>
                            <option value="2">Done</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label>Start date</label>
                        <input class="form-control" type="datetime-local" name="start_date" placeholder="Starting Date..." v-model="task.start_date">
                    </div>
                    <div class="form-group col-6">
                        <label>End date</label>
                        <input class="form-control" type="datetime-local" name="end_date" placeholder="Starting Date..." v-model="task.end_date">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" @click="createTask" v-if="isStore">Create task</button>
                        <button type="submit" class="btn btn-primary" @click="updateTask" v-if="!isStore">Update task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <h3>Works</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="tasks.length == 0">
                <td colspan="6" class="text-center">Empty work</td>
            </tr>
            <tr v-for="(task, index) in tasks" :key="task" v-else>
                <td>{{ index + 1 }}</td>
                <td>{{ task.name }}</td>
                <td>{{ task.start_date }}</td>
                <td>{{ task.end_date }}</td>
                <td>
                    <label class="badge badge-danger" v-if="task.status == 0">To do</label>
                    <label class="badge badge-warning" v-if="task.status == 1">Doing</label>
                    <label class="badge badge-success" v-if="task.status == 2">Done</label>
                </td>
                <td>
                    <button class="btn btn-info btn-sm" @click="editTask(task)">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="destroyTask(task.id)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            tasks: [],
            task: {
                name: '',
                start_date: '',
                end_date: '',
                status: 0,
            },
            isStore: true
        },
        created() {
            this.fetchTasks()
        },
        methods: {
            convertDate(str) {
                var isoStr = new Date(str).toISOString();
                return isoStr.substring(0, isoStr.length - 1);
            },
            resetTask() {
                this.task = {
                    name: '',
                    start_date: '',
                    end_date: '',
                    status: 0,
                };
            },
            fetchTasks() {
                $.ajax({
                    url: "tasks/table",
                    type: "get",
                    dataType: "text",

                    success: (result) => {
                        this.tasks = JSON.parse(result).data
                    }
                })
            },
            createTask() {
                $.ajax({
                    url: "tasks/store",
                    type: "post",
                    dataType: "text",
                    data: this.task,
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result.message != "") {
                            toastr.success(result.message);
                        }
                        if (result.error != "") {
                            toastr.error(result.error);
                        }
                    }
                });
                this.fetchTasks();
                this.resetTask();
            },
            editTask(task) {
                this.task = JSON.parse(JSON.stringify(task));
                this.task.start_date = this.convertDate(this.task.start_date)
                this.task.end_date = this.convertDate(this.task.end_date)
                this.isStore = false;
            },
            updateTask() {
                $.ajax({
                    url: "tasks/update",
                    type: "post",
                    dataType: "text",
                    data: this.task,
                    success: function(result) {
                        toastr.success(JSON.parse(result).message);
                    }
                });
                this.fetchTasks();
                this.isStore = true;
                this.resetTask();
            },
            destroyTask(id) {
                $.ajax({
                    url: "tasks/destroy",
                    type: "post",
                    dataType: "text",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        toastr.success(JSON.parse(result).message);
                    }
                });
                this.fetchTasks();
            }
        }
    })
</script>
<?php require "app/views/layouts/footer.view.php" ?>
