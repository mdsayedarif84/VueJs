<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>VueJs</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    </head>
    <body>
        <div class="app" id="app">
            <div class="container">
                <div class="row">
                    <h4 class="text-danger float-left">All Users</h4>
                    <button type="button" class=" float-right btn btn-secondary btn-sm">Add New User</button>
                </div>
                <table class="table table-dark text-center">
                        <th>ID</th>
                        <th>NAME</th>
                        <th>Type</th>
                        <th>EMAIL</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="user in users">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.username }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <button class="btn btn-primary">Edit</button>
                            <button class="btn btn-info">Delete</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script type="text/javascript" src="js/vue.js"></script>
        <script src="js/axios.js"></script>
        <script>
            let app = new Vue({
                el:"#app",
                data:{
                    users:[],
                    errorMsg: null
                },
                methods:{
                    getData:function(){
                        axios.get("http://localhost/GitCloneSite/VueJs/part-3/db-connect/api.php?action=read")
                        .then(function(response){
                            if(!response.data.error){
                                app.users       =   response.data.users;
                            }else{
                                app.errorMsg    =   response.data.message;
                            }
                        });
                    }
                },
                mounted: function(){
                    this.getData();
                }
            });
        </script>
    </body>
</html>      