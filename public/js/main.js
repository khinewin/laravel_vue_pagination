var app=new Vue({
    el: "#app",
    data(){
        return {
            users: [],
            tMessage: "",
            pagination: {},
            edit: {
              name: '',
              email: '',
              id: ''
            },
        }
    },

    created(){
        this.getUsers();

    },
    methods:{
        updateUser(){
            //console.log(this.edit.id, this.edit.name, this.edit.email)
            axios.post("/user/update",{
                id: this.edit.id,
                name: this.edit.name,
                email: this.edit.email
            })
                .then(res=>{
                    this.users="";
                    this.getUsers();
                    $(".modal").modal("hide");
                    //console.log(res.data.message);
                    this.tMessage=res.data.message;
                    $(".toast").toast("show");
                    setTimeout(function () {
                        $(".toast").toast('hide');
                    }, 3000)
                })
                .catch(err=>{
                    console.log(err)
                });

        },
        showModal(user){
            $(".modal").modal("show");
            this.edit.name=user.name;
            this.edit.email=user.email;
            this.edit.id=user.id;
        },
        getUsers(page_url){
             page_url=page_url || "/users";
            axios.get(page_url)
                .then(user=>{
                    this.users=user.data.users.data;
                    this.doPagination(user.data.users);
                   // console.log(user.data.users)

                })
                .catch(err=>{
                    console.log(err)
                });
        },
        doPagination(res){
            let paginate={
                current_page: res.current_page,
                last_page: res.last_page,
                first_page_url: res.first_page_url,
                last_page_url: res.last_page_url,
                next_page_url: res.next_page_url,
                path: res.path,
                per_page:res.per_page,
                prev_page_url: res.prev_page_url,
                last_page: res.last_page,
                to: res.to,
                from: res.from,
                total: res.total

            }
            this.pagination=paginate;


        },
        getUserTime(t){
            return moment(t).fromNow();
        },
        removeUser(id){
            let result=confirm("Are you sure want to remove this user ?");
            if(result){
                axios.get('/user/remove/'+id)
                    .then(res=>{
                        console.log(res.data.message);
                        this.tMessage=res.data.message;
                        $(".toast").toast("show");
                        this.users="";
                        this.getUsers();
                        setTimeout(function () {
                            $(".toast").toast('hide');
                        }, 3000)
                    })
                    .catch(err=>{
                        console.log(err)
                    });
            }
        }
    }
})