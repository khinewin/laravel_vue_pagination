<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">    </head>
    <body>
    <div id="app">

    <div class="row">
        <div class="container-fluid">
            <button @click="getUsers(pagination.path)" class="btn btn-primary btn-lg">Home</button>
        <div class="toast float-right" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded mr-2" alt="...">
                <strong class="mr-auto text-success">Success.</strong>
                <small>11 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                @{{ tMessage }}
            </div>
        </div>
        </div>
    </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h4>Users</h4>
                    <table class="table table-hover">
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Join Date</td>
                            <td>Actions</td>
                        </tr>
                        <tr v-for="user in users">
                            <td>@{{ user.id}}</td>
                            <td>@{{ user.name }}</td>
                            <td>@{{ user.email }}</td>
                            <td>@{{ getUserTime(user.created_at) }}</td>
                            <td>
                                <a href="#" @click="showModal(user)" class="btn btn-outline-info btn-sm">Edit</a>

                                <a href="#" @click="removeUser(user.id)" class="btn btn-outline-danger btn-sm">Remove</a>
                            </td>
                        </tr>

                    </table>

                   <div class="pagination">
                       <button @click="getUsers(pagination.first_page_url)" :disabled="!pagination.prev_page_url" type="button" class="btn btn-sm page-link ">First</button>

                       <button @click="getUsers(pagination.prev_page_url)" :disabled="!pagination.prev_page_url" type="button" class="btn btn-sm page-link">Prev</button>
                        <span class="btn btn-info btn-sm">@{{ pagination.current_page }}</span>
                        <span class="btn btn-warning btn-sm">of</span>
                        <span class="btn btn-info btn-sm">@{{ pagination.last_page }}</span>
                       <button @click="getUsers(pagination.next_page_url)" :disabled="!pagination.next_page_url" type="button" class="btn btn-sm page-link">Next</button>
                       <button @click="getUsers(pagination.last_page_url)" :disabled="!pagination.next_page_url" type="button" class="btn btn-sm page-link">Last</button>

                   </div>
                </div>
                <div class="col-sm-4">

                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form @submit.prevent="updateUser">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" v-model="edit.id">
                       <div class="form-group">
                           <label for="name">Username</label>
                           <input type="text" name="name" id="name" v-model="edit.name" class="form-control">
                       </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" name="email" id="email" v-model="edit.email" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://momentjs.com/downloads/moment.js"></script>
        <script src="{{URL::to('js/main.js')}}"></script>
        <script>

            $(".toast").toast("hide");

        </script>
    </body>
</html>
